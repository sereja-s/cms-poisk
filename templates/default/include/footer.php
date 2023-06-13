</main>

<!-- footer start-->
<footer class="footer">
	<div class="container">
		<div class="footer__wrapper">

			<div class="footer__info">

				<a href="#" class="footer__logo-link">
					<img class="footer__logo-img" src="<?= PATH . TEMPLATE ?>assets/img/строй_контакт.png" alt="СТРОЙ КОНТАКТ">
				</a>

			</div>

			<ul class="footer__nav">

				<li class="footer__nav-item"><a class="footer__nav-link" href="<?= $this->alias('catalog') ?>">Все товары</a></li>
				<li class="footer__nav-item"><a class="footer__nav-link" href="<?= $this->alias('news') ?>">Новости</a></li>
				<li class="footer__nav-item"><a class="footer__nav-link" href="<?= $this->alias('contacts') ?>">Контакты</a></li>

			</ul>

			<ul class="footer__nav">

				<?php if (!empty($this->menu['information'])) : ?>

					<?php foreach ($this->menu['information'] as $item) : ?>

						<li class="footer__nav-item"><a class="footer__nav-link" href="<?= $this->alias(['information' => $item['alias']]) ?>"><?= $item['name'] ?></a></li>

					<?php endforeach; ?>

				<?php endif; ?>

			</ul>


		</div>
	</div>

	<div class="footer__info-footer">

		<!-- footer phone -->
		<div class="footer__phone">
			<a href="tel:+3809715095655">+7(949)123-456-78</a>
		</div>

		<?php if (!empty($this->socials)) : ?>

			<div class="footer__social">

				<?php foreach ($this->socials as $item) : ?>

					<!-- social link -->

					<a class="footer__social-link" href="<?= $this->alias($item['external_alias']) ?>"><img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>"></a>


				<?php endforeach; ?>

			</div>

		<?php endif; ?>

	</div>

	<!-- footer copyright start -->
	<div class="footer__copyright">
		<div class="container">
			<p class="footer__copyright-text">Обращаем Ваше внимание на&nbsp;то, что данный интернет-сайт носит
				исключительно информационный характер и&nbsp;ни&nbsp;при каких условиях информационные материалы
				и&nbsp;цены,
				размещенные на&nbsp;сайте, не&nbsp;являются публичной офертой, определяемой положениями
				Гражданского кодекса&nbsp;
			</p>
			<div class="footer__props" style="text-align: center;">
				<span style="padding-right: 5px;">сделано в</span>
				<a href="<?= $this->set['external_alias'] ?>">САЙТ ПОСТРОЕН</a>
				<span style="padding-left: 5px;"><?= $this->set['number_of_years'] ?></span>
			</div>
		</div>
	</div>
	<!-- footer copyright end -->
</footer>
<!-- footer end-->


<!-- popup modal start-->
<div id="change-city-popup" class="white-popup mfp-hide">
	<div class="change-city-popup">
		<h4 class="change-city-popup__title">Выберите город</h4>
	</div>

	<input class="change-city-popup__input" type="text" placeholder="Начните вводить">

	<ul class="change-city-popup__list">
		<li class="change-city-popup__item">
			<a class="change-city-popup__link" href="#">Львов</a>
		</li>
		<li class="change-city-popup__item">
			<a class="change-city-popup__link" href="#">Киев</a>
		</li>
		<li class="change-city-popup__item">
			<a class="change-city-popup__link" href="#">Виница</a>
		</li>
		<li class="change-city-popup__item">
			<a class="change-city-popup__link" href="#">Херсон</a>
		</li>
		<li class="change-city-popup__item">
			<a class="change-city-popup__link" href="#">Житомер</a>
		</li>
		<li class="change-city-popup__item">
			<a class="change-city-popup__link" href="#">Одесса</a>
		</li>
		<li class="change-city-popup__item">
			<a class="change-city-popup__link" href="#">Ифано-Франковск</a>
		</li>
		<li class="change-city-popup__item">
			<a class="change-city-popup__link" href="#">Чернигов</a>
		</li>
	</ul>
</div>

