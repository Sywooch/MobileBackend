<?php

namespace app\controllers;

use app\models\Clients;
use Yii;
use app\models\Products;
use app\models\Categories;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;

class  RestProductsController extends ActiveController
{

    public $modelClass = 'app\models\Products';

//    public function behaviors()
//    {
//        return [
//            [
//                'class' => \yii\filters\ContentNegotiator::className(),
//                'only' => ['index', 'view'],
//                'formats' => [
//                    'application/json' => \yii\web\Response::FORMAT_JSON,
//                ],
//            ],
//        ];
//    }

    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    //http://zappa/web/rest-products/get-category?_format=json
    public function actionGetCategory(){
        $activeData = new ActiveDataProvider([
            'query' => Categories::find(),
            'pagination' => false,
        ]);
        return $activeData;
    }

    //http://zappa/web/rest-products/get-products?_format=json
    public function actionGetProducts(){
        $activeData = new ActiveDataProvider([
            'query' => Products ::find()->where('count > 0'),
            'pagination' => false,
        ]);
        return $activeData;
    }


    public function actionPostOrder(){
        $data = json_decode(json_encode(\Yii::$app->request->post()), true);
        var_dump($data);die;
        if (isset($data) && !empty($data)){
            foreach($data as $item){
                $model = new Clients();
                $model->name = $item['customerName'];
                $model->phone = $item['customerPhone'];
                $model->address = $item['deliveryAddress'];
                $model->save();
                $email = \Yii::$app->mailer->compose()
                    ->setTo('vlad.vasyakot@mail.ru')
                    ->setFrom("crm.urich@gmail.com")
                    ->setSubject('Пришел заказ')
                    ->setTextBody($model->name . " сделал заказ")
                    ->send();
            }
        }
        return 1;
    }
}