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
	protected $loaders;

	// Выпуск №143 | Пользовательская часть | Корзина товаров | ч 1
	protected function inputData()
	{
		parent::inputData();

		/* $_SESSION['res']['phone'] = '99999999999'; // сначала данные в форму попадут из сессии
		//unset($_SESSION['res']['phone']);
		// если в сессии необходимых данных не хранится, тогда они в форму попадут из переменной:
		// за это отвечает метод: protected function setFormValues() из BaseUser, который вызывается в полях формы, в которые 
		// данные должны подставляться автоматически (еси они были сохранены)
		$this->userData = [
			'name' => 'Sergey',
			'phone' => '+79491234567',
			'email' => 'mail@mail.ru',
			'address' => 'город улица дом',
			'info' => 'цвет: белый',
		]; */

		$this->delivery = $this->model->get('delivery', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);
		$this->payments = $this->model->get('payments', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);
		$this->loaders = $this->model->get('loaders', [
			'where' => ['visible' => 1],
			'order' => ['menu_position']
		]);

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
