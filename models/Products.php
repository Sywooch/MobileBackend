<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $categories_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property double $price
 * @property integer $count
 *
 * @property Orders[] $orders
 * @property Categories $categories
 */
class Products extends \yii\db\ActiveRecord
{
    public $file;

    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categories_id', 'name', 'image', 'price', 'count'], 'required'],
            [['categories_id', 'count'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['name', 'image'], 'string', 'max' => 255],
            [['categories_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['categories_id' => 'id']],
            [['file'], 'image', 'extensions' => 'png, jpg', 'minWidth' => 300, 'minHeight' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categories_id' => 'Категория',
            'name' => 'Наименование',
            'description' => 'Описание',
            'image' => 'Фото',
            'price' => 'Цена',
            'count' => 'Количество',
            'file' => 'Фото',
        ];
    }


    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['product_id' => 'id']);
    }
    

    public function getCategories()
    {
        return $this->hasOne(Categories::className(), ['id' => 'categories_id']);
    }
}
