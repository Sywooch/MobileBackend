<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
?>
<div class="products-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'image',
                'value'=>function ($data) {
                    return Html::img("../../web/".$data['image'],
                        ['width' => '70px', 'height' => '70px']);
                },
                'format' => 'html',
            ],
            'name',
            [
                'attribute'=>'categories_id',
                'value'=>$model->categories->name,
            ],
            'description:ntext',
            'price',
            'count',
        ],
    ]) ?>

</div>
