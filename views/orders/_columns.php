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
        'header' => 'Товар',
        'attribute'=>'product_id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Клиент',
        'attribute'=>'customerName',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Телефон',
        'attribute'=>'customerPhone',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Адрес доставки',
        'attribute'=>'deliveryAddress',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Количество',
        'attribute'=>'count',
    ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'header' => 'Цена',
         'attribute'=>'price',
     ],
     [
         'class'=>'\kartik\grid\DataColumn',
         'header' => 'Дата заказа',
         'attribute'=>'date',
     ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'header' => 'Статус',
        'attribute'=>'status',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   