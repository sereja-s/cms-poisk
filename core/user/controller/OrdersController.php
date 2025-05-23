<?php

namespace core\user\controller;

use core\base\model\UserModel;
use core\user\helpers\ValidationHelper;

class OrdersController extends BaseUser
{

	use ValidationHelper;

	protected $delivery = [];
	protected $payments = [];
	protected $loaders = [];

	protected function inputData()
	{
		parent::inputData();

		if ($this->isPost()) {

			// +Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
			// (на вход: 2- подаём: 'join_structure' => true, чтобы реструктурировались массивы и ключами стали: id)
			$this->delivery = $this->model->get('delivery', ['join_structure' => true]);
			$this->payments = $this->model->get('payments', ['join_structure' => true]);
			$this->loaders = $this->model->get('loaders', ['join_structure' => true]);

			$this->order();
		}
	}

	protected function order()
	{
		// Выпуск №147 | Пользовательская часть | Валидация полей заказа

		if (empty($this->cart['goods']) || empty($_POST)) {

			$this->sendError('Отсутствуют данные для оформления заказа');
		}

		// валидационный массив:
		$validation = [
			'name' => [
				'translate' => 'Ваше имя', // перевод поля формы
				'methods' => ['emptyField'] // методы ожидаемые от валидатора для обработки поля
			],
			'phone' => [
				'translate' => 'Телефон',
				'methods' => ['emptyField', 'phoneField', 'numericField']
			],
			'email' => [
				'translate' => 'E-mail',
				'methods' => ['emptyField', 'emailField']
			],
			'delivery_id' => [
				'translate' => 'Способ доставки',
				'methods' => ['emptyField', 'numericField']
			],
			'payments_id' => [
				'translate' => 'Способ оплаты',
				'methods' => ['emptyField', 'numericField']
			],
			'loaders_id' => [
				'translate' => 'Способ разгрузки',
				'methods' => ['emptyField', 'numericField']
			],

		];

		// опишем массив для заказа:
		$order = [];

		// массив для посетителей:
		$visitor = [];



		// получим колонки(поля) из соответствующих таблиц

		$columnsOrders = $this->model->showColumns('orders');

		$columnsVisitors = $this->model->showColumns('visitors');



		foreach ($_POST as $key => $item) {

			if (!empty($validation[$key]['methods'])) {

				foreach ($validation[$key]['methods'] as $method) {

					$_POST[$key] = $item = $this->$method($item, $validation[$key]['translate'] ?? $key);
				}
			}

			if (!empty($columnsOrders[$key])) {

				$order[$key] = $item;
			}
			if (!empty($columnsVisitors[$key])) {

				$visitor[$key] = $item;
			}
		}

		// Выпуск №149 | Пользовательская часть | сохранение заказа
		if (empty($visitor['email']) && empty($visitor['phone'])) {

			$this->sendError('Отсутствуют данные пользователя для оформелния заказа');
		}

		$visitorsWhere = $visitorsCondition = [];

		if (!empty($visitor['email']) && !empty($visitor['phone'])) {

			$visitorsWhere = [
				'email' => $visitor['email'],
				'phone' => $visitor['phone']
			];

			$visitorsCondition = ['OR'];
		} else {

			$visitorsKey = !empty($visitor['email']) ? 'email' : 'phone';

			$visitorsWhere[$visitorsKey] = $visitor[$visitorsKey];
		}

		$resVisitor = $this->model->get('visitors', [
			'where' => $visitorsWhere,
			'condition' => $visitorsCondition,
			'limit' => 1
		]);

		if ($resVisitor) {

			$resVisitor = $resVisitor[0];

			$order['visitors_id'] = $resVisitor['id'];

			// иначе пользователя необходимо создать(зарегистрировать) и записать его в заказ
		} else {

			$order['visitors_id'] = $this->model->add('visitors', [
				'fields' => $visitor,
				'return_id' => true // указали ключ, чтобы вернулся id (Выпуск №157 | Пользовательская часть | Личный кабинет список заказов)
			]);
		}

		// после того как зарегистрировали пользователя, формируем оставшиеся данные о заказе:
		$order['total_sum'] = $this->cart['total_sum'];

		$order['total_old_sum'] = $this->cart['total_old_sum'];

		$order['total_qty'] = $this->cart['total_qty'];


		$baseStatus = $this->model->get('orders_statuses', [
			'fields' => ['id'],
			'order' => ['menu_position'],
			'limit' => 1
		]);

		$baseStatus && $order['orders_statuses_id'] = $baseStatus[0]['id'];


		// добавляем заказ
		$order['id'] = $this->model->add('orders', [
			'fields' => $order,
			'return_id' => true
		]);

		if (!$order['id']) {

			$this->sendError('Ошибка сохранения заказа. Свяжитесь с администрацией сайта по телефону - ' . $this->set['phone']);
		}

		// если у нас не было такого пользователя
		if (!$resVisitor) {

			UserModel::instance()->checkUser($order['visitors_id']);
		}

		// Выпуск №150 | Пользовательская часть | сохранение товаров заказа 
		// +Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
		if (!($goods = $this->setOrdersGoods($order))) {

			$this->sendError('Ошибка сохранения товаров заказа. Обратитесь к администрации сайта');
		}

		// -Выпуск №157 | Пользовательская часть | Личный кабинет список заказов
		$this->sendSuccess('Спасибо за заказ! В ближайшее время наш специалист свяжется с Вами для уточнения деталей');


		// +Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
		$order['delivery'] = $this->delivery[$order['delivery_id']]['name'] ?? '';
		$order['payments'] = $this->payments[$order['payments_id']]['name'] ?? '';
		$order['loaders'] = $this->payments[$order['loaders_id']]['name'] ?? '';

		// +Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
		$this->sendOrderEmail(['order' => $order, 'visitor' => $visitor, 'goods' => $goods]);

		$this->clearCart();

		// -Выпуск №157 | Пользовательская часть | Личный кабинет список заказов
		$this->redirect();
		// +Выпуск №157 | Пользовательская часть | Личный кабинет список заказов
		//$this->sendSuccess('Спасибо за заказ! В ближайшее время наш специалист свяжется с Вами для уточнения деталей');
	}

