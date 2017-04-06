<?php
/**
 * Project: yii2-easy-wechat.
 * Author: Max
 * Time: <17/4/3 00:49>
 */

namespace maxwen\wechat\models;

use common\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%wechat_menu}}".
 *
 * @property integer $id
 * @property integer $account_id
 * @property integer $parent_id
 * @property string $name
 * @property string $type
 * @property string $key
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wechat_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_id', 'name', 'created_at', 'updated_at'], 'required'],
            [['account_id', 'parent_id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['type'], 'string'],
            [['name'], 'string', 'max' => 30],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_id' => '所属公众号',
            'parent_id' => '上级菜单',
            'name' => '菜单名称',
            'type' => '菜单类型',
            'key' => '菜单触发值',
            'sort' => '排序',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param int $accountId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getPublishData($accountId)
    {
        $menus = static::find()->where(['account_id' => $accountId])
            ->select('id, parent_id, name, type, key')
            ->asArray()
            ->all();

        if(!$menus) {
            return [];
        }

        $menus = ArrayHelper::listToTree($menus, 'id', 'parent_id', 'sub_button');
        foreach ($menus as $k => $menu) {
            unset($menus[$k]['id'], $menus[$k]['parent_id']);
            if(isset($menu['sub_button'])){
                unset($menus[$k]['type'], $menus[$k]['key']);

                foreach ($menu['sub_button'] as  $key => $subMenu) {
                    unset($menus[$k]['sub_button'][$key]['id'],$menus[$k]['sub_button'][$key]['parent_id']);
                    if($subMenu['type'] == 'view') {
                        $menus[$k]['sub_button'][$key]['url'] = $subMenu['key'];
                        unset($menus[$k]['sub_button'][$key]['key']);
                    }

                    if($subMenu['type'] == 'media_id'){
                        $menus[$k]['sub_button'][$key]['media_id'] = $subMenu['key'];
                        unset($menus[$k]['sub_button'][$key]['key']);
                    }
                }

            }
        }

        return $menus;
    }
}