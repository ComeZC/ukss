<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "area".
 *
 * @property integer $id
 * @property string $area_code
 * @property string $area_name
 * @property integer $parent_area
 * @property string $area_desc
 * @property string $area_address
 * @property string $area_zipcode
 * @property string $area_phone
 * @property string $created_at
 * @property string $updated_at
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_name'], 'required'],
            [['parent_area'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['area_code', 'area_zipcode', 'area_phone'], 'string', 'max' => 20],
            [['area_name'], 'string', 'max' => 100],
            [['area_desc'], 'string', 'max' => 1000],
            [['area_address'], 'string', 'max' => 200],
            [['area_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area_code' => 'Area Code',
            'area_name' => 'Area Name',
            'parent_area' => 'Parent Area',
            'area_desc' => 'Area Desc',
            'area_address' => 'Area Address',
            'area_zipcode' => 'Area Zipcode',
            'area_phone' => 'Area Phone',
            'created_at' => 'Created Time',
            'updated_at' => 'Updated Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Staff::className(), ['area_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleTargets()
    {
        return $this->hasMany(SaleTarget::className(), ['target_area' => 'id']);
    }

    public static function getAreaDropDownList($updateId = 0){
        $updateId = empty($updateId) ?  '' : $updateId;
        return ArrayHelper::map(
            static::find()->select(['id', 'area_name'])->where(['!=', 'id', $updateId])->orderBy(['id' => SORT_ASC])->asArray()->all(),
            'id',
            'area_name'
        );
    }

    public static function getAreaNameById($areaId){
        $model = static::findOne($areaId);
        return isset($model->area_name) ? $model->area_name : null;
    }
}
