<?php

namespace app\modules\admin\controllers;

/**
 * Class SettingsControllerBack
 *
 * @package app\modules\admin\controllers
 */
class SettingsControllerBack extends Controller
{
	/**
	* @inheritdoc
	*/
	public function actions()
	{
		return [
			'app' => [
				'class' => 'justcoded\yii2\settings\actions\SettingsAction',
				'modelClass' => 'justcoded\yii2\settings\forms\AppSettingsForm',
			],
		];
	}
}