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
							<p>Наличие товара и способ оплаты: уточняйте у менеджера по указанным телефонам</p>
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

			</div>

		<?php endif; ?>

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
		</div>

	<?php endif; ?>

	<div class="cart-page__get-contacts">
		<h3 class="h3-title cart-page__get-contacts-title">Контактные данные</h3>

		<div class="cart-page__gс-form">
			<div class="cart-page__gc-input-block">
				<div class="cart-page__gc-item-input">
					<label class="cart-page__gc--label">Телефон</label>
					<input class="cart-page__gc--input" type="tel">
				</div>

				<div class="cart-page__gc-item-input">
					<label class="cart-page__gc--label">Email</label>
					<input class="cart-page__gc--input" type="email">
				</div>

				<div class="cart-page__gc-item-input">
					<label class="cart-page__gc--label">Имя</label>
					<input class="cart-page__gc--input" type="text">
				</div>

				<div class="cart-page__gc-item-input">
					<label class="cart-page__gc--label">Фамилия</label>
					<input class="cart-page__gc--input" type="text">
				</div>

				<div class="cart-page__gc-item-input">
					<label class="cart-page__gc--label">Город</label>
					<input class="cart-page__gc--input" type="text">
				</div>

				<div class="cart-page__gc-item-input">
					<label class="cart-page__gc--label">Адрес</label>
					<input class="cart-page__gc--input" type="text">
				</div>

			</div>
		</div>

		<div class="cart-page__gс-form">
			<div class="cart-page__gc-item-textarea">
				<label class="cart-page__gc--label">Комментарий</label>
				<textarea></textarea>
			</div>
		</div>

		<div class="cart-page__gс-form">
			<div class="cart-page__gc-item-check">
				<label><input type="checkbox"> Согласен на обработку персональных данных</label>
				<a class="footer__nav-link" href="#" style="text-decoration: underline;">Политика конфиденциальности</a>
			</div>
		</div>

		<div class="cart-page__delivery-button">
			<a href="#" class="cart-page__delivery-button-link scroll-to" style="text-align: center;">Оформить заказ</a>
		</div>

	</div>

<?php endif; ?>

	</div>
</section>