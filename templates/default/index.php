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


<section class="index-catalog">
	<div class="container">

		<?php if (!empty($goods) && !empty($arrHits)) : ?>

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

			<?php endforeach; ?>

		<?php endif; ?>

		<!-- baner start -->

		<?php if (!empty($goods) && !empty($arrHits)) : ?>

			<?php foreach ($arrHits as $key => $value) : ?>

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

			<?php endforeach; ?>

		<?php endif; ?>



		<?php if (!empty($goods) && !empty($arrHits)) : ?>

			<?php foreach ($arrHits as $key => $value) : ?>

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

		<?php endif; ?>

	</div>
</section>



<section class="catalog-list">
	<div class="container">
		<h3 class="h3-title catalog-list__main-title">Каталог</h3>

		<div class="catalog__list-wrapper">

			<?php if (!empty($this->arrCategory)) : ?>

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

			<?php endif; ?>

		</div>
	</div>
</section>

<section class="index-news">
	<div class="container">
		<div class="index-news__wrapper">
			<h3 class="index-news__main-title h3-title">Новости и обзоры</h3>

			<div class="index-news__list">
				<div class="index-news__item index-news__first-item">
					<a class="index-news__link" href="#">
						<div class="index-news__item-bg">
							<span class="index-news__extra-title">Эффективная уборка без лишних проводов</span>
							<span class="index-news__mini-title">Обзор на Робот-пылесос Xiaomi Mi Robot Vacuum
								Cleaner</span>
							<img class="index-news__img" src="<?= PATH . TEMPLATE ?>assets/img/news-1.png" alt="Эффективная уборка без лишних проводов">
						</div>
					</a>
				</div>

				<div class="index-news__item">
					<a class="index-news__link" href="#">
						<img class="index-news__img" src="<?= PATH . TEMPLATE ?>assets/img/news-2.jpg" alt="Как выбрать снегоуборщик">
						<div class="index-news__item-bg">
							<span class="index-news__title">Как выбрать снегоуборщик</span>
						</div>
					</a>
				</div>

				<div class="index-news__item">
					<a class="index-news__link" href="#">
						<img class="index-news__img" src="<?= PATH . TEMPLATE ?>assets/img/news-3.jpg" alt="Как выбрать стиральную машину">
						<div class="index-news__item-bg">
							<span class="index-news__title">Как выбрать стиральную машину</span>
						</div>
					</a>
				</div>

				<div class="index-news__item">
					<a class="index-news__link" href="#">
						<img class="index-news__img" src="<?= PATH . TEMPLATE ?>assets/img/news-4.jpg" alt="Самая дорогая видеоигра в мире Cyberpunk 2077 для TV Samsung 4K QLED">
						<div class="index-news__item-bg">
							<span class="index-news__title">Самая дорогая видеоигра в мире Cyberpunk 2077 для TV Samsung
								4K
								QLED</span>
						</div>
					</a>
				</div>

				<div class="index-news__item">
					<a class="index-news__link" href="#">
						<img class="index-news__img" src="<?= PATH . TEMPLATE ?>assets/img/news-5.jpg" alt="PlayStation 5: захватывающее обновление, на которое мы надеялись">
						<div class="index-news__item-bg">
							<span class="index-news__title">PlayStation 5: захватывающее обновление, на которое мы
								надеялись</span>
						</div>
					</a>
				</div>

				<div class="index-news__item">
					<a class="index-news__link" href="#">
						<img class="index-news__img" src="<?= PATH . TEMPLATE ?>assets/img/news-6.jpg" alt="Путеводитель по покупкам: стоит ли покупать ноутбук или настольный компьютер?">
						<div class="index-news__item-bg">
							<span class="index-news__title">Путеводитель по покупкам: стоит липокупать ноутбук или
								настольный
								компьютер?</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="index-stat">
	<div class="container">
		<div class="index-stat__wrapper">
			<h3 class="index-stat__title h3-title">Техника, которая делает вашу жизнь проще</h3>

			<p>Порой возникает ситуация, когда в&nbsp;какой-то момент в&nbsp;вашем доме требуется заменить один или
				несколько бытовых приборов. Возможно также, что вы&nbsp;обустраиваете новый дом или квартиру, начиная
				с&nbsp;нуля. Это включает в&nbsp;себя покупку крупной бытовой техники, такую ​​как холодильники
				стиральные
				и&nbsp;посудомоечные машины, а&nbsp;также более мелкую бытовую технику, которая значительно сокращает
				время
				на&nbsp;кухне или при уборке. Наш интернет-магазин бытовой техники поможет с&nbsp;выбором, гарантируя
				низкие
				цены и&nbsp;выгодные покупки на&nbsp;все линейки товаров.</p>
			<p><b>Холодильники</b></p>
			<p>Подобно автомобилю или другой крупногабаритной технике, стоит знать, на&nbsp;что обращать внимание при
				выборе
				холодильника для кухни. Например, при выборе холодильника важно знать, что искать, например, сколько
				дверей
				вы&nbsp;хотите, где разместить морозильную камеру, хотите&nbsp;ли вы&nbsp;внешний льдогенератор,
				диспенсер для
				воды, предназначенные для сохранения свежести ваших продуктов на&nbsp;более длительные периоды
				времени.
				Размер
				является важным фактором, от&nbsp;небольшие по&nbsp;объему до&nbsp;больших, которые идеально подходят
				для
				офисов, комнат общежития и&nbsp;малогабаритных квартир. Также важны другие параметры, такие как цвет,
				ширина,
				бренд и&nbsp;рейтинг.</p>
			<p><b>Тостеры</b></p>
			<p>Такую&nbsp;же внимательность при выборе крупногабаритной техники следует проявлять
				и&nbsp;в&nbsp;отношении
				небольших приборов. Учитывайте количество человек в&nbsp;семье, частоту пользования&nbsp;&mdash;
				от&nbsp;этого
				зависит, какой именно тостер следует рассмотреть: будет&nbsp;ли он&nbsp;на&nbsp;два или четыре ломтика
				хлеба,
				имеет он&nbsp;ручное или цифровое управление, и&nbsp;должен&nbsp;ли тостер быть определенного цвета,
				будет
				нержавеющая сталь сочетается с&nbsp;вашим декором? Вы&nbsp;даже можете выбрать тостер, который
				одновременно
				выполняет несколько функций, что дает ему преимущество на&nbsp;вашей кухне.</p>
			<p>
				<b>Микроволновые печи</b>
			</p>
			<p>Говоря об&nbsp;универсальных приборах, на&nbsp;кухне нет ничего более универсального, чем
				микроволновые
				печи.
				Эти устройства прошли долгий путь, прежде чем оказаться на&nbsp;нашей кухне. Микроволны не&nbsp;только
				разогревают пищу и&nbsp;напитки с&nbsp;помощью электромагнитных волн, но&nbsp;многие из&nbsp;них также
				обладают функцией конвекции. Они больше не&nbsp;предназначены для того, чтобы приготовить попкорн или
				подогреть еду для небольшого перекуса. Теперь вы&nbsp;можете готовить целые блюда, используя только
				микроволновую печь, а&nbsp;также выполнять другие задачи, такие как размораживание продуктов
				и&nbsp;размягчение сливочного масла. Микроволновки обычно доступны в&nbsp;трех видах:
				на&nbsp;столешнице,
				подвесные и&nbsp;встраиваемые. Опять&nbsp;же, есть факторы, которые следует учитывать при выборе
				микроволновой
				печи, и&nbsp;у&nbsp;нас есть разные модели, из&nbsp;которых вы&nbsp;можете выбрать. В&nbsp;наличии
				имеются
				небольшие устройства с&nbsp;объемом для приготовления пищи от&nbsp;13&nbsp;литров или меньше
				до&nbsp;44&nbsp;литров или более. Еще одно соображение&nbsp;&mdash; мощность, и&nbsp;у&nbsp;нас есть
				модели,
				которые варьируются от&nbsp;менее 700&nbsp;Вт до&nbsp;более 1000&nbsp;Вт; чем выше
				мощность&nbsp;&mdash;
				тем
				быстрее готовятся ваши продукты.</p>
		</div>
	</div>
