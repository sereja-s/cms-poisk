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

							<span class="full-item__code-item">арт. <?= $data['article'] ?></span>

						<?php endif; ?>

					</div>
				</div>

				<div class="full-item__info">

					<div class="full-item__info-a">
						<?php if (!empty($data['discount'])) : ?>
							<span class="short-item__discount">-<?= $data['discount'] ?>%</span>
						<?php endif; ?>
						<?php if (!empty($data['new'])) : ?>
							<span class="short-item__new">Новинка</span>
						<?php endif; ?>

						<?php if (!empty($data['hit'])) : ?>
							<span class="short-item__present">Хит</span>
						<?php endif; ?>

						<?php if (!empty($data['hot'])) : ?>
							<span class="short-item__hot">Акция</span>
						<?php endif; ?>
					</div>

					<div class="full-item__info-b">
						<div class="short-item__item-rating">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="1">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="2">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="3">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="4">
							<img src="<?= PATH . TEMPLATE ?>assets/img/icons/star-activ.jpg" alt="4">
						</div>
					</div>

				</div>

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
					<div class="full-item__price" data-productContainer>
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

								<div class="card-main-info-size">
									<label class="card-main-info-size__item js-sizeCounter">

										<span class="card-main-info-size__head">
											Количество:
										</span>
										<span class="card-main-info-size__body">
											<span class="card-main-info-size__control button card-main-info-size__control_minus js-counterDecrement" data-quantityMinus></span>
											<span class="card-main-info-size__count js-counterShow" data-quantity><?= $this->cart['goods'][$data['id']]['qty'] ?? 1 ?></span>
											<span class="card-main-info-size__control button card-main-info-size__control_plus js-counterIncrement" data-quantityPlus></span>
										</span>

									</label>
								</div>

								<div class="full-item__payment-method" style="margin: 10px;">
									Наличие товара и способ оплаты:<br>
									<b>уточняйте у менеджера по указанным телефонам</b>
								</div>

							</div>


							<div class="full-item__buy">
								<!-- <a data-onClick href="#popup-buy-one-click" class="full-item__buy-click popup-open-modal">
									Купить в 1 клик
								</a> -->

								<a data-addToCart="<?= $data['id'] ?>" <?= !empty($this->cart['goods'][$data['id']]) ? 'data-toCartAdded' : '' ?> href="#" class="full-item__add-to-cart-button">
									Добавить в корзину
								</a>
							</div>
						</div>


						<div class="full-item__delivery-info">
							<div class="full-item__di-item">
								<h4 class="full-item__di-title full-item__di-title-garanty">Гарантия</h4>

								<div class="full-item__di-show">
									<div class="full-item__di-text">
										<p>Товар сертифицирован</p>
									</div>

									<div class="full-item__di-link">
										<p><a href="#">Информация о гарантии</a></p>
									</div>
								</div>

							</div>

							<div class="full-item__di-item">
								<h4 class="full-item__di-title full-item__di-title-delivery">Доставка</h4>

								<div class="full-item__di-show">
									<div class="full-item__di-text">

										<?= !empty($deliveryInfo['content']) ? $deliveryInfo['content'] : '' ?>

									</div>
								</div>

							</div>

						</div>
					</div>

				</div>

			</div>

			<div id="full-item__tabs" class="full-item__tabs">
				<ul class="full-item__tabs-menu">
					<li class="full-item__tabs-menu-item"><a href="#tabs-1">Характеристики</a></li>
					<li class="full-item__tabs-menu-item"><a href="#tabs-2">Описание</a></li>
				</ul>

				<div id="tabs-1">
					<div class="full-item__tabs-table">
						<div class="full-item__table">

							<?php if ($data['filters']) : ?>

								<?php foreach ($data['filters'] as $item) : ?>

									<div class="full-item__table">

										<div class="full-item__table-name"><span><?= $item['name'] ?></span></div>
										<div class="full-item__table-param"><?= implode(', ', array_column($item['values'], 'name')) ?></div>

									</div>

								<?php endforeach; ?>

							<?php endif; ?>

						</div>

					</div>
				</div>
				<div id="tabs-2">

					<?= $data['content'] ?>

				</div>

			</div>

			<!-- <div class="full-item__recommendation">
				<h3 class="h3-title full-item__recommendation-title">C этим товаром покупают</h3>

				<div class="full-item__recommendation-wrapper">

					<div class="short-item__item">

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
						

						
						<div class="short-item__price">
							<p class="short-item__price-num">12 199 грн</p>
							<s class="short-item__price-s-num">15 199 грн</s>
						</div>
						
						<div class="short-item__item-title">
							<a class="short-item__item-link" href="#">Водонагреватель Electrolux EWH 80 Formax</a>
						</div>
						
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
						
						<a class="short-item__add-cart" href="#">В корзину</a>
						
					</div>

				</div>
			</div> -->
		</div>
	</section>
	<!-- full-item end -->

<?php endif; ?>