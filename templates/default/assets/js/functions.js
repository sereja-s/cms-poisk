// SlideToggle--------------------------------------------------------------------------------------------------------//
let _slideUp = (target, duration = 500) => {
	target.style.transitionProperty = 'height, margin, padding';
	target.style.transitionDuration = duration + 'ms';
	target.style.height = target.offsetHeight + 'px';
	target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	window.setTimeout(() => {
		target.style.display = 'none';
		target.style.removeProperty('height');
		target.style.removeProperty('padding-top');
		target.style.removeProperty('padding-bottom');
		target.style.removeProperty('margin-top');
		target.style.removeProperty('margin-bottom');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
		target.classList.remove('_slide');
	}, duration);
}
let _slideDown = (target, duration = 500) => {
	target.style.removeProperty('display');
	let display = window.getComputedStyle(target).display;
	if (display === 'none')
		display = 'block';

	target.style.display = display;
	let height = target.offsetHeight;
	target.style.overflow = 'hidden';
	target.style.height = 0;
	target.style.paddingTop = 0;
	target.style.paddingBottom = 0;
	target.style.marginTop = 0;
	target.style.marginBottom = 0;
	target.offsetHeight;
	target.style.transitionProperty = "height, margin, padding";
	target.style.transitionDuration = duration + 'ms';
	target.style.height = height + 'px';
	target.style.removeProperty('padding-top');
	target.style.removeProperty('padding-bottom');
	target.style.removeProperty('margin-top');
	target.style.removeProperty('margin-bottom');
	window.setTimeout(() => {
		target.style.removeProperty('height');
		target.style.removeProperty('overflow');
		target.style.removeProperty('transition-duration');
		target.style.removeProperty('transition-property');
		target.classList.remove('_slide');
	}, duration);
}
let _slideToggle = (target, duration = 500) => {
	if (!target.classList.contains('_slide')) {
		target.classList.add('_slide');
		if (window.getComputedStyle(target).display === 'none') {
			return _slideDown(target, duration);
		} else {
			return _slideUp(target, duration);
		}
	}
}

// Spollers-----------------------------------------------------------------------------------------------------------//
let spollers = document.querySelectorAll("._spoller");

//debugger;

let spollersGo = true;
if (spollers.length > 0) {

	function spollerCLick(e) {
		const spoller = e.target;
		if (spollersGo) {
			spollersGo = false;

			if (spoller.closest('._spollers').classList.contains('_one')) {
				let curent_spollers = spoller.closest('._spollers').querySelectorAll('._spoller');
				for (let i = 0; i < curent_spollers.length; i++) {
					let el = curent_spollers[i];
					if (el != spoller) {
						el.classList.remove('_active');
						_slideUp(el.nextElementSibling);
					}
				}
			}
			spoller.classList.toggle('_active');
			_slideToggle(spoller.nextElementSibling);

			setTimeout(function () {
				spollersGo = true;
			}, 500);
		}
	}
	function spollersInit() {
		for (let index = 0; index < spollers.length; index++) {
			const spoller = spollers[index];
			let spollerMax = spoller.getAttribute('data-max');

			if (spollerMax && window.innerWidth > spollerMax) {
				if (spoller.classList.contains('_init')) {
					spoller.classList.remove('_active');
					spoller.classList.remove('_init');
					spoller.nextElementSibling.style.cssText = '';
					spoller.removeEventListener("click", spollerCLick);
				}
			} else if (!spoller.classList.contains('_init')) {
				spoller.classList.add('_init');
				spoller.addEventListener("click", spollerCLick);
			}
		}
	}
	function spollersShowActive() {
		for (let index = 0; index < spollers.length; index++) {
			const spoller = spollers[index];
			if (spoller.classList.contains('_active')) {
				_slideToggle(spoller.nextElementSibling);
			}
		}
	}
	window.addEventListener("resize", spollersInit);

	setTimeout(function () {
		spollersShowActive();
		spollersInit();
	}, 0);
}

document.addEventListener('DOMContentLoaded', () => {

	addToCart()

	changeQty()

})

//=========================================== кнопка: в корзину (Выпуск №139) =======================================//

function addToCart() {

	document.querySelectorAll('[data-addToCart]').forEach(item => {

		item.addEventListener('click', e => {

			e.preventDefault()

			// получим идентификатор товара

			let cart = {}

			cart.id = +item.getAttribute('data-addToCart')

			if (cart.id && !isNaN(cart.id)) {

				let productContainer = item.closest('[data-productContainer]') || document

				cart.qty = null

				let qtyBlock = productContainer.querySelector('[data-quantity]')

				if (qtyBlock) {

					cart.qty = +qtyBlock.innerHTML || 1
				}

				cart.ajax = 'add_to_cart'

				$.ajax({

					url: '/',
					data: cart,
					error: res => {

						console.error(res)
					},

					success: res => {

						//console.log(res)

						// Выпуск №141
						try {

							res = JSON.parse(res)

							if (typeof res.current === 'undefined') {

								throw new Error('')
							}

							item.setAttribute('data-toCartAdded', true);

							['data-totalQty', 'data-totalSum', 'data-totalOldSum'].forEach(attr => {

								let cartAttr = attr.replace(/data-/, '').replace(/([^A-Z])([A-Z])/g, '$1_$2').toLowerCase()

								//console.log(cartAttr)

								document.querySelectorAll(`[${attr}]`).forEach(el => {

									if (typeof res[cartAttr] !== 'undefined') {

										// Выпуск №144
										el.innerHTML = res[cartAttr] + (attr === 'data-totalQty' ? '' : ' руб.');

										//debugger

									}

								})
							})

						} catch (e) {

							alert('Ошибка добавления в корзину')
						}
					}
				})
			}

		})

	})
}

//============================= кнопки: + и - в карточке товара (Выпуск №139) =================================//

function changeQty() {

	let qtyButtons = document.querySelectorAll('[data-quantityPlus], [data-quantityMinus]')

	qtyButtons.forEach(item => {

		item.addEventListener('click', e => {

			e.preventDefault()

			let productContainer = item.closest('[data-productContainer]') || document

			//let inCart = false;

			let qtyEl = productContainer.querySelector('[data-quantity]')

			if (qtyEl) {

				let qty = +qtyEl.innerHTML || 1

				//console.log(qty)

				//debugger

				if (item.hasAttribute('data-quantityPlus')) {

					qty++
				} else {

					qty = qty <= 1 ? 1 : --qty
				}

				qtyEl.innerHTML = qty

				let addToCart = productContainer.querySelector('[data-addToCart]')

				if (addToCart) {

					if (addToCart && addToCart.hasAttribute('data-toCartAdded')) {

						addToCart.dispatchEvent(new Event('click'))
					}
				}
			}
		})
	})
}