<?= $this->breadcrumbs ?>

<section class="cart-page">
	<div class="container">
		<h1 class="h3-title cart-page__title">Корзина</h1>

		<?php if (empty($this->cart['goods'])) : ?>

			<p>Ваша корзина пуста</p>

			<a href="<?= $this->alias('catalog') ?>" class="cart-page__delivery-button-link" style="text-align: center; max-width: max-content; margin-top: 50px">Перейти в каталог</a>

		<?php else : ?>

			<div class="cart-page__wrapper">

				<div class="cart-page__left">

					<?php foreach ($this->cart['goods'] as $item) : ?>

						<div class="cart-page__item" data-productContainer>

							<div class="cart-page__item-left">

								<div class="cart-page__item-image">
									<a href="#">
										<img class="cart-page__item-img" src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>">
									</a>
								</div>

								<div class="cart-page__item-content">
									<h2 class="cart-page__item-title"><a href="#"><?= $item['name'] ?></a></h2>

									<?php if (!empty($data['article'])) : ?>

										<p class="cart-page__item-code">арт. <?= $data['article'] ?></p>

									<?php endif; ?>

								</div>
							</div>

							<div class="cart-page__item-right">

								<div class="cart-page__item-num">
									<label class="card-main-info-size__item js-sizeCounter" style="padding-left: 0;">

										<span class="card-main-info-size__head">
											Количество:
										</span>
										<span class="card-main-info-size__body">
											<span class="card-main-info-size__control button card-main-info-size__control_minus js-counterDecrement" data-quantityMinus></span>
											<span class="card-main-info-size__count js-counterShow" data-quantity><?= $this->cart['goods'][$item['id']]['qty'] ?></span>
											<span class="card-main-info-size__control button card-main-info-size__control_plus js-counterIncrement" data-quantityPlus></span>
										</span>

										<!-- добавили скрытый элемент с атрибутом: data-toCartAdded (для пересчёта кол-ва товара при нажатии на + или -) -->
										<a style="display: none" data-addToCart="<?= $item['id'] ?>" data-toCartAdded href="#" class="full-item__add-to-cart-button">
										</a>

									</label>
								</div>

								<div class="cart-page__item-price">
									<p class="cart-page__price-num"><?= $item['price'] ?> руб.</p>

									<?php if (!empty($item['old_price'])) : ?>

										<s class="cart-page__price-s-num"><?= $item['old_price'] ?> руб.</s>

									<?php endif; ?>


									<a class="cart-page__delete-link" href="<?= $this->alias(['cart' => 'remove', 'id' => $item['id']]) ?>">Удалить</a>
								</div>
							</div>
						</div>

					<?php endforeach; ?>

				</div>

				<div class="cart-page__right">
					<div class="cart-page__info">
						<div class="cart-page__total-price">
							<p>Итого</p>

							<p data-totalSum><?= $this->cart['total_sum'] ?> руб.</p>

						</div>

						<?php if (!empty($this->cart['total_old_sum'])) : ?>

							<div class="cart-page__total-item">

								<p>Сумма без скидки</p>
								<p><span data-totalOldSum><?= $this->cart['total_old_sum'] ?> руб.</span></p>

							</div>

						<?php endif; ?>

						<div class="cart-page__total-item">
							<p>Скидка</p>
							<p><span class="cart-page__ti-red" data-totalDiscount><?= $this->cart['total_discount'] ?> руб.</span></p>
						</div>

						<div class="cart-page__total-item">
							<p>После оформления заказа наш сотрудник свяжется с вами для уточнения заказа (наличия товара, стоимости, оплаты и др.) </p>
						</div>

						<div class="cart-page__delivery-button">
							<a href="#cart-contacts" class="cart-page__delivery-button-link scroll-to" style="text-align: center;">Перейти к оформлению заказа</a>
						</div>

						<div class="category-filter__result">
							<a href="<?= $this->alias(['cart' => 'remove']) ?>" class="category-filter__result-name">Очистить корзину</a>
							<div class="category-filter__result-clear"></div>
						</div>

					</div>
				</div>

			</div>

			<form class="order-registration-form" method="post" action="<?= $this->alias('orders') ?>">

				<div id="cart-contacts" class="cart-page__get-delivery">

					<?php if (!empty($this->delivery)) : ?>

						<h3 class="h3-title cart-page__get-delivery-title">Способ доставки</h3>

						<div class="cart-page__gd-item">

							<?php foreach ($this->delivery as $key => $item) : ?>

								<label class="cart-page__gd-item-label"><input type="radio" value="<?= $item['id'] ?>" name="delivery_id" <?= !$key ? 'checked' : '' ?>>
									<span><?= $item['name'] ?></span>
								</label>

							<?php endforeach; ?>

						</div>

					<?php endif; ?>

				</div>

				<div class="cart-page__get-pay">

					<?php if (!empty($this->loaders)) : ?>

						<h3 class="h3-title cart-page__get-pay-title">Способ разгрузки</h3>

						<div class="cart-page__gp-wrapper">

							<?php foreach ($this->loaders as $key => $item) : ?>

								<label class="cart-page__gp-lable">
									<input type="radio" value="<?= $item['id'] ?>" name="loaders_id" <?= !$key ? 'checked' : '' ?>>
									<span style="padding-left: 5px;"><?= $item['name'] ?></span>
								</label>

							<?php endforeach; ?>

						</div>

					<?php endif; ?>

				</div>
				<div class="cart-page__get-pay">

					<?php if (!empty($this->payments)) : ?>

						<h3 class="h3-title cart-page__get-pay-title">Способ оплаты</h3>

						<div class="cart-page__gp-wrapper">

							<?php foreach ($this->payments as $key => $item) : ?>

								<label class="cart-page__gp-lable">
									<input type="radio" value="<?= $item['id'] ?>" name="payments_id" <?= !$key ? 'checked' : '' ?>>
									<span style="padding-left: 5px;"><?= $item['name'] ?></span>
								</label>

							<?php endforeach; ?>

						</div>

					<?php endif; ?>

				</div>

				<div class="cart-page__get-contacts">
					<h3 class="h3-title cart-page__get-contacts-title">Контактные данные</h3>

					<div class="cart-page__gс-form">
						<div class="cart-page__gc-input-block">

							<div class="cart-page__gc-item-input">
								<label class="cart-page__gc--label">Имя</label>
								<input class="cart-page__gc--input" type="text" name="name" placeholder="Ваше имя" value="<?= $this->setFormValues('name', 'userData') ?>">
							</div>

							<div class="cart-page__gc-item-input">
								<label class="cart-page__gc--label">Телефон</label>
								<input class="cart-page__gc--input" type="tel" name="phone" placeholder="Телефон" value="<?= $this->setFormValues('phone', 'userData') ?>">
							</div>

							<div class="cart-page__gc-item-input">
								<label class="cart-page__gc--label">Email</label>
								<input class="cart-page__gc--input" type="email" name="email" placeholder="E-mail" value="<?= $this->setFormValues('email', 'userData') ?>">
							</div>

							<div class="cart-page__gc-item-input">
								<label class="cart-page__gc--label">Адрес</label>
								<textarea class="cart-page__gc--input" name="address"><?= $this->setFormValues('address', 'userData') ?></textarea>
							</div>

						</div>
					</div>

					<div class="cart-page__gс-form">
						<div class="cart-page__gc-item-textarea">
							<label class="cart-page__gc--label">Дополнительная информация</label>
							<textarea name="info" placeholder="Укажите если нужна услуга грузчиков и т.д."><?= $this->setFormValues('info', 'userData') ?></textarea>
						</div>
					</div>

					<div class="cart-page__gс-form">
						<div class="cart-page__gc-item-check">
							<label><input type="checkbox" required> Соглашаюсь с правилами обработки персональных данных</label>

							<?php if (!empty($this->menu['information'])) : ?>

								<?php foreach ($this->menu['information'] as $item) : ?>

									<?php if ($item['alias'] === 'politika-konfidentsialnosti') : ?>

										<a class="footer__nav-link" href="<?= $this->alias(['information' => $item['alias']]) ?>" style="text-decoration: underline;"><?= $item['name'] ?></a>

									<?php endif; ?>

								<?php endforeach; ?>

							<?php endif; ?>

						</div>
					</div>

					<div class="cart-page__total-price">

						<p>сумма к оплате:</p>

						<p data-totalSum><?= $this->cart['total_sum'] ?> руб.</p>

					</div>

					<div class="cart-page__delivery-button">
						<input class="cart-page__delivery-button-link" type="submit" value="Оформить заказ" style="text-align: center;">
					</div>

				</div>

			</form>

		<?php endif; ?>

	</div>
</section>