<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sale_target".
 *
 * @property string $id
 * @property string $target_name
 * @property integer $product_id
 * @property integer $target_num
 * @property integer $target_area
 * @property integer $target_user
 * @property string $target_start_time
 * @property string $target_end_time
 * @property string $created_at
 * @property string $updated_at
 */
class SaleTarget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_target';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['target_name', 'target_num', 'target_start_time', 'target_end_time'], 'required'],
            [['product_id', 'target_num', 'target_area', 'target_user'], 'integer'],
            [['target_start_time', 'target_end_time', 'created_at', 'updated_at'], 'safe'],
            [['target_name'], 'string', 'max' => 100],
            [['target_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'target_name' => 'Target Name',
            'product_id' => 'Product Name',
            'target_num' => 'Target Num',
            'target_area' => 'Target Area',
            'target_user' => 'Target User',
            'target_start_time' => 'Target Start Time',
            'target_end_time' => 'Target End Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'target_area']);
    }

    public static function getDashboardTargetProgressData($areaId = null){
        $dateNow = date('Y-m-d H:i:s');
        $model = static::find()->andWhere(['<', 'target_start_time', $dateNow])->andWhere(['>', 'target_end_time', $dateNow]);

        if(!empty($areaId)){
            $model->andWhere(['target_area' => $areaId]);
        }

        $inProgressTargets = $model->orderBy(['id' => SORT_ASC])->asArray()->all();
        foreach($inProgressTargets as $k => $target){
            $areaUsers = ArrayHelper::getColumn(Staff::find()->select('id')->where(['user_area' => $target['target_area']])->all(), 'id');
            $countAreaSaleData = SaleData::find()->where(['user_id' => $areaUsers])->count();
            $inProgressTargets[$k]['sale_num'] = $countAreaSaleData;
        }

        return $inProgressTargets;
    }
}
