<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $user_pwd
 * @property string $user_role
 * @property integer $user_status
 * @property string $user_area
 * @property string $user_gender
 * @property string $user_desc
 * @property string $user_phone
 * @property string $created_at
 * @property string $updated_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    /*public $id;
     public $username;
     public $password;
     public $authKey;
     public $accessToken;

     private static $users = [
         '100' => [
             'id' => '100',
             'username' => 'admin',
             'password' => 'admin',
             'authKey' => 'test100key',
             'accessToken' => '100-token',
         ],
         '101' => [
             'id' => '101',
             'username' => 'demo',
             'password' => 'demo',
             'authKey' => 'test101key',
             'accessToken' => '101-token',
         ],
     ];
 */

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_name', 'user_pwd'], 'required'],
            [['user_name'], 'string', 'max' => 20],
            [['user_role'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_name'   => 'Username',
            'user_pwd'    => 'Password',
            'user_role'   => 'Role',
            'user_status' => 'Status',
            'user_area'   => 'Area',
            'user_gender' => 'Gender',
            'user_desc'   => 'Desc',
            'user_phone'  => 'Phone',
            'created_at'  => 'Create Time',
            'updated_at'  => 'Update Time',
        ];
    }

    public function getRoleName($roleNum)
    {
        $map = [
            1 => 'Staff',
            2 => 'OnePlus Envoy',
            4 => 'Area Manager',
            8 => 'General Manager',
            16 => 'Administrator',
        ];

        return isset($map[$roleNum]) ? $map[$roleNum] : $map[1];
    }

    public function getStatusName($status)
    {
        $map = [
            0 => 'Blocked',
            1 => 'Normal',
        ];

        return isset($map[$status]) ? $map[$status] : $map[0];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = User::find()
            ->where(['user_name' => $username])
            ->asArray()
            ->one();

        if ($user) {
            return new static($user);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        //return $this->user_pwd === $password;
        return Yii::$app->getSecurity()->validatePassword($password, $this->user_pwd);
    }

    public static function isAreaManager(){
        return Yii::$app->user->getIdentity(false)->user_role >= 4;
    }

    public static function isGeneralManager(){
        return Yii::$app->user->getIdentity(false)->user_role >= 8;
    }

    public static function isAdmin(){
        return Yii::$app->user->getIdentity(false)->user_role >= 16;
    }
}