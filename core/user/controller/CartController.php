<?php

namespace core\user\controller;

/** 
 * Контроллер корзины товаров (Выпуск №143)
 */
class CartController extends BaseUser
{
	// Выпуск №144 | Пользовательская часть | удаление и очистка корзины

	// получим оплату и доставку (объявим свойства)
	protected $delivery;
	protected $payments;

	// Выпуск №143 | Пользовательская часть | Корзина товаров | ч 1
	protected function inputData()
	{
		parent::inputData();

		$this->delivery = $this->model->get('delivery', ['where' => ['visible' => 1]]);
		$this->payments = $this->model->get('payments', ['where' => ['visible' => 1]]);

		if (!empty($this->parameters['alias']) && $this->parameters['alias'] === 'remove') {

			if (!empty($this->parameters['id'])) {

				$this->deleteCartData($this->parameters['id']);
			} else {

				$this->clearCart();
			}

			$this->redirect($this->alias('cart'));
		}
	}
}
