<?= $this->breadcrumbs ?>

<section class="category-page">
	<div class="container">
		<h1 class="category-page__title"><?= $section_top['name'] ?></h1>

		<div class="page-seven seven">

			<?php if (!empty($services)) : ?>

				<div class="category-page__title amk-title">Виды декоративного покрытия АМК</div>

				<div class="eight-leftside__question"><?= $section_top['short_content'] ?></div>

				<div class="seven__block">
					<div class="seven__items">

						<?php foreach ($services as $service) : ?>

							<div class="seven__item">
								<div class="seven__image">
									<img src="<?= $this->img($service['img']) ?>" alt="<?= $service['name'] ?>">
								</div>
								<!-- <div class="seven__date">19 Jan 2023</div> -->
								<div class="seven__subtitle"><?= $service['name'] ?></div>
								<div class="seven__text"><?= $service['short_content'] ?></div>
								<!-- <div class="seven__buttons">
									<div class="seven__btn">Plumbing</div>
									<div class="seven__btn">Architecture</div>
									<div class="seven__btn">Maintenance</div>
								</div> -->
							</div>

						<?php endforeach; ?>

					</div>
				</div>



			<?php endif; ?>

		</div>

		<div class="page-seven seven">

			<?php if (!empty($amkColors)) : ?>

				<div class="category-page__title amk-title">Цвета декоративного покрытия АМК</div>

				<div class="eight-leftside__question"><?= $section_top['title'] ?></div>

				<div class="seven__block">
					<div class="seven__items">

						<?php foreach ($amkColors as $color) : ?>

							<div class="seven__item">
								<div class="seven__image">
									<img src="<?= $this->img($color['img']) ?>" alt="<?= $color['name'] ?>">
								</div>
								<!-- <div class="seven__date">19 Jan 2023</div> -->
								<div class="seven__subtitle"><?= $color['name'] ?></div>
								<div class="seven__text"><?= $color['short_content'] ?></div>

							</div>

						<?php endforeach; ?>

					</div>
				</div>



			<?php endif; ?>

		</div>
		<div class="page-seven seven">

			<div class="category-page__title amk-title">О декоративном покрытии АМК</div>

			<div class="eight-leftside__question"><?= $section_top['description'] ?></div>

		</div>

		<?= $this->messageButton ?>

	</div>
</section>