<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Широкий ассортимент товаров для ремонта по доступной цене с доставкой">
	<meta name="keywords" content="СтройКонтакт — строительные материалы в Донецке и ДНР">

	<meta property="og:title" content="СТРОЙКОНТАКТ" />
	<meta property="og:description" content="Широкий ассортимент товаров для ремонта по доступной цене с доставкой" />
	<meta property="og:image" content="/userfiles/settings/ellipse-19.png" />

	<link rel="icon" href="https://stroykontakt-don.ru/favicon.ico" type="image/x-icon">

	<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
	<link rel="manifest" href="/favicon/site.webmanifest">
	<link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#ff5400">
	<meta name="msapplication-TileColor" content="#ff5400">
	<meta name="theme-color" content="#ffffff">

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
						<a class="header__location-link" href="#">Донецк</a>
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

						<?php if (!empty($this->socials)) : ?>

							<div class="header__social2">

								<?php foreach ($this->socials as $item) : ?>

									<a class="header__social-item2" href="<?= $this->alias($item['external_alias']) ?>"><img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>"></a>

								<?php endforeach; ?>

							</div>

						<?php endif; ?>

						<!-- contacts 2 -->
						<div class="header__contacts2">
							<div class="header__contacts-phone2">
								<a href="tel:<?= preg_replace('/[^+\d]/', '', $this->set['phone']) ?>"><?= $this->set['phone'] ?></a>
								<span class="header__contacts-time2"><?= $this->set['working_time'] ?></span>
							</div>
						</div>

						<div class="header__user-profile">

							<a class="header__profile-link" href="<?= $this->userData ? $this->alias('login') : '#' ?>" <?= !$this->userData ? 'data-popup = "login-popup"' : '' ?> title="личный кабинет"></a>

							<!-- <div class="header-user-menu">
									<a href="#" class="header-user-menu__item header-user-menu__item-active">Личный кабинет</a>
									<a href="#" class="header-user-menu__item">Настройки</a>
									<a href="#" class="header-user-menu__item">Сообщения <span class="header-user-menu__num">3</span></a>
									<a href="#" class="header-user-menu__item">Избранное</a>
									<a href="#" class="header-user-menu__item">Мои заказы</a>
									<a href="#" class="header-user-menu__item header-user-menu__exit">Выйти</a>
								</div> -->

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


						<!-- search input -->
						<a href="#popup-search" class="header__search popup-search-modal">
							<!-- <div class="header__search-input">Что будем искать?</div> -->
							<div class="header__search-submit" type="submit"></div>
						</a>
					</div>

					<!-- header center right -->
					<div class="header__center-right">

						<?php if (!empty($this->socials)) : ?>

							<div class="header__social">

								<?php foreach ($this->socials as $item) : ?>

									<a class="header__social-item" href="<?= $this->alias($item['external_alias']) ?>"><img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>"></a>

								<?php endforeach; ?>

							</div>

						<?php endif; ?>

						<!-- contacts -->
						<div class="header__contacts">
							<div class="header__contacts-phone">
								<a href="tel:<?= preg_replace('/[^+\d]/', '', $this->set['phone']) ?>"><?= $this->set['phone'] ?></a>
								<span class="header__contacts-time"><?= $this->set['working_time'] ?></span>
							</div>
						</div>

						<!-- cart start-->
						<div class="header__cart">
							<a class="header__cart-link" href="<?= $this->alias('cart') ?>">
								<span data-totalQty class="header__cart-num"><?= $this->cart['total_qty'] ?? 0 ?></span>
								<div class="header__cart-name">Корзина</div>
								<div class="header__cart-money" data-totalSum><?= $this->cart['total_sum'] ?? 0 ?> руб.</div>
							</a>

						</div>


						<a class="header__user-profile-link" href="<?= $this->userData ? $this->alias('login') : '#' ?>" <?= !$this->userData ? 'data-popup = "login-popup"' : '' ?> title="личный кабинет"></a>

						<a class="header__user-cart-link" href="<?= $this->alias('cart') ?>">
							<span data-totalQty class="header__cart-num"><?= $this->cart['total_qty'] ?? 0 ?></span>
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


								<!-- через data-атрибуты соединяем эти 2-а меню -->

								<?php if (!empty($this->arrCategory)) : ?>

									<?php foreach ($this->arrCategory as $item) : ?>

										<!-- меню 2го уровня Правое -->
										<div class="navi-category__list-content navi-category__nc-<?= $item['id'] ?>">
											<a class="navi-category__mobile-back-all-category" href="#">Все категории</a>
											<div style="color:blue; font-size:large; font-weight:700; padding:5px 5px 25px 5px"><?= $item['name'] ?></div>


											<div class="navi-category__submenu">

												<?php if (!empty($item['sub'])) : ?>

													<div class="navi-category__category-list">

														<ul class="navi-category__category-menu">

															<?php foreach ($item['sub'] as $sub) : ?>

																<li class="navi-category__category-item">

																	<a href="<?= $this->alias(['catalog' => $sub['alias']]) ?>" class="navi-category__category-title"><?= $sub['name'] ?></a>

																	<?php if (!empty($sub['sub'])) : ?>

																		<ul class="navi-category-subcategory-menu">

																			<?php foreach ($sub['sub'] as $subsub) : ?>

																				<li class="navi-category-subcategory-item">
																					<a class="navi-category-subcategory__link" href="<?= $this->alias(['catalog' => $subsub['alias']]) ?>"><?= $subsub['name'] ?></a>
																				</li>

																			<?php endforeach; ?>

																		</ul>

																	<?php endif; ?>

																</li>

															<?php endforeach; ?>

														</ul>

													</div>

												<?php endif; ?>

												<div class="navi-category__submenu-banner">
													<div class="navi-category__sb-link" style="background-color:#F3F8FF;">
														<div class="navi-category__sb-title"><?= $item['sb_title'] ?></div>

														<div class="navi-category__sb-text"><?= $item['sb_text'] ?></div>

														<div class="navi-category__sb-image">
															<img class="navi-category__sb-img" src="<?= $this->img($item['img']) ?>" alt="<?= $item['sb_title'] ?>">
														</div>

														<!-- <div class="navi-category__sb-buy">
															Купить
														</div> -->
													</div>
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