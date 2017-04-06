<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/3 00:44>
 */

namespace maxwen\wechat\models;

use EasyWeChat\Support\Str;

/**
 * This is the model class for table "{{%wechat_account}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $original
 * @property string $app_id
 * @property string $app_secret
 * @property string $token
 * @property string $access_token
 * @property string $account
 * @property integer $type
 * @property integer $encoding_type
 * @property string $encoding_aes_key
 * @property string $description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wechat_account}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['original', 'app_id', 'app_secret'], 'required'],
            [['type', 'encoding_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'original'], 'string', 'max' => 40],
            [['app_id', 'app_secret'], 'string', 'max' => 50],
            [['token'], 'string', 'max' => 32],
            [['access_token', 'description'], 'string', 'max' => 255],
            [['account'], 'string', 'max' => 30],
            [['encoding_aes_key'], 'string', 'max' => 43],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '公众号名称',
            'original' => '原始ID',
            'app_id' => 'AppID',
            'app_secret' => 'AppSecret',
            'token' => 'Token',
            'access_token' => 'Access Token',
            'account' => '微信号',
            'type' => '公众号类型',
            'encoding_type' => '消息加密方式',
            'encoding_aes_key' => 'Encoding AES Key',
            'description' => '公众号简介',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if($insert) {
            $this->token = Str::quickRandom(32);
            $this->encoding_aes_key = Str::quickRandom(43);
            $this->created_at = time();
        }

        $this->updated_at = time();

        return parent::beforeSave($insert);
    }

    public function afterDelete()
    {
        parent::afterDelete();
    }

    /**
     * @return array
     */
    public static function getTypelist()
    {
        return [
            '0' => '订阅号',
            '1' => '服务号'
        ];
    }

    public static function getEnctypes()
    {
        return [
            '0' => '安全模式',
            '1' => '明文模式',
            '2' => '兼容模式'
      ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['account_id' => 'id']);
    }
}