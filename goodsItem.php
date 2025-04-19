<?php if (!empty($data)) : ?>

	<div class="short-item__item">
		<a class="short-item__fast-view fast-view-ajax" href="item-fast-view.html">Быстрый просмотр</a>
		<!-- catalog img start -->
		<div class="short-item__img-link">

			<?php if (!empty($parameters['icon'])) : ?>

				<div class="short-item__lt-info">
					<?= $parameters['icon'] ?>
				</div>

			<?php endif; ?>

			<?php if (!empty($data['discount'])) : ?>

				<div class="short-item__lb-info">
					<span class="short-item__discount">-<?= $data['discount'] ?>%</span>
				</div>

			<?php endif; ?>

			<div class="short-item__rt-info">
				<span class="short-item__add-link"></span>
				<span class="short-item__add-compare"></span>
			</div>

			<a href="#">
				<img class="short-item__img" src="<?= $this->img($data['img']) ?>" alt="<?= $data['name'] ?>">
			</a>
		</div>
		<!-- catalog img end -->

		<!-- catalog price start -->
		<div class="short-item__price">
			<p class="short-item__price-num"><?= $data['price'] ?>руб.</p>
			<?= !empty($data['old_price']) ? '<s class="short-item__price-s-num">' . $data['old_price'] . ' руб.</s>' : '' ?>
		</div>
		<!-- catalog price end -->

		<!-- catalog item title start-->
		<div class="short-item__item-title">
			<a class="short-item__item-link" href="#"><?= $data['name'] ?></a>
		</div>
		<!-- catalog item title end-->


		<!-- button cart start-->
		<button class="short-item__add-cart" data-addToCart="<?= $data['id'] ?>" style="border: inherit;">В корзину</button>
		<!-- button cart end-->
	</div>

<?php endif; ?>