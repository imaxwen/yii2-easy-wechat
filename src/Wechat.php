<?php
/**
 * Project: yii2-easyWeChat.
 * Author: Max.wen
 * Date: <2016/05/10 - 14:31>
 */

namespace maxwen\easywechat;

use yii;
use EasyWeChat\Foundation\Application;
use yii\base\Component;

/**
 * Class Wechat
 * @package common\components
 *
 * @property Application $app
 * @property WechatUser  $user
 * @property bool        $isWechat
 * @property string      $returnUrl
 */
class Wechat extends Component
{
	/**
	 * user identity class params
	 * @var array
	 */
	public $userOptions = [];
	/**
	 * wechat user info will be stored in session under this key
	 * @var string
	 */
	public $sessionParam = '_wechatUser';
	/**
	 * returnUrl param stored in session
	 * @var string
	 */
	public $returnUrlParam = '_wechatReturnUrl';
	/**
	 * @var Application
	 */
	private static $_app;
	/**
	 * @var WechatUser
	 */
	private static $_user;

	/**
	 * @return yii\web\Response
	 */
	public function authorizeRequired()
	{
		if(Yii::$app->request->get('code')) {
			// callback and authorize
			return $this->authorize($this->app->oauth->user());
		}else{
			// redirect to wechat authorize page
			$this->setReturnUrl(Yii::$app->request->getUrl());
			return Yii::$app->response->redirect($this->app->oauth->redirect()->getTargetUrl());
		}
	}
	
	/**
	 * @param \Overtrue\Socialite\User $user
	 * @return yii\web\Response
	 */
	public function authorize(\Overtrue\Socialite\User $user)
	{
		Yii::$app->session->set($this->sessionParam, $user->toJSON());
		return Yii::$app->response->redirect($this->getReturnUrl());
	}

	/**
	 * check if current user authorized
	 * @return bool
	 */
	public function isAuthorized()
	{
		$hasSession = Yii::$app->session->has($this->sessionParam);
		$sessionVal = Yii::$app->session->get($this->sessionParam);
		return ($hasSession && !empty($sessionVal));
	}

	/**
	 * @param string|array $url
	 */
	public function setReturnUrl($url)
	{
		Yii::$app->session->set($this->returnUrlParam, $url);
	}

	/**
	 * @param null $defaultUrl
	 * @return mixed|null|string
	 */
	public function getReturnUrl($defaultUrl = null)
	{
		$url = Yii::$app->getSession()->get($this->returnUrlParam, $defaultUrl);
		if (is_array($url)) {
			if (isset($url[0])) {
				return Yii::$app->getUrlManager()->createUrl($url);
			} else {
				$url = null;
			}
		}

		return $url === null ? Yii::$app->getHomeUrl() : $url;
	}

	/**
	 * single instance of EasyWeChat\Foundation\Application
	 * @return Application
	 */
	public function getApp()
	{
		if(! self::$_app instanceof Application){
			self::$_app = new Application(Yii::$app->params['WECHAT']);
		}
		return self::$_app;
	}

	/**
	 * @return WechatUser|null
	 */
	public function getUser()
	{
		if(!$this->isAuthorized()) {
			return new WechatUser();
		}

		if(! self::$_user instanceof WechatUser) {
			$userInfo = Yii::$app->session->get($this->sessionParam);
			$config = $userInfo ? json_decode($userInfo, true) : [];
			self::$_user = new WechatUser($config);
		}
		return self::$_user;
	}

	/**
	 * overwrite the getter in order to be compatible with this component
	 * @param $name
	 * @return mixed
	 * @throws \Exception
	 */
	public function __get($name)
	{
		try {
			return parent::__get($name);
		}catch (\Exception $e) {
			if($this->getApp()->$name) {
				return $this->app->$name;
			}else{
				throw $e->getPrevious();
			}
		}
	}

	/**
	 * check if client is wechat
	 * @return bool
	 */
	public function getIsWechat()
	{
		return strpos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") !== false;
	}
}
