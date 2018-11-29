<aside class="main-sidebar">

	<section class="sidebar">

        <?
        $typeItems[] = [];
        $tovarTypes = app\models\TovarType::find()->all();
          foreach ($tovarTypes as $tovarType) {
              //print_r($tovarType->TYPE_NAME);
              $typeItems[] = ['label' => $tovarType->TYPE_NAME, 'icon' => 'bookmark', 'url' => ['/admin/preference/tovar-index','type'=>$tovarType->TYPE_ID]];
          }
        ?>
		<?= dmstr\widgets\Menu::widget(
			[
				'options' => ['class' => 'sidebar-menu', 'data-widget' => 'tree',],
				'items'   => [
					['label' => 'Главное меню', 'options' => ['class' => 'header']],
					//['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/admin/dashboard']],
                    [
                        'label' => 'Работа',
                        'icon' => 'bookmark',
                        'url' => ['#'],
                        'items' => [
                            ['label' => 'Загрузить файл', 'icon'  =>  'download', 'url' => ['/admin/packet/index']],
                        ],
                    ],
                    [
                        'label' => 'Справочники',
                        'icon' => 'book',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Точки продаж', 'icon' => 'file-code-o', 'url' => ['/admin/preference/bpos-index'],],
                            [
                                'label' => 'Товары и цены',
                                'icon' => 'file-code-o',
                                'url' => '#',
                                'items' => $typeItems,
                            ],
                            ['label' => 'Типы товаров', 'icon' => 'file-code-o', 'url' => ['/admin/preference/tovar-type-index'],],
                            ['label' => 'Персонал', 'icon' => 'users', /*'url' => ['/admin/users'],*/ 'url' => ['/admin/preference/personal-index'], 'active' => 'users' === Yii::$app->controller->id, ],
                            ['label' => 'Тип сотрудников', 'icon' => 'file-code-o', 'url' => ['/admin/preference/work-index'],],
                        ]
                    ],
                    [
                        'label' => 'Отчеты',
                        'icon' => 'list-alt',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Торговые точки', 'icon' => 'file-code-o', 'url' => ['/admin/operation/bpos-report'],],
                            ['label' => 'Цены', 'icon' => 'file-code-o', 'url' => ['/admin/operation/tovar-price-report'],],
                            //['label' => 'Чеки', 'icon' => 'file-code-o', 'url' => ['/admin/operation/pay-check-index'],],
                            //['label' => 'Внутренний расход', 'icon' => 'file-code-o', 'url' => ['/admin/operation/pay-check-intl-index'],],
                            ['label' => 'Отчет смены', 'icon' => 'file-code-o', 'url' => ['/admin/operation/smena-tb-index'],],
                            ['label' => 'Остатки на торрговых точках', 'icon' => 'file-code-o', 'url' => ['/admin/operation/balance-index'],],
                        ]
                    ],
                    [
                        'label' => 'Сервис',
                        'icon' => 'cog',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Свойства', 'icon'  =>  'gears', 'url' => ['/admin/settings/app']],
                            ['label' => 'Роли/Права', 'icon' => 'lock', 'url' => ['/admin/rbac/permissions'], 'active' => 'permissions' === Yii::$app->controller->id,],
                        ],
                    ],
                    //['label' => 'Окна', 'icon' => 'tasks', 'url' => ['/admin/#']],
                    ['label' => 'О программе', 'icon' => 'tasks', 'url' => ['/admin/#']],
					/*
					[
						'label' => 'Drop example',
						'icon'  => 'share',
						'url'   => '#',
						'items' => [
							['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
							['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
							[
								'label' => 'Level One',
								'icon'  => 'circle-o',
								'url'   => '#',
								'items' => [
									['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
									[
										'label' => 'Level Two',
										'icon'  => 'circle-o',
										'url'   => '#',
										'items' => [
											['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
											['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
										],
									],
								],
							],
						],
					],
					*/
				],
			]
		) ?>

	</section>

</aside>
