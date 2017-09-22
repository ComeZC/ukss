<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Area;

/**
 * AreaSearch represents the model behind the search form about `\app\models\Area`.
 */
class AreaSearch extends Area
{
    public $createTimeRange;
    public $updateTimeRange;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_area'], 'integer'],
            [['area_code', 'area_name', 'area_desc', 'area_address', 'area_zipcode', 'area_phone', 'created_at', 'updated_at'], 'safe'],
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
        $query = Area::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
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
            'parent_area' => $this->parent_area,
            //'created_at' => $this->created_at,
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

        $query->andFilterWhere(['like', 'area_code', $this->area_code])
            ->andFilterWhere(['like', 'area_name', $this->area_name])
            ->andFilterWhere(['like', 'area_desc', $this->area_desc])
            ->andFilterWhere(['like', 'area_address', $this->area_address])
            ->andFilterWhere(['like', 'area_zipcode', $this->area_zipcode])
            ->andFilterWhere(['like', 'area_phone', $this->area_phone]);

        return $dataProvider;
    }
}
