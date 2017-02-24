<?php
use yii\helpers\Html;

$orders = Yii::$app->urlManager->createAbsoluteUrl(['orders/index']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="password-reset">
        <p>Поступил новый заказ!</p>
        <p><?= Html::a('Перейти к заказам', $orders) ?></p>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
