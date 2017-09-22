<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $user_name
 * @property integer $user_role
 * @property string $user_pwd
 * @property integer $user_status
 * @property integer $user_area
 * @property string $user_gender
 * @property string $user_desc
 * @property string $user_phone
 * @property string $created_at
 * @property string $updated_at
 */
class Staff extends \yii\db\ActiveRecord
{
    const ROLE_MAP = [
        1 => 'Staff',
        2 => 'OnePlus Envoy',
        4 => 'Area Manager',
        8 => 'General Manager',
        16 => 'Administrator',
    ];

    const STATUS_MAP = [
        1 => 'Normal',
        0 => 'Blocked',
    ];

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
            [['user_pwd'], 'default', 'value'=>Yii::$app->getSecurity()->generatePasswordHash('123456')],
            [['user_name', 'user_pwd'], 'required'],
            [['user_role', 'user_status', 'user_area'], 'integer'],
            [['user_gender'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_name', 'user_phone'], 'string', 'max' => 20],
            [['user_pwd'], 'string', 'max' => 100],
            [['user_desc'], 'string', 'max' => 500],
            [['user_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'user_role' => 'User Role',
            'user_pwd' => 'User Pwd',
            'user_status' => 'User Status',
            'user_area' => 'User Area',
            'user_gender' => 'User Gender',
            'user_desc' => 'User Desc',
            'user_phone' => 'User Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }

    public static function getStaffById($id){
        return static::findOne($id);
    }

    public static function getStaffInMyArea($managerAreaId){
        return ArrayHelper::map(static::find()->select('id,user_name')->where(['user_area' => $managerAreaId])->asArray()->all(), 'id', 'user_name');
    }

    public static function searchStaffInMyArea($staffName, $managerAreaId){
        $model = static::find()->select('id, user_name');
        if(!empty($managerAreaId)){
            $model->andWhere(['user_area' => $managerAreaId]);
        }
        $model->andWhere(['like', 'user_name', $staffName]);
        return ArrayHelper::map($model->asArray()->all(), 'id', 'user_name');
    }

    public static function getUserNameById($id){
        $model = static::findOne($id);
        return isset($model->user_name) ? $model->user_name : null;
    }

    public static function getRoleName($roleNum) {
        $map = self::ROLE_MAP;
        return isset($map[$roleNum]) ? $map[$roleNum] : $map[1];
    }

    public static function getStatusName($status) {
        $map = self::STATUS_MAP;
        return isset($map[$status]) ? $map[$status] : $map[0];
    }

    public static function getRoleMap(){
        return self::ROLE_MAP;
    }

    public static function getStatusMap() {
        return self::STATUS_MAP;
    }
}
