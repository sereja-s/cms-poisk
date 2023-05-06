<?php if (!empty($data)) :  ?>

	<?= $this->breadcrumbs ?>

	<section class="category-page">
		<div class="container">
			<h1 class="category-page__title"><?= $data['name'] ?></h1>

			<!-- <div class="category-page__mini-filter">
				<a href="#">Инверторные</a>
				<a href="#">Инверторные с дисплеем</a>
				<a href="#">Недорогие</a>
				<a href="#">Ширина 50 см</a>
			</div> -->


			<div class="category-page__wrapper">

				<?php if (empty($goods)) : ?>

					<h3>по Вашему запросу ничего не найдено</h3>

				<?php else : ?>

					<!-- filter -->
					<div class="category-page__filter">

						<?php if (!empty($catalogFilters) || !empty($catalogPrices)) : ?>

							<a href="" class="category-filter__close-link">Фильтр</a>

							<div class="category-filter category-filter__small-height _spollers">

								<h4 class="category-filter__title category-filter__title" style="padding-bottom: 50px;">Цена</h4>
								<div class="section-filter__body" style="padding-bottom: 35px;">
									<div class="filters-price__slider" id="range-slider" style="margin-left: 5px;"></div>
									<div class="filters-price__inputs">
										<label class="filters-price__label">
											<span class="filters-price__text">от</span>
											<input autocomplete="off" type="text" name="form[]" class="filters-price__input" id="input-0">
											<span class="filters-price__text">₽</span>
										</label>
										<label class="filters-price__label">
											<span class="filters-price__text">до</span>
											<input autocomplete="off" type="text" name="form[]" class="filters-price__input" id="input-1">
											<span class="filters-price__text">₽</span>
										</label>
									</div>
								</div>

								<h4 class="category-filter__title category-filter__title-open _spoller _active">Производитель (245)</h4>
								<div class="category-filter__block">
									<input type="checkbox"> Atlant (33)<br>
									<input type="checkbox"> Samsung (57)<br>
									<input type="checkbox"> LG (4)<br>
									<input type="checkbox"> Bosh (7)<br>
									<input type="checkbox"> Liebherr (13)<br>
								</div>

								<h4 class="category-filter__title category-filter__title-open _spoller _active">Вид холодильника (245)</h4>
								<div class="category-filter__block">
									<input type="checkbox"> С морозильной камерой (45)<br>
									<input type="checkbox"> Без морозильной камеры (56)<br>
								</div>

								<h4 class="category-filter__title category-filter__title-open _spoller _active">Морозильная камера (245)</h4>
								<div class="category-filter__block">
									<input type="checkbox"> Сбоку (7)<br>
									<input type="checkbox"> Снизу (34)<br>
									<input type="checkbox"> Сверху (87)<br>
									<input type="checkbox"> Отсутствует (14)<br>
								</div>



								<div class="category-filter__result">
									<div class="category-filter__result-name">Очистить фильтр</div>
									<div class="category-filter__result-clear"></div>
								</div>
							</div>

							<div class="category-filter__more">

								<div class="category-filter__find">
									<button class="category-filter__find-button" type="submit">Применить</button>
								</div>
							</div>

						<?php endif; ?>

					</div>

					<!-- content-->
					<div class="category-page__content">

						<!-- catalog products -->
						<div class="category-items">

							<!-- settings start-->
							<div class="category-items__settings">

								<!-- настройки вида -->
								<div class="category-items__view-settings">
									<div class="category-filter__sort-list">
										<a class="category-items__view-popular" href="#">Сначала популярные</a>

										<div class="category-filter-list">
											<a class="category-filter__item" href="#">Сначала популярные</a>
											<a class="category-filter__item" href="#">Сначала дешевые</a>
											<a class="category-filter__item" href="#">Сначала дорогие</a>
											<a class="category-filter__item" href="#">Сначала с высоким рейтингом</a>
										</div>
									</div>


									<div class="category-filter__num-list">
										<a class="category-items__view-num" href="#">На странице: <b>10</b></a>

										<div class="category-num-list">
											<a class="category-num__item" href="#">10</a>
											<a class="category-num__item" href="#">20</a>
											<a class="category-num__item" href="#">30</a>
										</div>
									</div>





									<a href="#" class="category-items__mobile-filter-link">Фильтр
										<span>1</span>
									</a>
								</div>
							</div>
							<!-- settings end-->

							<div class="category-items__wrapper">

								<?php foreach ($goods as $item) {

									$this->showGoods($item, [], 'goodsItemCat');
								} ?>

							</div>

							<div class="page-nav">
								<a class="page-nav__prev-page" href="#"></a>
								<span class="page-nav__current-page">1</span>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
								<span>...</span>
								<a href="#">17</a>
								<a class="page-nav__next-page" href="#"></a>
							</div>

						</div>
					</div>

				<?php endif; ?>

			</div>
		</div>
	</section>

	<!-- <div class="compare-info">
	<div class="container">
		<div class="compare-info__wrapper">
			<div class="compare-info__link">
				<a href="#" class="compare-info__compare-fixed-name">3 товара в сравнении</a>
				<div class="compare-info__compare-fixed-clear"></div>
			</div>
		</div>
	</div>
</div> -->

<?php endif; ?>