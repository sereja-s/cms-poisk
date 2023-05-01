<?php if (!empty($sales)) : ?>

	<section class="index-slider">
		<div class="container">
			<div class="index-slider__wrapper">
				<!-- wrapper bg slider-wrapper -->
				<div class="index-slider__wrapper-bg" style='background: url("<?= PATH . TEMPLATE ?>assets/img/Строй_Контакт_фон.jpg") center center/cover no-repeat fixed;'>

					<?php foreach ($sales as $item) : ?>

						<div class="index-slider__item">
							<div class="index-slider__item-wrapper">
								<div class="index-slider__item__content">
									<h3 class="index-slider__item-title"><?= $item['name'] ?></h3>
									<p class="index-slider__item-text"><?= $item['sub_title'] ?></p>
									<a class="index-slider__item-link" href="<?= $this->alias($item['external_alias']) ?>">Подробнее</a>
								</div>

								<div class="index-slider__item-picture">
									<img class="index-slider__item-img" src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>">
								</div>
							</div>
						</div>

					<?php endforeach; ?>

				</div>
			</div>
		</div>
	</section>

<?php endif; ?>


<?php if (!empty($goods) && !empty($arrHits)) : ?>

	<section class="index-catalog">
		<div class="container">

			<?php foreach ($arrHits as $key => $value) : ?>

				<?php if ($key === 'hit') : ?>

					<?php if (!empty($goods[$key])) : ?>

						<h3 class="h3-title index-catalog__main-title"><?= $value['name'] ?></h3>

						<div class="index-catalog__wrapper">

							<?php foreach ($goods[$key] as $item) {

								$this->showGoods($item, ['icon' => $value['icon']]);
							} ?>

						</div>

					<?php endif; ?>

				<?php endif; ?>

				<!-- baner start -->
				<?php if ($key === 'hot') : ?>

					<?php if (!empty($goods[$key])) : ?>

						<div class="index-catalog__banner fade">

							<?php foreach ($goods[$key] as $item) : ?>

								<a class="index-catalog__banner-link" href="#">

									<!-- baner content start-->
									<div class="index-catalog__banner-content">
										<h4 class="index-catalog__banner-title"><?= $item['name'] ?></h4>

										<div class="index-catalog__banner-text" style="padding-bottom: 10px;">
											<p>Успей приобрести всего за
												<?= !empty($item['price']) ? '<b>' . $item['price'] . 'руб.' . '</b>' : '<b>' . $item['old_price'] . 'руб.' . '</b>' ?>
											</p>
										</div>
									</div>
									<!-- baner content end-->

									<!-- image -->
									<div class="index-catalog__banner-img">
										<img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>">
									</div>

								</a>

							<?php endforeach; ?>

						</div>

					<?php endif; ?>

				<?php endif; ?>


				<?php if ($key === 'new') : ?>

					<?php if (!empty($goods[$key])) : ?>

						<h3 class="h3-title index-catalog__main-title"><?= $value['name'] ?></h3>

						<div class="index-catalog__wrapper">

							<?php foreach ($goods[$key] as $item) {

								$this->showGoods($item, ['icon' => $value['icon']]);
							} ?>

						</div>



					<?php endif; ?>

				<?php endif; ?>

			<?php endforeach; ?>

		</div>
	</section>

<?php endif; ?>


<?php if (!empty($this->arrCategory)) : ?>

	<section class="catalog-list">
		<div class="container">
			<h3 class="h3-title catalog-list__main-title">Каталог</h3>

			<div class="catalog__list-wrapper">

				<?php foreach ($this->arrCategory as $item) : ?>

					<div class="catalog-list__item">

						<h4 class="catalog-list__category-title"><?= $item['name'] ?></h4>

						<?php if (!empty($item['sub'])) : ?>

							<ul class="catalog-list__category-nav">

								<?php foreach ($item['sub'] as $sub) : ?>

									<li class="catalog-list__category-item"><a class="catalog-list__category-link" href="<?= $this->alias(['catalog' => $sub['alias']]) ?>"><?= $sub['name'] ?>
											(135)</a></li>

								<?php endforeach; ?>

							</ul>

						<?php endif; ?>
						<!-- <a href="#" class="catalog-list__category-all">Все товары</a> -->
					</div>

				<?php endforeach; ?>

			</div>
		</div>
	</section>

<?php endif; ?>


<?php if (!empty($news)) : ?>

	<section class="index-news">
		<div class="container">
			<div class="index-news__wrapper">
				<h3 class="index-news__main-title h3-title">Новости и обзоры</h3>

				<div class="index-news__list">
					<div class="index-news__item index-news__first-item">
						<a class="index-news__link" href="#">
							<div class="index-news__item-bg">
								<span class="index-news__extra-title"><?= $this->set['keywords'] ?></span>
								<span class="index-news__mini-title"><?= $this->set['description'] ?></span>
								<img class="index-news__img" src="<?= $this->img($this->set['promo_img']) ?>" alt="<?= $this->set['keywords'] ?>">
							</div>
						</a>
					</div>

					<?php foreach ($news as $item) {

						$this->showGoods($item, [], 'newsItem');
					} ?>

				</div>
			</div>
		</div>
	</section>

<?php endif; ?>

<section class="index-stat">
	<div class="container">
		<div class="index-stat__wrapper">
			<h3 class="index-stat__title h3-title"><?= $this->set['name'] ?></h3>

			<?= $this->set['short_content'] ?>

		</div>
	</div>
</section>

<?php if (!empty($advantages)) : ?>

	<section class="footer-icons">
		<div class="container">
			<div class="footer-icons__wrapper">

				<?php foreach ($advantages as $item) : ?>

					<div class="footer-icons__item">
						<div class="footer-icons__img">
							<img src="<?= $this->img($item['img']) ?>" alt="<?= $item['name'] ?>">
						</div>
						<div class="footer-icons__title"><?= $item['name'] ?></div>
					</div>

				<?php endforeach; ?>



			</div>
		</div>
	</section>

<?php endif; ?>