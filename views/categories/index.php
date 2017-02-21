<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
    Modal::begin([
        'header' => '<h4>Добавить категорию</h4>',
        'id' => 'category_modal',
        'size' => 'xs'
    ]);
    echo "<div id='category_model_content'></div>";
    Modal::end();
?>

<div class="row">
    <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Категории</h3>
            </div>
            <div class="box-body no-padding">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="pad">
                            <div class="categories-index">
                                <?= Html::button('Добавить категорию', ['value'=>Url::to(['/categories/create']), 'class'=>'btn btn-success', 'id'=>'category-create']) ?>
                                </p>
                                    <?= GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],

                                            'name',
                                            'description:ntext',

                                            [
                                                'class' => 'yii\grid\ActionColumn',
                                                'template' => '{update} {delete}'
                                            ],
                                        ],
                                    ]); ?>
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
