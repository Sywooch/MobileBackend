<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Products[] $products
 */
class Categories extends \yii\db\ActiveRecord
{
    public $file;

    public static function tableName()
    {
        return 'categories';
    }


    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['file'], 'image', 'extensions' => 'png, jpg', 'minWidth' => 300, 'minHeight' => 300],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Категория',
            'description' => 'Описание',
            'file' => 'Фото',
        ];
    }


    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['categories_id' => 'id']);
    }
}
