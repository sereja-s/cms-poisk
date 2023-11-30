<?php

namespace core\user\controller;

use core\base\exceptions\RouteException;
use core\base\model\UserModel;
use core\user\helpers\ValidationHelper;

// Выпуск №154 | Пользовательская часть | регистрация
class LoginController extends BaseUser
{

	use ValidationHelper;

	// Выпуск №154 | Пользовательская часть | регистрация пользователя
	protected function inputData()
	{
		parent::inputData();

		if (!empty($this->parameters['alias'])) {

			switch ($this->parameters['alias']) {

				case 'registration':

					$this->registration();
					break;

				case 'login':

					$this->login();
					break;
			}
		}

		throw new RouteException('Такой страницы не существует');
	}

	// Выпуск №155 | Пользовательская часть | авторизация
	protected function login()
	{
		$email = $this->clearStr($_POST['email'] ?? '');
		$password = $this->clearStr($_POST['password'] ?? '');

		if (!$email || !$password) {

			$this->sendError('Заполните поля для авторизации');
		}

		$password = md5($password);

		$res = $this->model->get('visitors', [

			'where' => ['email' => $email, 'password' => $password],
			'limit' => 1
		]);

		if (!$res) {

			$this->sendError('Не корректные данные для входа');
		}

		// если пользовательская модель зарегистрировала пользователя с полученным id
		if (UserModel::instance()->checkUser($res[0]['id'])) {

			$this->sendSuccess('Добро пожаловать, ' . $res[0]['name']);
		}

		$this->sendError('Произошла внутренняя ошибка Свяжитесь с администрацией сайта');
	}

	protected function registration(): void
	{

		if (!$this->isPost()) {

			throw new RouteException('Такой страницы не существует');
		}

		$_POST['password'] = trim($_POST['password'] ?? '');
		$_POST['confirm_password'] = trim($_POST['confirm_password'] ?? '');

		// если пользователь существует и пароль менять не хочет
		if ($this->userData && !$_POST['password']) {

			unset($_POST['password']);
		} elseif (!$this->userData && !trim($_POST['password'])) {

			// Выпуск №155 | Пользовательская часть | авторизация
			$this->sendError('Заполните поле пароль');
		}

		if (isset($_POST['password']) && $_POST['password'] !== $_POST['confirm_password']) {

			$this->sendError('Пароли не совпадают');
		}

		unset($_POST['confirm_password']);

		$validation = [

			'name' => [

				'translate' => 'Ваше имя',
				'methods' => ['emptyField']
			],
			'phone' => [

				'translate' => 'Телефон',
				'methods' => ['emptyField', 'phoneField', 'numericField']
			],
			'email' => [

				'translate' => 'E-mail',
				'methods' => ['emptyField', 'emailField']
			],

		];

		foreach ($_POST as $key => $item) {

			if (!empty($validation[$key]['methods'])) {

				foreach ($validation[$key]['methods'] as $method) {

					$_POST[$key] = $item = $this->$method($item, $validation[$key]['translate'] ?? $key);
				}
			}
		}


		// Сформируем запрос по которому будем искать в БД пользователя с указанным телефоном или эл.почтой:

		$where = [
			'phone' => $_POST['phone'],
			'email' => $_POST['email'],
		];

		// в переменную сохраним условие: ИЛИ (т.е здесь- или phone = phone, или email = email)
		$condition[] = 'OR';

		$res = $this->model->get('visitors', [
			'where' => $where,
			'condition' => $condition,
			'limit' => 1
		]);

		if ($res) {

			$res = $res[0];

			$field = $res['phone'] === $_POST['phone'] ? 'телефон' : 'email';

			$this->sendError('Такой ' . $field . '  уже зарегистрирован');
		}

		// Выпуск №155 | Пользовательская часть | авторизация
		if (!empty($_POST['password'])) {

			$_POST['password'] = md5($_POST['password']);
		}

		// добавляем посетителя в БД (т.к. все проверки прошёл)
		$id = $this->model->add('visitors', [

			// нам нужен идентификатор пользователя(посетителя)
			'return_id' => true
		]);

		// зарегистрируем пользователя
		if (!empty($id)) {

			if (UserModel::instance()->checkUser($id)) {

				$this->sendSuccess('Спасибо за регистрацию, ' . $_POST['name']);
			}
		}

		$this->sendError('Произошла внутренняя ошибка Свяжитесь с администрацией сайта');
	}
}
