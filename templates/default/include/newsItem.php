<?php if (!empty($data)) : ?>

	<div class="index-news__item">
		<a class="index-news__link" href="<?= $this->alias(['news' => $data['alias']]) ?>">
			<img class="index-news__img" src="<?= $this->img($data['img']) ?>" alt="<?= $data['name'] ?>">
			<div class="index-news__item-bg">
				<span class="index-news__title"><?= $data['name'] ?></span>
			</div>
		</a>
	</div>

<?php endif; ?>