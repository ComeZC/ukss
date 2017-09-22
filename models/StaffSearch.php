<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Staff;

/**
 * StaffSearch represents the model behind the search form about `\app\models\Staff`.
 */
class StaffSearch extends Staff
{
    public $createTimeRange;
    public $updateTimeRange;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_role', 'user_status', 'user_area'], 'integer'],
            [['user_name', 'user_pwd', 'user_gender', 'user_desc', 'user_phone', 'created_at', 'updated_at'], 'safe'],
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
        $query = Staff::find();

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
            'user_role' => $this->user_role,
            'user_status' => $this->user_status,
            'user_area' => $this->user_area,
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

        $query->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'user_pwd', $this->user_pwd])
            ->andFilterWhere(['like', 'user_gender', $this->user_gender])
            ->andFilterWhere(['like', 'user_desc', $this->user_desc])
            ->andFilterWhere(['like', 'user_phone', $this->user_phone]);

        return $dataProvider;
    }
}
