<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
?>
<div class="orders-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product',
            'count',
            'customerName',
            'customerPhone',
            'deliveryAddress',
            'price',
            [
                'attribute' => 'status',
                'value' => $model->statusName,
            ],
            'date',
        ],
    ]) ?>

</div>
