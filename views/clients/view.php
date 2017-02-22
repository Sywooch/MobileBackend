<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clients */
?>
<div class="clients-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'phone',
            'address',
        ],
    ]) ?>

</div>
