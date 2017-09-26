<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <!--<div class="user-panel">
            <div class="pull-left image">
                <img src="<?/*= $directoryAsset */?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    /*['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'], 'visible' => \app\models\User::isAdmin()],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'], 'visible' => \app\models\User::isAdmin()],*/
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    /*[
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'visible' => \app\models\User::isAdmin()
                    ],*/
                    ['label' => 'Dashboard', 'icon' => 'home', 'url' => ['/site'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Sales Data', 'icon' => 'database', 'url' => ['/saledata'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Sales Target', 'icon' => 'thumbs-up', 'url' => ['/saletarget'], 'visible' => \app\models\User::isAreaManager()],
                    ['label' => 'Staff Management', 'icon' => 'user', 'url' => ['/staff'], 'visible' => \app\models\User::isAreaManager()],
                    ['label' => 'Area Management', 'icon' => 'sitemap', 'url' => ['/area'], 'visible' => \app\models\User::isAreaManager()],
                    ['label' => 'Product Management', 'icon' => 'suitcase', 'url' => ['/product'], 'visible' => \app\models\User::isGeneralManager()],
                ],
            ]
        ) ?>

    </section>

</aside>
