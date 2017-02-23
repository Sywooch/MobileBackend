<?php
use yii\helpers\Url;

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
        'header' => 'Товары',
        'attribute'=>'product',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Количество товаров',
        'attribute'=>'count',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Имя покупателя',
        'attribute'=>'customerName',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Телефон покупателя',
        'attribute'=>'customerPhone',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Адрес доставки',
        'attribute'=>'deliveryAddress',
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'header' => 'Общая сумма',
         'attribute'=>'price',
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Статус',
        'attribute'=>'status',
        'value'=>'statusName',
        'filter' => array("0"=>"В ожидании", "1"=>"Принято", "2"=>"Отказано", "3"=>"Выдано"),
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'header' => 'Дата заказа',
         'attribute'=>'date',
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