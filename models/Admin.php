<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone_number
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $authKey
 * @property string $password_reset_token
 * @property string $user_image
 * @property string $user_level
 */
class Admin extends \yii\db\ActiveRecord
{
    public $img;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone_number', 'username', 'email', 'password', 'user_level', 'is_active'], 'required'],
            [['user_level'], 'string'],
            [['first_name', 'last_name', 'username', 'password', 'authKey', 'password_reset_token'], 'string', 'max' => 250],
            [['phone_number'], 'string', 'max' => 30],
            [['email', 'user_image'], 'string', 'max' => 500],
            [['username'], 'unique'],
            [['img'], 'file', 'extensions' => 'gif, jpg, png', 'maxFiles' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone_number' => 'Phone Number',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'user_image' => 'User Image',
            'img' => 'Upload Photo',
            'user_level' => 'User Level',
            'is_active' => 'Is Active',
        ];
    }
    
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['role_id' => 'user_level']);
    }
}
