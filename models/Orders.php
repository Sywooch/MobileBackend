<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $product
 * @property string $customerName
 * @property string $customerPhone
 * @property string $deliveryAddress
 * @property string $count
 * @property integer $status
 * @property double $price
 * @property string $date
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
            [['product', 'customerName', 'customerPhone', 'deliveryAddress', 'count', 'status', 'price'], 'required'],
            [['status'], 'integer'],
            [['price'], 'number'],
            [['date'], 'safe'],
            [['product', 'customerName', 'customerPhone', 'deliveryAddress', 'count'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => 'Товары',
            'customerName' => 'Имя покупателя',
            'customerPhone' => 'Телефон покупателя',
            'deliveryAddress' => 'Адрес доставки',
            'count' => 'Количество',
            'status' => 'Статус',
            'price' => 'Общая цена',
            'date' => 'Дата заказа',
        ];
    }
    
    public function getProduct($id){
        return Products::find()->where('id='.$id)->one();
    }
}
