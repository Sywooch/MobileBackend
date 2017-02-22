<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Categories;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'image',
        'header' => 'Фото',
        'format' => 'html',
        'value' => function ($data) {
            return Html::img("../../web/".$data['image'],
                ['width' => '70px', 'height' => '70px']);
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Наименование',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Категория',
        'attribute'=>'categories_id',
        'value'=>'categories.name',
        'filter'=>ArrayHelper::map(Categories::find()->asArray()->orderBy('name')->all(), 'id', 'name'),
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Описание',
        'attribute'=>'description',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Цена',
        'attribute'=>'price',
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'header' => 'Количество',
         'attribute'=>'count',
     ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Просмотреть','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Обновить', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Удалить',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   