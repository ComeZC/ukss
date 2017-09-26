<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sale_data".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $imei1
 * @property string $imei2
 * @property string $created_at
 * @property string $updated_at
 */
class SaleData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'imei1', 'product_id'], 'required'],
            [['user_id', 'product_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['imei1', 'imei2'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User Name',
            'product_id' => 'Product Name',
            'imei1' => 'Imei 1',
            'imei2' => 'Imei 2',
            'created_at' => 'Created Time',
            'updated_at' => 'Updated Time',
        ];
    }

    public static function getSaleProductDistribute($areaId = null){
        $model = static::find()->select(['product_id', 'COUNT(*) AS cnt']);

        if(!empty($areaId)){
            $userIds = ArrayHelper::getColumn(Staff::find()->select('id')->where(['user_area' => $areaId])->all(), 'id');
            $model->andWhere(['user_id' => $userIds]);
        }

        $model->andWhere(['>', 'created_at', date("Y-m-d",strtotime('-30day'))]);

        $result = $model->groupBy('product_id')->asArray()->all();
        $result = [
            ['cnt' => 5, 'name' => 'OnePlus 5 8G+128G Midnight Black'],
            ['cnt' => 8, 'name' => 'OnePlus 5 8G+128G Slate Gray'],
            ['cnt' => 12, 'name' => 'OnePlus 5 6G+64G Soft Gold'],
        ];

        $saleProductData = [];
        foreach($result as $k => $v){
            $data = new \stdClass();
            $data->value = $v['cnt'];
            $data->label = $v['name'];//Product::getProductNameById($v['product_id']);

            $color = self::getRandomColor();
            $data->color = $color;
            $data->hight = $color;
            $saleProductData[] = $data;
            unset($data);
        }

        return $saleProductData;
    }

    public static function getRandomColor(){
        $str='0123456789ABCDEF';
        $estr='#';
        $len=strlen($str);
        for($i=1;$i<=6;$i++)
        {
            $num=rand(0,$len-1);
            $estr=$estr.$str[$num];
        }
        return $estr;
    }
}