	/** 
	 * метод сохранения товаров заказа (Выпуск №150)
	 * 
	 * здесь- возвращаем null или array (+Выпуск №151)
	 */
	protected function setOrdersGoods(array $order): ?array
	{
		// проверим есть ли таблица с товарами заказов
		if (in_array('orders_goodsnew', $this->model->showTables())) {

			// переменная для хранения массива товаров заказа с полями из таблицы: orders_goodsnew			 
			$ordersGoods = [];

			// +Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
			$preparedGoods = [];

			// пробежимся по товарам в корзине
			foreach ($this->cart['goods'] as $key => $item) {

				// сохраним идентификатор заказа
				$ordersGoods[$key]['orders_id'] = $order['id'];

				// +Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
				$preparedGoods[$key] = $item;
				$preparedGoods[$key]['total_sum'] = $item['qty'] * $item['price'];

				// пробежимся по полям из таблицы: goods каждого товара в корзине
				foreach ($item as $field => $value) {

					// проверим есть ли такое поле в связующей таблице (здесь- orders_goodsnew)
					if (!empty($this->model->showColumns('orders_goodsnew')[$field])) {

						// проверим является ли поле, которое пришло идентификатором: id
						if ($this->model->showColumns('orders_goodsnew')['id_row'] === $field) {

							if ($this->model->showColumns('orders_goodsnew')['goodsnew_id']) {

								$ordersGoods[$key]['goodsnew_id'] = $value;
							}
						} else {

							$ordersGoods[$key][$field] = $value;
						}
					}
				}
			}

			// если товары заказа добавились в БД
			if ($this->model->add('orders_goodsnew', [

				'fields' => $ordersGoods
			])) {

				// +Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
				return $preparedGoods;
			}
		}

		// +Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
		return null;
	}

	/** 
	 * Метод отправки заказа по Email
	 * 
	 * Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
	 */
	protected function sendOrderEmail(array $orderData)
	{

		// Интернет магазин с нуля на php Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
		$dir = TEMPLATE . 'include/orderTemplates/';

		// в переменную собираем шаблоны заказа
		$templatesArr = [];

		if (is_dir($dir)) {

			// scandir — Получает список файлов и каталогов(массив), расположенных по указанному пути
			$list = scandir($dir);

			foreach ($orderData as $name => $item) {

				// используем поиск в массиве по регулярному выражению
				// preg_grep- возвращает массив, состоящий из элементов входящего массива: array(на вход 2-ой), которые 
				// соответствуют заданному шаблону: pattern(на вход 1-ый)
				if ($file = preg_grep('/^' . $name . '\./', $list)) {

					// array_shift — Извлекает первый элемент массива
					$file = array_shift($file);

					// file_get_contents — Читает содержимое файла в строку
					$template = file_get_contents($dir . $file);

					// is_numeric — Проверяет, является ли переменная числом или строкой, содержащей число
					// key() возвращает индекс текущего элемента массива
					if (!is_numeric(key($item))) {

						$templatesArr[] = $this->renderOrderMailTemplate($template, $item);
					} else {

						if (($common = preg_grep('/' . $name . 'Header\./', $list))) {

							$common = array_shift($common);

							$templatesArr[] = $this->renderOrderMailTemplate(file_get_contents($dir . $common), []);
						}

						// запустим цикл по товарам заказа
						foreach ($item as $value) {

							$templatesArr[] = $this->renderOrderMailTemplate($template, $value);
						}


						if (($common = preg_grep('/' . $name . 'Footer\./', $list))) {

							$common = array_shift($common);

							$templatesArr[] = $this->renderOrderMailTemplate(file_get_contents($dir . $common), []);
						}
					}
				}
			}

			$sender = new SendMailController();

			$sender->setMailBody($templatesArr)->send($orderData['visitor']['email']);
		}
	}

	/** 
	 * Метод для отбражение данных в шаблонах письма заказа
	 * 
	 * Выпуск №151 | Пользовательская часть | подготовка почтовых шаблонов
	 */
	protected function renderOrderMailTemplate(string $template, array $data): string
	{

		foreach ($data as $key => $item) {

			$template = preg_replace('/#' . $key . '#/i', $item, $template);
		}

		return $template;
	}
}
