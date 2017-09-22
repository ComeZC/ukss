<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $product_name
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_name'], 'string', 'max' => 50],
            [['product_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getProductMap(){
        return ArrayHelper::map(static::find()->select('id, product_name')->all(), 'id', 'product_name');
    }

    public static function getProductNameById($id){
        $model = static::findOne($id);
        return isset($model->product_name) ? $model->product_name : null;
    }
}
