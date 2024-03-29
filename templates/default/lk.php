<main class="main">

	<div class="container">
		<div class="wrapper wrapper_center">
			<h1 class="page-title">Мои заказы</h1>
		</div>
	</div>

	<section class="section">
		<div class="container">
			<div class="wrapper_internal wrapper_lk">
				<aside class="internal-aside internal-aside_lk">
					<div class="internal-aside-items">
						<a href="#" data-popup="login-popup" data-user-info class="internal-aside-item internal-aside-item_active">
							Мой аккаунт </a>
						<a href="<?= $this->alias('lk') ?>" class="internal-aside-item ">
							Мои заказы </a>
						<a href="<?= $this->alias(['login' => 'logout']) ?>" class="internal-aside-item ">
							Выход </a>

						<!-- Выпуск №158 | Пользовательская часть | Изменение данных пользователя -->
						<script>
							document.addEventListener('DOMContentLoaded', () => {
								/* здесь true значит сменили фазу(сработаем на фазе спуска) */
								document.querySelector('[data-user-info]').addEventListener('click', () => {

									let popup = document.querySelector('.login-popup')

									if (popup) {

										let forms = popup.querySelectorAll('form')

										if (typeof forms[1] !== 'undefined') {

											forms[1].remove()
										}

										forms[0].querySelector('button[type="submit"]').innerHTML = 'Изменить данные'

										/* используем нулевую последовательность для удаления заголовка(если он есть) если форма в состоянии редактирования данных пользователя */
										popup.querySelector('h3')?.remove()
										popup.querySelector('p')?.remove()

										/* при редактировании разрешим оставлять поле с паролем незаполненные, т.е. неизменнными */
										popup.querySelectorAll('[type="password"]').forEach(item => item.removeAttribute('required'))
									}
								}, true)
							})
						</script>

					</div>
				</aside>

				<?php if (empty($orders)) : ?>

					<p>Вы ещё не сделали заказ у нас</p>

				<?php else : ?>

					<div class="cabinet cabinet_switches lk-body">

						<div class="switchTitles second">

							<?php if (!empty($currentOrder)) : ?>

								<div class="active" data-innerswitch="order_switch1">Текущий заказ</div>

							<?php endif; ?>

							<div data-innerswitch="order_switch2" class="">Все заказы (<?= count($orders) ?>)</div>
						</div>

						<script>
							document.addEventListener('DOMContentLoaded', () => {

								let innerSwitch = document.querySelectorAll('[data-innerswitch]')

								let innerSwitched = document.querySelectorAll('[data-innerswitched]')

								if (innerSwitched.length) {

									innerSwitch.forEach((item, index) => {

										item.addEventListener('click', () => {

											if (typeof innerSwitched[index] !== 'undefined' && !item.classList.contains('active')) {

												innerSwitch.forEach(el => el.classList.remove('active'))
												innerSwitched.forEach(el => el.classList.remove('active'))

												item.classList.add('active')
												innerSwitched[index].classList.add('active')

											}

										})

									})

								}

							})
						</script>

						<?php if (!empty($currentOrder)) : ?>

							<div class="active" data-innerswitched="order_switch1">
								<div class="order_title">
									<h3>
										Заказ №<?= $currentOrder['id'] ?>
									</h3>
								</div>
								<ul class="info_panel">
									<li>
										<span class="name">
											Всего:
										</span>
										<span class="info">
											Всего товаров: <?= count($currentOrder['join']['orders_goodsnew']) ?>
										</span>
									</li>
									<li>
										<span class="name">
											Стоимость:
										</span>
										<span class="info">
											<?= $currentOrder['total_sum'] ?> ₽
										</span>
									</li>
									<li>
										<span class="name">
											Дата формирования:
										</span>
										<span class="info">
											<?= $currentOrder['date'] ?>
										</span>
									</li>
									<li>
										<span class="name">
											Статус:
										</span>
										<span class="info">
											<?= $currentOrder['join']['orders_statuses']['name'] ?>
										</span>
									</li>
								</ul>

								<?php if (!empty($currentOrder['join']['orders_goodsnew'])) : ?>

									<div class="table_wrap">
										<table>
											<thead>
												<tr>
													<th>ID</th>
													<th>Наименование</th>
													<th>Количество</th>
													<th>Стоимость</th>
												</tr>
											</thead>
											<tbody>

												<?php foreach ($currentOrder['join']['orders_goodsnew'] as $item) : ?>

													<tr>
														<td><?= $item['id'] ?></td>
														<td>
															<div class="flex_wrap">
																<b>
																	<?= $item['name'] ?>
																</b>
															</div>
														</td>
														<td>
															<?= $item['qty'] ?> шт.
														</td>
														<td>
															<?= $item['price'] ?> ₽
														</td>
													</tr>

												<?php endforeach; ?>

											</tbody>
										</table>
									</div>

								<?php endif; ?>

								<div class="table_total">
									<div class="delivery">
										<div>
											<b>
												Способ оплаты:
											</b>
											<span>
												<?= $currentOrder['join']['payments']['name'] ?>
											</span>
										</div>
										<div>
											<b>
												Способ получения:
											</b>
											<span>
												<?= $currentOrder['join']['delivery']['name'] ?>
											</span>
										</div>
									</div>
									<div class="totally">
										<b>Итоговая стоимость:</b>
										<?= $currentOrder['total_sum'] ?> ₽
									</div>
								</div>

							</div>

						<?php endif; ?>

						<div data-innerswitched="order_switch2" class="<?= empty($currentOrder) ? 'active' : '' ?>">
							<div class="table_wrap">
								<table class="second_table">
									<thead>
										<tr>
											<th>Номер</th>
											<th>Дата формирования</th>
											<th>Стоимость</th>
											<th>Статус</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										<?php foreach ($orders as $item) : ?>

											<tr>
												<td>№<?= $item['id'] ?></td>
												<td>
													<?= $item['date'] ?>
												</td>
												<td>
													<?= $item['total_sum'] ?> ₽
												</td>
												<td>
													<span class="status "><?= $item['join']['orders_statuses']['name'] ?></span>
												</td>
												<td>
													<a href="<?= $this->alias(['lk' => 'order', 'id' => $item['id']]) ?>">Подробнее</a>
												</td>
											</tr>

										<?php endforeach; ?>

									</tbody>
								</table>
							</div>
						</div>

					</div>

				<?php endif; ?>

			</div>
		</div>
	</section>



</main>