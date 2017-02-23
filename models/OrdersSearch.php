<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['product', 'customerName', 'customerPhone', 'deliveryAddress', 'count', 'date'], 'safe'],
            [['price'], 'number'],
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
        $query = Orders::find()->orderBy('date DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'price' => $this->price,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'customerName', $this->customerName])
            ->andFilterWhere(['like', 'customerPhone', $this->customerPhone])
            ->andFilterWhere(['like', 'deliveryAddress', $this->deliveryAddress])
            ->andFilterWhere(['like', 'count', $this->count]);

        return $dataProvider;
    }
}
