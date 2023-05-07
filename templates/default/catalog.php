<?php if (!empty($data)) :  ?>

	<?= $this->breadcrumbs ?>

	<section class="category-page">
		<div class="container">
			<h1 class="category-page__title"><?= $data['name'] ?></h1>


			<div class="category-page__wrapper">

				<?php if (empty($goods)) : ?>

					<h3>по Вашему запросу ничего не найдено</h3>

				<?php else : ?>

					<!-- filter -->
					<form action="<?= $this->alias('catalog' . (!empty($this->parameters['alias']) ? '/' . 					$this->parameters['alias'] : '')) ?>" class="category-page__filter">

						<?php if (!empty($catalogFilters) || !empty($catalogPrices)) : ?>

							<!-- КНОПКА НА МАЛЫХ ЭКРАНАХ -->
							<a href="" class="category-filter__close-link">Фильтр</a>

							<div class="category-filter category-filter__small-height _spollers">

								<?php if (!empty($catalogPrices)) : ?>

									<h4 class="category-filter__title category-filter__title" style="padding-bottom: 50px;">Цена</h4>
									<div class="section-filter__body" style="padding-bottom: 35px;">
										<div class="filters-price__slider" id="range-slider" style="margin-left: 5px;"></div>
										<div class="filters-price__inputs">
											<label class="filters-price__label">
												<span class="filters-price__text">от</span>
												<input type="text" name="min_price" value="<?= $catalogPrices['min_price'] ?>" class="filters-price__input" id="input-0">
												<span class="filters-price__text">₽</span>
											</label>
											<label class="filters-price__label">
												<span class="filters-price__text">до</span>
												<input type="text" name="max_price" value="<?= $catalogPrices['max_price'] ?>" class="filters-price__input" id="input-1">
												<span class="filters-price__text">₽</span>
											</label>
										</div>
									</div>

								<?php endif; ?>

								<?php if (!empty($catalogFilters)) : ?>

									<?php foreach ($catalogFilters as $item) : ?>

										<h4 class="category-filter__title category-filter__title-open _spoller _active"><?= $item['name'] ?></h4>

										<div class="category-filter__block">

											<?php foreach ($item['values'] as $value) : ?>

												<input type="checkbox" name="filters[]" value="<?= $value['id'] ?>" <?= !empty($_GET['filters']) && in_array($value['id'], $_GET['filters']) ? 'checked' : '' ?>> <?= $value['name'] ?> (<?= $value['count'] ?? 0 ?>)<br>

											<?php endforeach; ?>

										</div>

									<?php endforeach; ?>

								<?php endif; ?>

								<div class="category-filter__more">
									<div class="category-filter__find">
										<button class="category-filter__find-button">Применить</button>
									</div>
								</div>

								<div class="category-filter__result">
									<div class="category-filter__result-name" onclick="location.href = location.pathname">Очистить фильтр</div>
									<div class="category-filter__result-clear"></div>
								</div>
							</div>



						<?php endif; ?>

					</form>



					<!-- content-->
					<div class="category-page__content">

						<!-- catalog products -->
						<div class="category-items">

							<!-- settings start-->
							<div class="category-items__settings">

								<!-- настройки вида -->
								<div class="category-items__view-settings">

									<div class="category-filter__sort-list">

										<?php if (!empty($order)) : ?>

											<div class="category-items__view-popular" href="#">Сортировать по</div>

											<div class="category-filter-list">

												<?php

												$GET = $_GET ?? [];

												?>

												<?php foreach ($order as $name => $item) : ?>

													<a href="<?= $this->alias('catalog/' .  ($this->parameters['alias'] ?? ''), array_merge($GET, ['order' => $item])) ?>" class="category-filter__item">
														<?= $name ?>
													</a>

												<?php endforeach; ?>

											</div>

										<?php endif; ?>

									</div>

									<div class="category-filter__num-list">
										<div class="category-items__view-num" href="#">Показывать: <b>10</b></div>

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

<?php endif; ?>