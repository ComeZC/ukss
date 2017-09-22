<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SaleData;

/**
 * SaleDataSearch represents the model behind the search form of `\app\models\SaleData`.
 */
class SaleDataSearch extends SaleData
{
    public $createTimeRange;
    public $updateTimeRange;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['user_id'], 'string'],
            [['imei1', 'imei2', 'created_at', 'updated_at'], 'safe'],
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
        $query = SaleData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        if(!\app\models\User::isGeneralManager() && empty(Yii::$app->user->getIdentity()->user_area)){
            $query->where('0=1');
            return $dataProvider;
        }

        if(!User::isAreaManager()){
            $query->andFilterWhere(['user_id' => Yii::$app->user->getIdentity()->id]);
        }else{
            if(isset($params['SaleDataSearch']['user_id'])){
                if(\app\models\User::isGeneralManager()){
                    $area = null;
                }else{
                    $area = Yii::$app->user->getIdentity()->user_area;
                }
                $searchUserIdArr = Staff::searchStaffInMyArea($params['SaleDataSearch']['user_id'], $area);
                $query->andFilterWhere(['user_id' => array_keys($searchUserIdArr)]);
            }else{
                //区域经理只能查看属于自己区域的用户的数据
                if(!\app\models\User::isGeneralManager()){
                    $userIdArr = Staff::getStaffInMyArea(Yii::$app->user->getIdentity()->user_area);
                    $query->andFilterWhere(['user_id' => array_keys($userIdArr)]);
                }
            }
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            //'user_id' => $this->user_id,
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

        $query->andFilterWhere(['like', 'imei1', $this->imei1])
            ->andFilterWhere(['like', 'imei2', $this->imei2]);

        return $dataProvider;
    }
}
