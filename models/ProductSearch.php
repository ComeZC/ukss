<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `\app\models\Product`.
 */
class ProductSearch extends Product
{
    public $createTimeRange;
    public $updateTimeRange;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['product_name', 'created_at', 'updated_at'], 'safe'],
            [['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
            [['updateTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
           // 'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
        ]);

        if(!empty($this->createTimeRange) && strpos($this->createTimeRange, ' - ')!==false){
            list($createTimeStart, $createTimeEnd) = explode(' - ', $this->createTimeRange);
            $query->andFilterWhere(['>=', 'created_at', $createTimeStart])
                ->andFilterWhere(['<', 'created_at', $createTimeEnd]);
        }

        if(!empty($this->updateTimeRange) && strpos($this->updateTimeRange, ' - ')!==false){
            list($updateTimeStart, $updateTimeEnd) = explode(' - ', $this->updateTimeRange);
            $query->andFilterWhere(['>=', 'updated_at', $updateTimeStart])
                ->andFilterWhere(['<', 'updated_at', $updateTimeEnd]);
        }

        $query->andFilterWhere(['like', 'product_name', $this->product_name]);

        return $dataProvider;
    }
}
