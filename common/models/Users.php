<?php

namespace common\models;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $role
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            [['username', 'password', 'email', 'first_name', 'last_name'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'role' => 'Role',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\UsersQuery the active query used by this AR class.
     */
  
     public static function login($username, $password)
     {
         $user = static::findOne(['username' => $username]);
         
         if ($user !== null && $user->validatePassword($password)) {
             Yii::$app->user->login($user);
             return true;
         }
         
         return false;
     }

    protected function getUser()
    {
        return Users::findOne(['username' => $this->username]);
    }

    public static function find()
    {
        return new \common\models\query\UsersQuery(get_called_class());
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Not needed for basic authentication
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // Not needed for basic authentication
        return null;
    }

    public function validateAuthKey($authKey)
    {
        // Not needed for basic authentication
        return true;
    }
    public function getIsGuest()
    {
        return true; 
    }

}
