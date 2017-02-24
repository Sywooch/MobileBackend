<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\Categories;
use yii\bootstrap\Html;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Clients;
use app\models\Orders;

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


    public function actionPostRequest(){
        $data = json_decode(json_encode(\Yii::$app->request->post()), true);
        $names = '';
        $count = 0;
        $price = 0;
        if (isset($data) && !empty($data)) {
            foreach($data as $method){
                if($method['method'] == 'getCategory'){
                    $activeData = new ActiveDataProvider([
                        'query' => Categories::find(),
                        'pagination' => false,
                    ]);
                    return $activeData;
                }
                if($method['method'] == 'getProducts'){
                    $activeData = new ActiveDataProvider([
                        'query' => Products ::find()->where('count > 0'),
                        'pagination' => false,
                    ]);
                    return $activeData;
                }
                if($method['method'] == 'postOrder'){
                    foreach($data as $item){
                        //Заполнение таблицы Клиенты (имя, телефон, адрес)
                        $model = new Clients();
                        $model->name = $item['customerName'];
                        $model->phone = $item['customerPhone'];
                        $model->address = $item['deliveryAddress'];

                        //Заполнение таблицы Заказы
                        $model_orders = new Orders();
                        $model_orders->customerName = $item['customerName'];
                        $model_orders->customerPhone = $item['customerPhone'];
                        $model_orders->deliveryAddress = $item['deliveryAddress'];
                        foreach ($item['orderedProductIds'] as $product){
                            $names .= $model_orders->getProduct($product['productId'])->name . ', ';
                            $count += $product['productCount'];
                            $price += $model_orders->getProduct($product['productId'])->price * $product['productCount'];
                        }
                        $model_orders->product = substr($names, 0, -2);
                        $model_orders->count = $count;
                        $model_orders->status = 0;
                        $model_orders->price = $price;
                        
                        $model->save();
                        $model_orders->save();
                        \Yii::$app->mailer->compose(
                            ['html' => 'layouts/html']
                        )
                            ->setTo('vlad.vasyakot@mail.ru')
                            ->setFrom("crm.urich@gmail.com")
                            ->setSubject('Пришел новый заказ')
                            ->send();
                    }
                    return 1;
                } else {
                    return 0;
                }
            }
        }
    }
}