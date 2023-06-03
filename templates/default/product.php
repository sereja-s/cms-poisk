<?php if (!empty($data)) :  ?>

	<?= $this->breadcrumbs ?>

	<!-- full-item start-->
	<section class="full-item">
		<div class="container">
			<div class="full-item__wrapper">

				<div class="full-item__header">
					<h1 class="full-item__main-title"><?= $data['name'] ?></h1>

					<div class="full-item__compare">
						<span class="short-item__add-link"></span>
						<span class="short-item__add-compare"></span>

						<?php if (!empty($data['article'])) : ?>

							<span class="full-item__code-item"><?= $data['article'] ?></span>

						<?php endif; ?>

					</div>
				</div>

				<!-- блок с интерактивными елементами -->
				<div class="full-item__info">

					<div class="full-item__info-a">
						<span class="short-item__discount">-20%</span><span class="short-item__new">Новинка</span><span class="short-item__present">Подарок</span>
					</div>

					<div class="full-item__info-b">
						<div class="short-item__item-rating">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="1">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="2">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="3">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="4">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="4">
							<!-- <img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-pasiv.svg" alt="5"> -->
						</div>
					</div>

				</div>
				<!-- блок с интерактивными елементами end -->

				<!-- основная инфо в 3х блоках-->
				<div class="full-item__content">

					<!-- slider -->
					<div class="full-item__slider">
						<!-- mini -->
						<div class="full-item__slider-mini">

							<?php if (!empty($data['gallery_img'])) : ?>

								<div class="full-item__slider-mini-item">
									<img src="<?= $this->img($data['img']) ?>" alt="<?= $data['name'] ?>">
								</div>

								<?php foreach (json_decode($data['gallery_img'], true) as $item) : ?>

									<div class="full-item__slider-mini-item">
										<img src="<?= $this->img($item) ?>" alt="<?= $data['name'] ?>">
									</div>

								<?php endforeach; ?>

							<?php endif; ?>

						</div>

						<!-- full slider -->
						<div class="full-item__slider-full">
							<div class="full-item__slider-full-item">
								<img src="<?= $this->img($data['img']) ?>" alt="<?= $data['name'] ?>">
							</div>

							<?php if (!empty($data['gallery_img'])) : ?>

								<?php foreach (json_decode($data['gallery_img'], true) as $item) : ?>

									<div class="full-item__slider-full-item">
										<img src="<?= $this->img($item) ?>" alt="<?= $data['name'] ?>">
									</div>

								<?php endforeach; ?>

							<?php endif; ?>

						</div>
					</div>


					<?php if (!empty($data['filters'])) : ?>

						<!-- description -->
						<div class="full-item__description">

							<?php $counter = 0; ?>

							<?php foreach ($data['filters'] as $item) : ?>

								<?php

								if (++$counter > 3) break;

								?>

								<div class="full-item__table">

									<div class="full-item__table-name"><span><?= $item['name'] ?></span></div>
									<div class="full-item__table-param"><?= implode(', ', array_column($item['values'], 'name')) ?></div>

								</div>

							<?php endforeach; ?>

							<?php if (count($data['filters']) > 3) : ?>

								<div class="full-item__all-char">
									<a class="full-item__all-char-link scroll-to" href="#full-item__tabs" style="text-decoration: underline;">Все характеристики</a>
								</div>

							<?php endif; ?>

						</div>

					<?php endif; ?>



					<!-- price -->
					<div class="full-item__price">
						<div class="full-item__price-wrapper">
							<div class="full-item__cost">

								<div class="full-item__price-num">
									<span><?= $data['price'] ?></span> руб.
								</div>

								<?php if (!empty($data['old_price'])) : ?>

									<s class="full-item__price-s">
										<span><?= $data['old_price'] ?></span> руб.
									</s>

								<?php endif; ?>

								<div class="full-item__payment-method" style="margin: 25px;">
									Нааличие товара и способ оплаты:<br>
									<b>Уточняйте у менеджера по указанным телефонам</b>
								</div>

							</div>

							<!-- buy block -->
							<div class="full-item__buy">
								<a data-addToCart="<?= $data['id'] ?>" data-onClick href="#popup-buy-one-click" class="full-item__buy-click popup-open-modal">
									Купить в 1 клик
								</a>

								<a data-addToCart="<?= $data['id'] ?>" <?= !empty($this->cart['goods'][$data['id']]) ? 'data-toCartAdded' : '' ?> href="#" class="full-item__add-to-cart-button">
									Добавить в корзину
								</a>
							</div>
						</div>

						<!-- info item delivery-->
						<div class="full-item__delivery-info">
							<div class="full-item__di-item">
								<h4 class="full-item__di-title full-item__di-title-garanty">Гарантия</h4>

								<div class="full-item__di-show">
									<div class="full-item__di-text">
										<p>Гарантия сервисного центра производителя</p>
										<p>Товар сертифицирован</p>
										<p>Гарантия производителя: 36 мес.</p>
									</div>

									<div class="full-item__di-link">
										<p><a href="#">Информация о гарантии</a></p>
										<p><a href="#">Сервисные центры</a></p>
									</div>
								</div>

							</div>

							<div class="full-item__di-item">
								<h4 class="full-item__di-title full-item__di-title-delivery">Доставка</h4>

								<div class="full-item__di-show">
									<div class="full-item__di-text">
										<p>Доставка в пределах Донецка: 300 грн</p>
										<p>Ближайшее время доставки: Завтра (Понедельник (18.01) с 15:00 до 23:00)</p>
										<p>Доставка за пределы Донецка по тарифу 15 руб./км</p>
										<p>Интервал доставки за пределы Донецка: с 8:00 до 23:00</p>
										<p>Поднимем в квартиру по <a href="#">тарифам</a>.</p>
									</div>
								</div>

							</div>

							<div class="full-item__di-item">
								<h4 class="full-item__di-title full-item__di-title-util">Утилизация</h4>

								<div class="full-item__di-show">
									<div class="full-item__di-text">
										<p>Заберем технику на утилизацию в момент доставки</p>
										<p>Стоимость: Бесплатно</p>
										<p>Стоимость выноса товара: 100 руб. (если есть лифт)</p>
									</div>
									<div class="full-item__di-link">
										<p><a href="#">Подробнее</a></p>
									</div>
								</div>

							</div>

							<div class="full-item__di-item">
								<h4 class="full-item__di-title full-item__di-title-garanty">Продлите гарантию</h4>

								<div class="full-item__di-show">
									<div class="full-item__di-text">
										<div class="full-item__garanty-form">
											<p>И получите дополнительный сервис</p>
											<label>
												1 год <input type="radio" name="garanty"> +1720 ₽
											</label>

											<label>
												2 года <input type="radio" name="garanty"> +2010 ₽
											</label>

											<label>
												3 года <input type="radio" name="garanty"> +2200 ₽
											</label>

											<label>
												нет <input type="radio" name="garanty"> 0 ₽
											</label>
											<p><a href="#">Информация</a></p>
										</div>

									</div>
								</div>

							</div>

						</div>
					</div>

				</div>
				<!-- основная инфо end-->

			</div>





			<div id="full-item__tabs" class="full-item__tabs">
				<ul class="full-item__tabs-menu">
					<li class="full-item__tabs-menu-item"><a href="#tabs-1">Характеристики</a></li>
					<li class="full-item__tabs-menu-item"><a href="#tabs-2">Обзоры</a></li>
					<li class="full-item__tabs-menu-item"><a href="#tabs-3">Документация</a></li>
					<li class="full-item__tabs-menu-item"><a href="#tabs-4">Видео</a></li>
					<li class="full-item__tabs-menu-item"><a href="#tabs-5">Услуги</a></li>
				</ul>

				<div id="tabs-1">
					<div class="full-item__tabs-table">
						<div class="full-item__table">
							<h4 class="full-item__table-title">Общие характеристики</h4>

							<div class="full-item__table-name"><span>Бренд</span></div>
							<div class="full-item__table-param">BEKO</div>
							<div class="full-item__table-name"><span>Морозильная камера</span></div>
							<div class="full-item__table-param">Снизу</div>
							<div class="full-item__table-name"><span>Цвет / Материал покрытия</span></div>
							<div class="full-item__table-param">белый / метал</div>
							<div class="full-item__table-name"><span>Габариты</span></div>
							<div class="full-item__table-param">54х60х158</div>
							<div class="full-item__table-name"><span>Энергопотребление</span></div>
							<div class="full-item__table-param">класс A (301 кВтч/год)</div>
							<div class="full-item__table-name"><span>Количество камер</span></div>
							<div class="full-item__table-param">2</div>
							<div class="full-item__table-name"><span>Количество дверей</span></div>
							<div class="full-item__table-param">2</div>
							<div class="full-item__table-name"><span>Индикация</span></div>
							<div class="full-item__table-param">открытой двери–звуковая</div>
						</div>

						<div class="full-item__table">
							<h4 class="full-item__table-title">Объем</h4>

							<div class="full-item__table-name"><span>Бренд</span></div>
							<div class="full-item__table-param">BEKO</div>
							<div class="full-item__table-name"><span>Морозильная камера</span></div>
							<div class="full-item__table-param">Снизу</div>
							<div class="full-item__table-name"><span>Цвет / Материал покрытия</span></div>
							<div class="full-item__table-param">белый / метал</div>
							<div class="full-item__table-name"><span>Габариты</span></div>
							<div class="full-item__table-param">54х60х158</div>
							<div class="full-item__table-name"><span>Энергопотребление</span></div>
							<div class="full-item__table-param">класс A (301 кВтч/год)</div>
							<div class="full-item__table-name"><span>Количество камер</span></div>
							<div class="full-item__table-param">2</div>
							<div class="full-item__table-name"><span>Количество дверей</span></div>
							<div class="full-item__table-param">2</div>
							<div class="full-item__table-name"><span>Индикация</span></div>
							<div class="full-item__table-param">открытой двери–звуковая</div>
						</div>

						<div class="full-item__table">
							<h4 class="full-item__table-title">Холод</h4>

							<div class="full-item__table-name"><span>Бренд</span></div>
							<div class="full-item__table-param">BEKO</div>
							<div class="full-item__table-name"><span>Морозильная камера</span></div>
							<div class="full-item__table-param">Снизу</div>
							<div class="full-item__table-name"><span>Цвет / Материал покрытия</span></div>
							<div class="full-item__table-param">белый / метал</div>
							<div class="full-item__table-name"><span>Габариты</span></div>
							<div class="full-item__table-param">54х60х158</div>
							<div class="full-item__table-name"><span>Энергопотребление</span></div>
							<div class="full-item__table-param">класс A (301 кВтч/год)</div>
							<div class="full-item__table-name"><span>Количество камер</span></div>
							<div class="full-item__table-param">2</div>
							<div class="full-item__table-name"><span>Количество дверей</span></div>
							<div class="full-item__table-param">2</div>
							<div class="full-item__table-name"><span>Индикация</span></div>
							<div class="full-item__table-param">открытой двери–звуковая</div>
						</div>

						<div class="full-item__table">
							<h4 class="full-item__table-title">Другие функции и особенности</h4>

							<div class="full-item__table-name"><span>Бренд</span></div>
							<div class="full-item__table-param">BEKO</div>
							<div class="full-item__table-name"><span>Морозильная камера</span></div>
							<div class="full-item__table-param">Снизу</div>
							<div class="full-item__table-name"><span>Цвет / Материал покрытия</span></div>
							<div class="full-item__table-param">белый / метал</div>
							<div class="full-item__table-name"><span>Габариты</span></div>
							<div class="full-item__table-param">54х60х158</div>
							<div class="full-item__table-name"><span>Энергопотребление</span></div>
							<div class="full-item__table-param">класс A (301 кВтч/год)</div>
							<div class="full-item__table-name"><span>Количество камер</span></div>
							<div class="full-item__table-param">2</div>
							<div class="full-item__table-name"><span>Количество дверей</span></div>
							<div class="full-item__table-param">2</div>
							<div class="full-item__table-name"><span>Индикация</span></div>
							<div class="full-item__table-param">открытой двери–звуковая</div>
						</div>
					</div>
				</div>
				<div id="tabs-2">
					2
				</div>
				<div id="tabs-3">3</div>
				<div id="tabs-4">4</div>
				<div id="tabs-5">5</div>
			</div>

			<div class="full-item__reviews">
				<h3 class="h3-title full-item__reviews-title">Отзывы покупателей</h3>

				<div class="full-item__reviews-wrapper">
					<div class="full-item__reviews-left">

						<div class="full-item__reviews-item">
							<div class="full-item__reviews-img">
								H
							</div>

							<div class="full-item__reviews-content">
								<div class="full-item__reviews-header">
									<div class="full-item__reviews-user-info">
										<div class="full-item__reviews-user-name">
											Наталья
										</div>

										<div class="full-item__reviews-user-date">
											01.03.2022
										</div>
									</div>

									<div class="full-item__reviews-grade">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
									</div>
								</div>

								<div class="full-item__reviews-text">
									<p> Брала в подарок любительнице Apple, осталась довольна. Всё новое и запакованное, заряжается тоже
										нормально. К ним ещё взяла чехол, все счастливы. </p>
								</div>
							</div>
						</div>


						<div class="full-item__reviews-item">
							<div class="full-item__reviews-img">
								<img src="img/ava-comments.jpg" alt="Наталья">
							</div>

							<div class="full-item__reviews-content">
								<div class="full-item__reviews-header">
									<div class="full-item__reviews-user-info">
										<div class="full-item__reviews-user-name">
											Наталья
										</div>

										<div class="full-item__reviews-user-date">
											01.03.2022
										</div>
									</div>

									<div class="full-item__reviews-grade">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
									</div>
								</div>

								<div class="full-item__reviews-text">
									<p> Брала в подарок любительнице Apple, осталась довольна. Всё новое и запакованное, заряжается тоже
										нормально. К ним ещё взяла чехол, все счастливы. </p>
								</div>
							</div>
						</div>

						<div class="full-item__reviews-item">
							<div class="full-item__reviews-img">
								H
							</div>

							<div class="full-item__reviews-content">
								<div class="full-item__reviews-header">
									<div class="full-item__reviews-user-info">
										<div class="full-item__reviews-user-name">
											Наталья
										</div>

										<div class="full-item__reviews-user-date">
											01.03.2022
										</div>
									</div>

									<div class="full-item__reviews-grade">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
										<img src="img/icons/star-activ.jpg" alt="">
									</div>
								</div>

								<div class="full-item__reviews-text">
									<p> Брала в подарок любительнице Apple, осталась довольна. Всё новое и запакованное, заряжается тоже
										нормально. К ним ещё взяла чехол, все счастливы. </p>
								</div>
							</div>
						</div>

						<div class="full-item__reviews-more">
							<a href="#" class="full-item__reviews-more-link">Показать еще 10 отзывов</a>
						</div>

					</div>

					<div class="full-item__reviews-right">
						<div class="full-item__reviews-info">
							<div class="full-item__reviews-info-head">
								<div class="full-item__reviews-total-rate">4.7 / 5</div>

								<div class="full-item__reviews-total-star">
									<img src="img/icons/star-activ.jpg" alt="">
									<img src="img/icons/star-activ.jpg" alt="">
									<img src="img/icons/star-activ.jpg" alt="">
									<img src="img/icons/star-activ.jpg" alt="">
									<img src="img/icons/star-activ.jpg" alt="">
								</div>
							</div>

							<div class="full-item__reviews-info-content">
								<div class="full-item__reviews-rate">
									<div class="full-item__reviews-rate-name">5 звезд</div>

									<div class="full-item__reviews-rate-progress">
										<div class="full-item__reviews-rate-progress-active" style="width: 100%"></div>
									</div>

									<div class="full-item__reviews-rate-num"><a class="full-item__reviews-rate-num-link" href="#">35
											отзывов</a></div>
								</div>

								<div class="full-item__reviews-rate">
									<div class="full-item__reviews-rate-name">4 звезды</div>

									<div class="full-item__reviews-rate-progress">
										<div class="full-item__reviews-rate-progress-active" style="width: 70%"></div>
									</div>

									<div class="full-item__reviews-rate-num"><a class="full-item__reviews-rate-num-link" href="#">10
											отзывов</a></div>
								</div>

								<div class="full-item__reviews-rate">
									<div class="full-item__reviews-rate-name">3 звезды</div>

									<div class="full-item__reviews-rate-progress">
										<div class="full-item__reviews-rate-progress-active" style="width: 40%"></div>
									</div>

									<div class="full-item__reviews-rate-num"><a class="full-item__reviews-rate-num-link" href="#">0
											отзывов</a></div>
								</div>

								<div class="full-item__reviews-rate">
									<div class="full-item__reviews-rate-name">2 звезды</div>

									<div class="full-item__reviews-rate-progress">
										<div class="full-item__reviews-rate-progress-active"></div>
									</div>

									<div class="full-item__reviews-rate-num"><a class="full-item__reviews-rate-num-link" href="#">0
											отзывов</a></div>
								</div>

								<div class="full-item__reviews-rate">
									<div class="full-item__reviews-rate-name">1 звезда</div>

									<div class="full-item__reviews-rate-progress">
										<div class="full-item__reviews-rate-progress-active"></div>
									</div>

									<div class="full-item__reviews-rate-num"><a class="full-item__reviews-rate-num-link" href="#">0
											отзывов</a></div>
								</div>
							</div>

							<div class="full-item__reviews-info-button">
								<button class="full-item__reviews-info-button-link">Написать отзыв</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="add-reviews">
				<h3 class="h3-title add-reviews__title">У товара пока нет отзывов</h3>
			</div>
			<div class="add-reviews">
				<h3 class="h3-title add-reviews__title">Ваш отзыв о товаре</h3>

				<div class="add-reviews__form">
					<div class="add-reviews__item">
						<textarea class="add-reviews__textarea"></textarea>
					</div>

					<div class="add-reviews__item">
						<label class="add-reviews__form-label" for="">Оцените товар</label>

						<div class="add-reviews__star-rating">
							<img src="img/icons/reviews-star.svg" alt="">
							<img src="img/icons/reviews-star.svg" alt="">
							<img src="img/icons/reviews-star.svg" alt="">
							<img src="img/icons/reviews-star.svg" alt="">
							<img src="img/icons/reviews-star.svg" alt="">
						</div>

					</div>

					<div class="add-reviews__item">
						<a class="add-reviews__add-photo" href="#">
							<span>Загрузите фото</span>
						</a>
					</div>

					<div class="add-reviews__item">
						<button class="add-reviews__form-submit" type="submit">Написать отзыв</button>
					</div>
				</div>
			</div>

			<div class="full-item__recommendation">
				<h3 class="h3-title full-item__recommendation-title">C этим товаром покупают</h3>

				<div class="full-item__recommendation-wrapper">
					<!-- 1 catalog item start -->
					<div class="short-item__item">

						<!-- catalog img start -->
						<a class="short-item__img-link" href="#">
							<div class="short-item__lt-info">
								<span class="short-item__new">Новинка</span>
								<span class="short-item__present">Подарок</span>
							</div>

							<div class="short-item__lb-info">
								<span class="short-item__discount">-20%</span>
							</div>

							<img src="img/catalog-img-1.png" alt="" class="short-item__img">
						</a>
						<!-- catalog img end -->

						<!-- catalog price start -->
						<div class="short-item__price">
							<p class="short-item__price-num">12 199 грн</p>
							<s class="short-item__price-s-num">15 199 грн</s>
						</div>
						<!-- catalog price end -->

						<!-- catalog item title start-->
						<div class="short-item__item-title">
							<a class="short-item__item-link" href="#">Водонагреватель Electrolux EWH 80 Formax</a>
						</div>
						<!-- catalog item title end-->

						<!-- catalog item info start -->
						<div class="short-item__item-info">
							<div class="short-item__item-rating">
								<img src="img/icons/star-activ.jpg" alt="1">
								<img src="img/icons/star-activ.jpg" alt="2">
								<img src="img/icons/star-activ.jpg" alt="3">
								<img src="img/icons/star-activ.jpg" alt="4">
								<img src="img/icons/star-pasiv.svg" alt="5">
							</div>

							<div class="short-item__item-comment">
								<a class="short-item__comment-link" href="#">17</a>
							</div>
						</div>
						<!-- catalog item info end -->

						<!-- button cart start-->
						<a class="short-item__add-cart" href="#">В корзину</a>
						<!-- button cart end-->
					</div>
					<!-- catalog item end -->

					<!-- 2 catalog item start -->
					<div class="short-item__item">

						<!-- catalog img start -->
						<a class="short-item__img-link" href="#">
							<div class="short-item__lt-info">
								<span class="short-item__new">Новинка</span>
								<span class="short-item__present">Подарок</span>
							</div>

							<div class="short-item__lb-info">
								<span class="short-item__discount">-20%</span>
							</div>

							<img src="img/catalog-img-2.png" alt="" class="short-item__img">
						</a>
						<!-- catalog img end -->

						<!-- catalog price start -->
						<div class="short-item__price">
							<p class="short-item__price-num">8 500 грн</p>
							<s class="short-item__price-s-num">10 000 грн</s>
						</div>
						<!-- catalog price end -->

						<!-- catalog item title start-->
						<div class="short-item__item-title">
							<a class="short-item__item-link" href="#">Стиральная машина LG F-1096TD3</a>
						</div>
						<!-- catalog item title end-->

						<!-- catalog item info start -->
						<div class="short-item__item-info">
							<div class="short-item__item-rating">
								<img src="img/icons/star-activ.jpg" alt="1">
								<img src="img/icons/star-activ.jpg" alt="2">
								<img src="img/icons/star-activ.jpg" alt="3">
								<img src="img/icons/star-activ.jpg" alt="4">
								<img src="img/icons/star-pasiv.svg" alt="5">
							</div>

							<div class="short-item__item-comment">
								<a class="short-item__comment-link" href="#">2</a>
							</div>
						</div>
						<!-- catalog item info end -->

						<!-- button cart start-->
						<!-- button cart end-->
						<a class="short-item__add-cart" href="#">В корзину</a>
					</div>
					<!-- catalog item end -->

					<!-- 3 catalog item start -->
					<div class="short-item__item">

						<!-- catalog img start -->
						<a class="short-item__img-link" href="#">
							<div class="short-item__lt-info">
								<span class="short-item__new">Новинка</span>
								<span class="short-item__present">Подарок</span>
							</div>

							<div class="short-item__lb-info">
								<span class="short-item__discount">-20%</span>
							</div>

							<img src="img/catalog-img-3.png" alt="" class="short-item__img">
						</a>
						<!-- catalog img end -->

						<!-- catalog price start -->
						<div class="short-item__price">
							<p class="short-item__price-num">8 500 грн</p>
							<s class="short-item__price-s-num">10 000 грн</s>
						</div>
						<!-- catalog price end -->

						<!-- catalog item title start-->
						<div class="short-item__item-title">
							<a class="short-item__item-link" href="#">Микроволновая печь WHIRLPOOL AMW 730 IX</a>
						</div>
						<!-- catalog item title end-->

						<!-- catalog item info start -->
						<div class="short-item__item-info">
							<div class="short-item__item-rating">
								<img src="img/icons/star-activ.jpg" alt="1">
								<img src="img/icons/star-activ.jpg" alt="2">
								<img src="img/icons/star-activ.jpg" alt="3">
								<img src="img/icons/star-activ.jpg" alt="4">
								<img src="img/icons/star-pasiv.svg" alt="5">
							</div>

							<div class="short-item__item-comment">
								<a class="short-item__comment-link" href="#">2</a>
							</div>
						</div>
						<!-- catalog item info end -->

						<!-- button cart start-->
						<span class="short-item__add-cart-disabled">Нет в наличии</span>
						<!-- button cart end-->
					</div>
					<!-- catalog item end -->

					<!-- 4 catalog item start -->
					<div class="short-item__item">

						<!-- catalog img start -->
						<a class="short-item__img-link" href="#">
							<div class="short-item__lt-info">
								<span class="short-item__new">Новинка</span>
								<span class="short-item__present">Подарок</span>
							</div>

							<div class="short-item__lb-info">
								<span class="short-item__discount">-20%</span>
							</div>

							<img src="img/catalog-img-4.png" alt="" class="short-item__img">
						</a>
						<!-- catalog img end -->

						<!-- catalog price start -->
						<div class="short-item__price">
							<p class="short-item__price-num">16 280 грн</p>
							<s class="short-item__price-s-num">12 500 грн</s>
						</div>
						<!-- catalog price end -->

						<!-- catalog item title start-->
						<div class="short-item__item-title">
							<a class="short-item__item-link" href="#">Телефизор BLACKTON 2402B</a>
						</div>
						<!-- catalog item title end-->

						<!-- catalog item info start -->
						<div class="short-item__item-info">
							<div class="short-item__item-rating">
								<img src="img/icons/star-activ.jpg" alt="1">
								<img src="img/icons/star-activ.jpg" alt="2">
								<img src="img/icons/star-activ.jpg" alt="3">
								<img src="img/icons/star-activ.jpg" alt="4">
								<img src="img/icons/star-pasiv.svg" alt="5">
							</div>

							<div class="short-item__item-comment">
								<a class="short-item__comment-link" href="#">18</a>
							</div>
						</div>
						<!-- catalog item info end -->

						<!-- button cart start-->
						<a class="short-item__add-cart" href="#">В корзину</a>
						<!-- button cart end-->
					</div>
					<!-- catalog item end -->
				</div>
			</div>
		</div>
	</section>
	<!-- full-item end -->

<?php endif; ?>