<div id="popup-lk" class="white-popup mfp-hide">
	<div class="popup-form">
		<h4 class="popup-form__title">Вход в личный кабинет</h4>

		<div class="popup-form__text popup-form__text-center">
			Введите номер телефона. Вам будет выслан код с паролем по смс
		</div>

		<div class="popup-form__item">
			<label class="popup-form__lable">Телефон</label>
			<input class="popup-form__input popup-form__mask-phone-number" type="text" placeholder="(093)-00-00-000">
		</div>

		<div class="popup-form__text">
			Код будет отправлен через 50 секунд.....
		</div>

		<button class="popup-form__submit" type="submit">Повторить отправку</button>
	</div>
</div>

<div id="popup-sms" class="white-popup mfp-hide">
	<div class="popup-form">
		<h4 class="popup-form__title">Введите код из смс</h4>

		<div class="popup-form__text">
			Мы отправили код на телефон с номером<br>
			<b>+38 (098) .....23</b>
		</div>

		<div class="popup-form__item">
			<div class="popup-form__item">
				<div class="popup-form__input-sms-wrapper">
					<input class="popup-form__input-sms" type="text">
					<input class="popup-form__input-sms" type="text">
					<input class="popup-form__input-sms" type="text">
					<input class="popup-form__input-sms" type="text">
				</div>
			</div>
		</div>

		<div class="popup-form__text">
			Отправить код повторно через 02:24
		</div>

		<div class="popup-form__text-center">
			<button class="popup-form__submit" type="submit">Войти</button>
		</div>
	</div>
</div>

<div id="popup-buy-one-click" class="white-popup mfp-hide">
	<div class="popup-form">
		<h4 class="popup-form__title">Купить в 1 клик</h4>

		<div class="popup-form__item">
			<label class="popup-form__lable">Имя</label>
			<input class="popup-form__input" type="text">
		</div>
		<div class="popup-form__item">
			<label class="popup-form__lable">Телефон</label>
			<input class="popup-form__input popup-form__mask-phone-number" type="text" placeholder="(093)-00-00-000">
		</div>

		<div class="popup-form__text">
			Укажите Ваше имя и свой номер телефона для оформления заказа. Оператор перезвонит Вам, чтобы подтвердить
			заказ и
			согласовать детали доставки.
		</div>

		<div class="popup-form__text-center">
			<button class="popup-form__submit" type="submit">Купить</button>
		</div>
	</div>
</div>

<div id="popup-search" class="search-popup-bg  mfp-hide">
	<div class="search-popup__form">
		<input class="search-popup__input" type="search" name="search" placeholder="поиск">
		<input type="hidden" name="search_table" value="goodsnew">
	</div>

	<ul class="search-popup__category-list">
		<li class="search-popup__category-item search_res">
			<!-- <a href="#" class="search-popup__category-link"></a> -->
		</li>
	</ul>
	<style>
		/* Изменить цвет выпадающих ссылок при наведении */
		.search-popup__category-item a.search_act {
			background-color: #e5e5e5
		}
	</style>

	<!-- <div class="search-popup__product-list">
		<div class="search-popup__product-item">
			<div class="search-popup__product-left">
				<div class="search-popup__product-image">
					<a href="#">
						<img class="search-popup__product-img" src="<?= PATH . TEMPLATE ?>assets/img/hol-1.png" alt="">
					</a>
				</div>

				<div class="search-popup__product-header">
					<a href="#" class="search-popup__product--title">Холодильник Electrolux EWH 80 Formax</a>

					<div class="search-popup__product-social">
						<div class="short-item__item-rating">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="1">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="2">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="3">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="4">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-pasiv.svg" alt="5">
						</div>

						<div class="short-item__item-comment">
							<a class="short-item__comment-link" href="#">17</a>
						</div>
					</div>


				</div>
			</div>

			<div class="search-popup__product-right">
				<div class="search-popup__cost">
					<s class="search-popup__price-s">
						18 000 грн
					</s>
					<div class="search-popup__price-num">
						14 300 грн
					</div>
				</div>

				<div class="search-popup__buttons">
					<span class="short-item__add-link"></span>
					<span class="short-item__add-compare"></span>
					<a class="search-popup__add-cart" href="#">Купить</a>
				</div>
			</div>
		</div>

		<div class="search-popup__product-item">
			<div class="search-popup__product-left">
				<div class="search-popup__product-image">
					<a href="#">
						<img class="search-popup__product-img" src="<?= PATH . TEMPLATE ?>assets/img/hol-1.png" alt="">
					</a>
				</div>

				<div class="search-popup__product-header">
					<a href="#" class="search-popup__product--title">Холодильник Electrolux EWH 80 Formax</a>

					<div class="search-popup__product-social">
						<div class="short-item__item-rating">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="1">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="2">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="3">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="4">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-pasiv.svg" alt="5">
						</div>

						<div class="short-item__item-comment">
							<a class="short-item__comment-link" href="#">17</a>
						</div>
					</div>


				</div>
			</div>

			<div class="search-popup__product-right">
				<div class="search-popup__cost">
					<s class="search-popup__price-s">
						18 000 грн
					</s>
					<div class="search-popup__price-num">
						14 300 грн
					</div>
				</div>

				<div class="search-popup__buttons">
					<span class="short-item__add-link"></span>
					<span class="short-item__add-compare"></span>
					<a class="search-popup__add-cart" href="#">Купить</a>
				</div>
			</div>
		</div>

		<div class="search-popup__product-item">
			<div class="search-popup__product-left">
				<div class="search-popup__product-image">
					<a href="#">
						<img class="search-popup__product-img" src="<?= PATH . TEMPLATE ?>assets/img/hol-1.png" alt="">
					</a>
				</div>

				<div class="search-popup__product-header">
					<a href="#" class="search-popup__product--title">Холодильник Electrolux EWH 80 Formax</a>

					<div class="search-popup__product-social">
						<div class="short-item__item-rating">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="1">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="2">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="3">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="4">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-pasiv.svg" alt="5">
						</div>

						<div class="short-item__item-comment">
							<a class="short-item__comment-link" href="#">17</a>
						</div>
					</div>


				</div>
			</div>

			<div class="search-popup__product-right">
				<div class="search-popup__cost">
					<s class="search-popup__price-s">
						18 000 грн
					</s>
					<div class="search-popup__price-num">
						14 300 грн
					</div>
				</div>

				<div class="search-popup__buttons">
					<span class="short-item__add-link"></span>
					<span class="short-item__add-compare"></span>
					<a class="search-popup__add-cart" href="#">Купить</a>
				</div>
			</div>
		</div>
	</div> -->
