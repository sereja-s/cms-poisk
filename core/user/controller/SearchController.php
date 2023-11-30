<?php

namespace core\user\controller;

use core\user\model\Model;

/** 
 * Контроллер системы поиска (Выпуск №156 | Пользовательская часть | поиск по каталогу)
 */
class SearchController extends BaseUser
{
	protected function inputData()
	{
		parent::inputData();

		$goods = $this->search();

		// Выпуск №157 | Пользовательская часть | Личный кабинет список заказов
		$pages = $this->model->getPagination();

		$data['name'] = 'Результаты поиска' . (!empty($_GET['search']) ? ' по запросу: ' . $_GET['search'] : '');

		$this->template = TEMPLATE . 'catalog';

		$dontShowAside = true;


		// +Выпуск №157 | Пользовательская часть | Личный кабинет список заказов
		return compact('goods', 'data', 'dontShowAside', 'pages');
	}

	public function search()
	{
		!$this->model && $this->model = Model::instance();

		$search = $this->clearStr($_GET['search'] ?? '');

		$data = [];

		if ($search) {

			$goodsIds = $this->model->searchGoodsIds($search);

			if ($goodsIds) {

				// Выпуск №157 | Пользовательская часть | Личный кабинет список заказов
				$data = $this->model->getGoods([

					'where' => ['id' => $goodsIds, 'visible' => 1],
					'operand' => ['IN', '='],
					'pagination' => [

						'qty' => $_SESSION['quantities'] ?? QTY,
						'page' => $this->clearNum($_GET['page'] ?? 1) ?: 1
					],
				], ...[false, false]);
			}
		}

		return $data;
	}
}
