<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
?>
<div class="orders-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_id',
            'customerName',
            'customerPhone',
            'deliveryAddress',
            'count',
            'status',
            'price',
            'date',
        ],
    ]) ?>

</div>