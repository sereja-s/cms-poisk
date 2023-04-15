<?php

namespace core\user\controller;

use core\admin\model\Model;
use core\base\controller\BaseController;

/** 
 * Индексный контроллер пользовательской части (для тестов)
 */
class IndexTestController extends BaseUser
{

	// Выпуск №12
	//use trait1;
	//use trait2;
	//use trait1, trait2;
	//use trait1, trait2 {
	// если трейты имеют одноимённые методы, необходимо указать метод какого трейта является приоритетным
	// например можем записать-  методом: who() 1-го трейта заменить одноимённый метод 2-го трейта
	//trait1::who insteadof trait2;
	// или наоборот
	//trait2::who insteadof trait1;
	//}

	//use trait1, trait2 {
	// что бы пользоваться методами обоих трейдов, необходимо методу трейта, который заменили дать псевдоним
	// теперь этот метод можно вызыввать по псевдониму
	//trait1::who insteadof trait2;
	// (псевдоним можно объявить только для метода, который уже переопределён (замещён) иным метоодом !!!)
	//trait2::who as who2;
	//}

	protected function inputData()
	{
		// Выпуск №120
		parent::inputData();

		// Выпуск №125
		$goods = $this->model->getGoods();

		// Выпуск №124
		/* $years = $this->wordsForCounter(50384);
		$a = 1; */

		// Выпуск №121
		$alias = '';
		$res = $this->alias();
		$res2 = $this->alias('catalog');
		$res3 = $this->alias('catalog', '?page=2');
		// допустили ошибку в адресе
		$res4 = $this->alias('catalog//auto', '?page=2');
		$res5 = $this->alias(['catalog' => 'auto'], '?page=2');
		$res5 = $this->alias(['catalog' => 'auto', 'girl' => 'Maria'], '?page=2');
		$res6 = $this->alias(['catalog' => 'auto', 'girl' => 'Maria'], 'page=2');
		$res7 = $this->alias(['catalog' => 'auto', 'girl' => 'Maria'], ['page' => 1, 'order' => 'desc']);


		// Выпуск №121
		// $res = $this->img(false, true);


		echo $this->getController();
		exit;
	}
}
