<?php

namespace core\user\controller;

/** 
 * Выпуск №157 | Пользовательская часть | Личный кабинет список заказов
 */
class LkController extends BaseUser
{
	protected function inputData()
	{
		parent::inputData();

		if (!$this->userData) {

			$this->redirect();
		}

		$orders = $currentOrder = null;

		$orders = $this->model->get('orders', [

			'where' => ['visitors_id' => $this->userData['id']],
			'order' => ['date'],
			'order_direction' => ['DESC'],
			'join' => [
				'orders_goodsnew' => [
					'on' => ['id', 'orders_id']
				],
				'payments' => [
					'on' => [
						'table' => 'orders',
						'fields' => ['payments_id', 'id']
					]
				],
				'delivery' => [
					'on' => [
						'table' => 'orders',
						'fields' => ['delivery_id', 'id']
					]
				],
				'orders_statuses' => [
					'on' => [
						'table' => 'orders',
						'fields' => ['orders_statuses_id', 'id']
					]
				],
			],
			'join_structure' => true
		]);

		if ($orders) {

			foreach ($orders as $key => $item) {

				if (!empty($item['join'])) {

					foreach ($item['join'] as $k => $value) {

						if ($k !== 'orders_goodsnew') {

							$orders[$key]['join'][$k] = array_shift($value);
						}
					}
				}
			}
			if (!empty($this->parameters['id']) && !empty($orders[$this->parameters['id']])) {

				$currentOrder = $orders[$this->parameters['id']];
			}
		}

		$this->styles[] = PATH . TEMPLATE . 'assets/css/lk.css';

		return compact('orders', 'currentOrder');
	}
}
