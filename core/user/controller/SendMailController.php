<?php

namespace core\user\controller;

use core\user\model\Model;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Выпуск №152 | Пользовательская часть | отправка уведомлений на email
class SendMailController extends BaseUser
{

	private $_body = '';
	private $_ErrorInfo = '';


	protected function inputData()
	{

		parent::inputData();
	}


	public function setMailBody($body)
	{

		if (is_array($body)) {

			$body = implode("\n", $body);
		}

		$this->_body .= $body;

		return $this;
	}

	// на вход 1-почта пользователя
	public function send($email = null, $subject = null)
	{
		!$this->model && $this->model = Model::instance();

		$to = [];

		if (!$this->set) {

			$this->set = $this->model->get('settings', [
				'order' => ['id'], // сортируем по полю: id
				'limit' => 1
			]);

			// получили почту из настроек сйта
			$this->set && $to[] = $this->set[0]['email'];
		}

		if ($email) {

			$to[] = $email;
		}


		$mail = new PHPMailer(true);

		try {
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                              						// Отправка с помощью SMTP 
			$mail->Host       = 'smtp.yandex.ru'; // Установите SMTP-сервер для отправки(адрес почтового сервера-Исходящая почта)
			$mail->SMTPAuth   = true;                                   // Включить аутентификацию SMTP
			$mail->Username   = 'stroykontakt-don';                     //SMTP username (с аккаунта почты)
			$mail->Password   = 'mwraoihetvpevewg';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Включить неявное шифрование TLS
			$mail->Port       = 465;                                    // TCP порт для подключения; используйте 587, 
			// если вы установили `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients - Получатели

			// указали от кого письма и текст (заголовок письма)
			$mail->setFrom('stroykontakt-don@yandex.ru', 'Заявка с интернет-магазина ' . $_SERVER['HTTP_HOST']);

			//$mail->addAddress('joe@example.net', 'Joe User');     // Добавить получателя

			// Кому письмо
			foreach ($to as $adress) {

				$mail->addAddress($adress);
			}


			// добавить ответ на
			$mail->addReplyTo('stroykontakt-don@yandex.ru');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			// Как отправляем файлы для отправки
			//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name


			//Content
			$mail->isHTML(true);
			$mail->CharSet = 'UTF-8';

			// Установите формат электронной почты на HTML
			$mail->Subject = $subject ?: 'Заявка с интернет-магазина ' . $_SERVER['HTTP_HOST'];
			$mail->Body = $this->_body;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();

			return true;
		} catch (Exception $e) {

			$this->_ErrorInfo = $mail->ErrorInfo;
		}

		return false;
	}

	public function getMailError()
	{

		return $this->_ErrorInfo;
	}
}
