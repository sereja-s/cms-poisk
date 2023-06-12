<?php if (!empty($this->news)) : ?>

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

					<?php foreach ($this->news as $item) {

						$this->showGoods($item, [], 'newsItem');
					} ?>

				</div>

				<!-- <div class="news-list__wrapper">
							<div class="news-list__item">
								<a href="#">
									<img class="news-list__img" src="img/news-2.jpg" alt="Как выбрать снегоуборщик">
								</a>

								<div class="news-list__item-title">
									<a class="news-link__link" href="#">PlayStation 5: захватывающее обновление, на которое мы надеялись</a>
								</div>

								<div class="news-list__text">
									В&nbsp;данной статье мы&nbsp;подробно разберем вопрос о&nbsp;выборе снегоуборочной машины.
								</div>
							</div>


						</div> -->

				<div class="page-nav">

				</div>
			</div>
	</section>

<?php endif; ?>