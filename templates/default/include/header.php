<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?= $this->set['name'] ?></title>

	<?php $this->getStyles() ?>

</head>

<body>
	<!-- header-->
	<div id="header-block" class="header-block__hide"></div>
	<header class=" header" id="header">

		<div class="header__top">
			<div class="container">
				<div class="header__top-wrapper">

					<a href="#" class="header__mb-menu-close"></a>

					<!-- location -->
					<div class="header__location">
						<a class="header__location-link popup-open-modal" href="#change-city-popup">Донецк</a>
					</div>

					<a class="header__all-category-link3" href="#">
						<span class="header__all-category-icon3">Все категории товаров</span>
					</a>
					<!-- menu -->
					<div class="header__topNav">


						<ul class="header__topNav-menu">

							<!-- <li class="header__topNav-item"><a class="header__topNav-link popup-open-modal" href="#popup-lk">Отзывы</a></li>
							<li class="header__topNav-item"><a class="header__topNav-link popup-open-modal" href="#popup-sms">О
									нас</a></li>
							<li class="header__topNav-item"><a class="header__topNav-link popup-open-modal" href="#popup-buy-one-click">Доставка</a></li> -->

							<li class="header__topNav-item"><a class="header__topNav-link" href="<?= $this->alias('catalog') ?>">Все товары</a></li>


							<?php if (!empty($this->menu['information'])) : ?>

								<?php foreach ($this->menu['information'] as $item) : ?>

									<li class="header__topNav-item"><a class="header__topNav-link" href="<?= $this->alias(['information' => $item['alias']]) ?>"><?= $item['name'] ?></a>
									</li>

								<?php endforeach; ?>

							<?php endif; ?>

							<li class="header__topNav-item"><a class="header__topNav-link" href="<?= $this->alias('news') ?>">Новости</a></li>
							<li class="header__topNav-item"><a class="header__topNav-link" href="<?= $this->alias('contacts') ?>">Контакты</a></li>

						</ul>

						<div class="header__more-menu">

							<a href="#" class="header__more-menu-link">Еще</a>
							<ul class="header__topNav-menu2">
								<!-- <li class="header__topNav-item2"><a class="header__topNav-link2 popup-open-modal" href="#popup-lk">Отзывы</a></li>
								<li class="header__topNav-item2"><a class="header__topNav-link2 popup-open-modal" href="#popup-sms">О
										нас</a></li>
								<li class="header__topNav-item2"><a class="header__topNav-link2 popup-open-modal" href="#popup-buy-one-click">Доставка</a></li> -->


								<li class="header__topNav-item2"><a class="header__topNav-link2" href="<?= $this->alias('catalog') ?>">Все товары</a></li>

								<?php if (!empty($this->menu['information'])) : ?>

									<?php foreach ($this->menu['information'] as $item) : ?>

										<li class="header__topNav-item2"><a class="header__topNav-link2" href="<?= $this->alias(['information' => $item['alias']]) ?>"><?= $item['name'] ?></a></li>

									<?php endforeach; ?>

								<?php endif; ?>

								<li class="header__topNav-item2"><a class="header__topNav-link2" href="<?= $this->alias('news') ?>">Новости</a></li>
								<li class="header__topNav-item2"><a class="header__topNav-link2" href="<?= $this->alias('contacts') ?>">Контакты</a></li>

							</ul>
						</div>
					</div>

					<div class="header__button-icons">

						<!-- social link 2-->
						<div class="header__social2">
							<a class="header__social-item2" href="#" target="_blank"><img src="<?= PATH . TEMPLATE ?>assets/img/icons/viber.svg" alt="Viber"></a>
							<a class="header__social-item2" href="#" target="_blank"><img src="<?= PATH . TEMPLATE ?>assets/img/icons/telegram.svg" alt="Telegram"></a>
						</div>
						<!-- contacts 2 -->
						<div class="header__contacts2">
							<div class="header__contacts-phone2">
								<a href="tel:<?= preg_replace('/[^+\d]/', '', $this->set['phone']) ?>"><?= $this->set['phone'] ?></a>
								<span class="header__contacts-time2"><?= $this->set['working_time'] ?></span>
							</div>
						</div>

						<!-- profile acc -->
						<div class="header__user-profile">
							<a class="header__profile-link" href="#">Личный кабинет</a>

							<div class="header-user-menu">
								<a href="#" class="header-user-menu__item header-user-menu__item-active">Личный кабинет</a>
								<a href="#" class="header-user-menu__item">Настройки</a>
								<a href="#" class="header-user-menu__item">Сообщения <span class="header-user-menu__num">3</span></a>
								<a href="#" class="header-user-menu__item">Избранное</a>
								<a href="#" class="header-user-menu__item">Мои заказы</a>
								<a href="#" class="header-user-menu__item header-user-menu__exit">Выйти</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- header top off -->

		<div class="header__center">
			<div class="container">
				<div class="header__center-wrapper">

					<!-- header center left -->
					<div class="header__center-left">
						<!-- logo -->
						<div class="header__logo">
							<a class="header__logo-img" href="<?= $this->alias() ?>">
								<img src="<?= $this->img($this->set['img']) ?>" alt="<?= $this->set['name'] ?>">
							</a>
						</div>
						<!-- all category -->
						<div class="header__bottom-all">
							<a class="header__all-category-link" href="#"><span class="header__all-category-icon">
								</span>Все категории товаров</a>
						</div>

						<!-- menu -->
						<!-- <div class="header__centerNav">
							<ul class="header__centerNav-menu">
								<li class="header__centerNav-item active"><a class="active header__centerNav-link"
										href="category.html">Техника</a>
								</li>
								<li class="header__centerNav-item"><a class="header__centerNav-link" href="#">Мебель</a></li>
								<li class="header__centerNav-item"><a class="header__centerNav-link" href="#">Инструменты</a>
								</li>
							</ul>
						</div> -->

						<!-- search input -->
						<a href="#popup-search" class="header__search popup-search-modal">
							<!-- <div class="header__search-input">Что будем искать?</div> -->
							<div class="header__search-submit" type="submit"></div>
						</a>
					</div>

					<!-- header center right -->
					<div class="header__center-right">
						<!-- social link -->
						<div class="header__social">
							<a class="header__social-item" href="#" target="_blank"><img src="<?= PATH . TEMPLATE ?>assets/img/icons/viber.svg" alt="Viber"></a>
							<a class="header__social-item" href="#" target="_blank"><img src="<?= PATH . TEMPLATE ?>assets/img/icons/telegram.svg" alt="Telegram"></a>
						</div>
						<!-- contacts -->
						<div class="header__contacts">
							<div class="header__contacts-phone">
								<a href="tel:<?= preg_replace('/[^+\d]/', '', $this->set['phone']) ?>"><?= $this->set['phone'] ?></a>
								<span class="header__contacts-time"><?= $this->set['working_time'] ?></span>
							</div>
						</div>

						<!-- cart start-->
						<div class="header__cart">
							<a class="header__cart-link" href="#">
								<span class="header__cart-num">3</span>
								<div class="header__cart-name">Корзина</div>
								<div class="header__cart-money">19700 грн</div>
							</a>
							<!-- выпадающий список корзины -->
							<div class="header-cart">
								<div class="header__cart__item">
									<div class="header__cart__image">
										<a href="#">
											<img class="header__cart__img" src="<?= PATH . TEMPLATE ?>assets/img/hol-1.png" alt="">
										</a>
									</div>

									<div class="header__cart__title">
										<a class="header__cart__link" href="#">Холодильник Electrolux EWH 80 Formax</a>
										<span class="header__cart__code">Код товара: 519868.0</span>
									</div>

									<div class="header__cart__price">
										<p class="header__cart__price-num">11 000 грн</p>
										<s class="header__cart__price-s-num">15 199 грн</s>
									</div>
								</div>

								<div class="header__cart__item">
									<div class="header__cart__image">
										<a href="#">
											<img class="header__cart__img" src="<?= PATH . TEMPLATE ?>assets/img/hol-1.png" alt="">
										</a>
									</div>

									<div class="header__cart__title">
										<a class="header__cart__link" href="#">Холодильник Electrolux EWH 80 Formax</a>
										<span class="header__cart__code">Код товара: 519868.0</span>
									</div>

									<div class="header__cart__price">
										<p class="header__cart__price-num">11 000 грн</p>
										<s class="header__cart__price-s-num">15 199 грн</s>
									</div>
								</div>

								<div class="header__cart__item">
									<div class="header__cart__image">
										<a href="#">
											<img class="header__cart__img" src="<?= PATH . TEMPLATE ?>assets/img/hol-1.png" alt="">
										</a>
									</div>

									<div class="header__cart__title">
										<a class="header__cart__link" href="#">Холодильник Electrolux EWH 80 Formax</a>
										<span class="header__cart__code">Код товара: 519868.0</span>
									</div>

									<div class="header__cart__price">
										<p class="header__cart__price-num">11 000 грн</p>
										<s class="header__cart__price-s-num">15 199 грн</s>
									</div>
								</div>

								<div class="header-cart__total">
									<div class="header-cart__total-name">Итого:</div>

									<div class="header-cart__total-sum">11 000 грн</div>
								</div>

								<a href="cart.html" class="header-cart__go-to-cart-link">Перейти в корзину</a>
							</div>
						</div>
						<!-- cart end-->

						<a class="header__user-profile-link" href="#"></a>
						<a class="header__user-cart-link" href="#">
							<span class="header__cart-num">3</span>
						</a>

						<a class="header__mobile-main-menu-link" href="#">
							<span></span>
						</a>
					</div>
				</div>
			</div>
		</div>

		<div class="navi-category">
			<div class="navi-category__wrapper">
				<div id="navi-category" class="navi-category__bg">

					<div class="navi-category__content">

						<a class="navi-category__mobile-back-to-menu" href="#">Меню<a>

								<?php if (!empty($this->arrCategory)) : ?>

									<!-- меню 1го уровня Левое -->
									<ul class="navi-category__list">

										<?php foreach ($this->arrCategory as $item) : ?>

											<li class="navi-category__list-item">
												<a data-attribute="<?= $item['id'] ?>" href="#" class="navi-category__list-link"><?= $item['name'] ?></a>
											</li>

										<?php endforeach; ?>

									</ul>

								<?php endif; ?>


								<!-- через data-атрибуты соединяем эти 2 меню -->

								<?php if (!empty($this->arrCategory)) : ?>

									<?php foreach ($this->arrCategory as $item) : ?>

										<!-- меню 2го уровня Правое -->
										<div class="navi-category__list-content navi-category__nc-<?= $item['id'] ?>">
											<a class="navi-category__mobile-back-all-category" href="#">Все категории</a>
											<div style="color:blue; font-size:large; font-weight:700; padding:5px 5px 25px 5px"><?= $item['name'] ?></div>


											<div class="navi-category__submenu">
												<div class="navi-category__category-list">

													<?php if (!empty($item['sub'])) : ?>

														<ul class="navi-category__category-menu">

															<?php foreach ($item['sub'] as $sub) : ?>

																<li class="navi-category__category-item">

																	<a href="<?= $this->alias(['catalog' => $sub['alias']]) ?>" class="navi-category__category-title"><?= $sub['name'] ?></a>

																	<?php if (!empty($sub['sub'])) : ?>

																		<ul class="navi-category-subcategory-menu">

																			<?php foreach ($sub['sub'] as $subsub) : ?>

																				<li class="navi-category-subcategory-item">
																					<a class="navi-category-subcategory__link" href="<?= $this->alias(['catalog' => $subsub['alias']]) ?>"><?= $subsub['name'] ?></a> (2)
																				</li>

																			<?php endforeach; ?>

																		</ul>

																	<?php endif; ?>

																</li>

															<?php endforeach; ?>

														</ul>

													<?php endif; ?>

												</div>

												<div class="navi-category__submenu-banner">
													<a class="navi-category__sb-link" style="background-color:#F3F8FF;" href="#">
														<div class="navi-category__sb-title">iPhone 11</div>

														<div class="navi-category__sb-text">Забери со скидкой до 11.02.21</div>

														<div class="navi-category__sb-image">
															<img class="navi-category__sb-img" src="<?= PATH . TEMPLATE ?>assets/img/iphone.jpg" alt="iphone">
														</div>

														<div class="navi-category__sb-buy">
															Купить
														</div>
													</a>
												</div>
											</div>



										</div>

									<?php endforeach; ?>

								<?php endif; ?>


					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- header off -->

	<main class="main">