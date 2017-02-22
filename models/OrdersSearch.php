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
            [['id', 'product_id', 'count', 'status'], 'integer'],
            [['customerName', 'customerPhone', 'deliveryAddress', 'date'], 'safe'],
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
        $query = Orders::find();

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
            'product_id' => $this->product_id,
            'count' => $this->count,
            'status' => $this->status,
            'price' => $this->price,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'customerName', $this->customerName])
            ->andFilterWhere(['like', 'customerPhone', $this->customerPhone])
            ->andFilterWhere(['like', 'deliveryAddress', $this->deliveryAddress]);

        return $dataProvider;
    }
}
