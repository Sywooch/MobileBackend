<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Администратор</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    ['label' => 'Заказы', 'icon' => 'fa fa-shopping-cart', 'url' => ['/orders']],
                    ['label' => 'Клиенты', 'icon' => 'fa fa-user-circle', 'url' => ['/clients']],
                    ['label' => 'Товары', 'icon' => 'fa fa-cube', 'url' => ['/products'],],
                    ['label' => 'Категории', 'icon' => 'fa fa-sitemap', 'url' => ['/categories'],],
                    [
                        'label' => 'Настройки',
                        'icon' => 'fa fa-cog',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Смена пароля', 'icon' => 'fa fa-exchange', 'url' => ['/site/change_password'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