</div>
<!-- popup modal end -->

<div class="arrow" id="arrowTop" hidden>
	<svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M21.22 10.61L10.61 -4.63778e-07L1.44357e-06 10.61L2.6288 13.2388L10.61 5.25759L18.5912 13.2388L21.22 10.61Z" fill="#445154" />
	</svg>
</div>
<!-- <a id="arrow-top-page" class="arrow-top-page" href="#"></a>
 -->


<!-- Выпуск №153 | Пользовательская часть | форма регистрации пользователя -->

<?php if (!$this->userData) : ?>

	<div class="login-popup">

		<div class="order-popup__inner">

			<p style="text-align: center; padding-bottom: 15px;">Выберите необходимую форму для заполнения</p>

			<h3><span>Регистрация</span> <span>Вход</span></h3>

			<form action="<?= $this->alias(['login' => 'registration']) ?>" method="post">

				<input type="text" name="name" required placeholder="Ваше имя" value="<?= $this->setFormValues('name') ?>">
				<input type="tel" name="phone" required placeholder="Телефон" value="<?= $this->setFormValues('phone') ?>">
				<input type="email" name="email" required placeholder="E-mail" value="<?= $this->setFormValues('email') ?>">

				<input type="password" name="password" required placeholder="Пароль">
				<input type="password" name="confirm_password" required placeholder="Подтверждение пароля">


				<div class="send-order">
					<button class="execute-order_btn short-item__add-cart" type="submit"><span>Регистрация</span></button>
				</div>

			</form>
			<form action="<?= $this->alias(['login' => 'login']) ?>" method="post" style='display: none'>

				<input type="text" name="name" required placeholder="Ваше имя" value="<?= $this->setFormValues('name') ?>">
				<input type="password" name="password" required placeholder="Пароль">

				<div class="send-order">
					<button class="execute-order_btn short-item__add-cart" type="submit"><span>Вход</span></button>
				</div>

			</form>



		</div>

	</div>

<?php endif; ?>

<?php $this->getScripts() ?>

<!-- Выпуск №147 -->
<!-- Выпуск №148 | Пользовательская часть | показ уведомлений пользователю -->
<?php if (!empty($_SESSION['res']['answer'])) : ?>

	<div class="wq-message__wrap"><?= $_SESSION['res']['answer'] ?></div>

<?php endif; ?>

<?php unset($_SESSION['res']); ?>

</body>

</html>