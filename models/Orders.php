<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $customerName
 * @property string $customerPhone
 * @property string $deliveryAddress
 * @property integer $count
 * @property integer $status
 * @property double $price
 * @property string $date
 *
 * @property Products $product
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'customerName', 'customerPhone', 'deliveryAddress', 'count', 'status', 'price'], 'required'],
            [['product_id', 'count', 'status'], 'integer'],
            [['price'], 'number'],
            [['date'], 'safe'],
            [['customerName', 'customerPhone', 'deliveryAddress'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Товар',
            'customerName' => 'Клиент',
            'customerPhone' => 'Телефон',
            'deliveryAddress' => 'Адрес доставки',
            'count' => 'Количество',
            'price' => 'Цена',
            'date' => 'Дата заказа',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
