<?php

namespace core\user\controller;

use core\admin\model\Model;
use core\base\controller\BaseController;


class AmkController extends BaseUser
{

	protected function inputData()
	{
		// Выпуск №120
		parent::inputData();

		$section_top = $this->model->get('section_top', ['limit' => 1]);

		$section_top = $section_top[0];

		$services = $this->model->get('services', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);
		$amkColors = $this->model->get('amk_colors', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);

		return compact('section_top', 'services', 'amkColors');
	}
}