</section>

<section class="footer-icons">
	<div class="container">
		<div class="footer-icons__wrapper">
			<!-- icons item start-->
			<div class="footer-icons__item">
				<div class="footer-icons__img">
					<img src="<?= PATH . TEMPLATE ?>assets/img/icons/footer-icon-1.svg" alt="11 лет опыт">
				</div>
				<div class="footer-icons__title">11 лет опыт</div>
			</div>

			<div class="footer-icons__item">
				<div class="footer-icons__img">
					<img src="<?= PATH . TEMPLATE ?>assets/img/icons/footer-icon-2.svg" alt="Возврат и обмен">
				</div>
				<div class="footer-icons__title">Возврат и обмен</div>
			</div>

			<div class="footer-icons__item">
				<div class="footer-icons__img">
					<img src="<?= PATH . TEMPLATE ?>assets/img/icons/footer-icon-3.svg" alt="Установка">
				</div>
				<div class="footer-icons__title">Установка</div>
			</div>

			<div class="footer-icons__item">
				<div class="footer-icons__img">
					<img src="<?= PATH . TEMPLATE ?>assets/img/icons/footer-icon-4.svg" alt="Высокое качество">
				</div>
				<div class="footer-icons__title">Высокое качество</div>
			</div>

			<div class="footer-icons__item">
				<div class="footer-icons__img">
					<img src="<?= PATH . TEMPLATE ?>assets/img/icons/footer-icon-5.svg" alt="Гарантия на все">
				</div>
				<div class="footer-icons__title">Гарантия на все</div>
			</div>

		</div>
	</div>
</section>