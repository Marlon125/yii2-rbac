<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_module_permission".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $module_id
 * @property integer $new
 * @property integer $view
 * @property integer $save
 * @property integer $remove
 * @property string $added_at
 * @property string $added_by
 *
 * @property ModulesList $module
 * @property RoleTypes $role
 */
class RolePermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_module_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'module_id', 'new', 'view', 'save', 'remove'], 'integer'],
            [['role_id', 'module_id'], 'required'],
            [['added_at'], 'safe'],
            [['added_by'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'module_id' => 'Module ID',
            'new' => 'Create',
            'view' => 'View',
            'save' => 'Update',
            'remove' => 'Delete',
            'added_at' => 'Added At',
            'added_by' => 'Added By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(ModulesList::className(), ['module_id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['role_id' => 'role_id']);
    }
}
