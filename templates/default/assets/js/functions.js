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

	/* ====================================== order-popup при оформлении заказа ====================================== */

	document.querySelectorAll('[data-popup]').forEach(item => {

		if (item.getAttribute('data-popup')) {

			let popupElement = document.querySelector(`.${item.getAttribute('data-popup')}`);

			if (popupElement) {

				// +Выпуск №154 | Пользовательская часть | регистрация пользователя
				item.addEventListener('click', e => {

					e.preventDefault()

					popupElement.classList.add('open')
				});

				popupElement.addEventListener('click', e => {

					if (e.target === popupElement) {

						popupElement.classList.remove('open')
					}

				});

			}
		}
	})

	// Выпуск №154 | Пользовательская часть | регистрация пользователя (переключатель межлу формами регистрации и входа)
	let loginP = document.querySelector('.login-popup p')
	let loginVariants = document.querySelectorAll('.login-popup h3 span')
	let loginFormVariants = document.querySelectorAll('.login-popup form')

	loginVariants.forEach(item => {

		item.addEventListener('click', () => {

			// получим порядковый номер элемента(индекс)
			let index = [...loginVariants].indexOf(item)

			loginVariants[index].style.display = 'block'
			loginVariants[+!index].style.display = 'none'
			loginFormVariants[index].style.display = 'block'
			loginFormVariants[+!index].style.display = 'none'

			loginP.style.display = 'none'
		})

	})

	//========================= Выпуск №148 | Пользовательская часть | показ уведомлений пользователю ====================//
	let messageWrap = document.querySelector('.wq-message__wrap');

	if (messageWrap) {

		// опишем объекты (стили класса: wq-message__wrap для всплывающего окна сообщений)
		let styles = {
			position: 'fixed',
			top: '10%',
			left: '50%',
			transform: 'translateX(-50%)',
			display: 'block',
			zIndex: '9999'
		};

		let successStyles = {
			backgroundColor: '#4c8a3c',
			color: 'white',
			marginBottom: '10px',
			padding: '25px 30px',
			borderRadius: '20px'
		};

		let errorStyles = {
			backgroundColor: '#d34343',
			color: 'white',
			marginBottom: '10px',
			padding: '25px 30px',
			borderRadius: '20px'
		};

		// если в переменую что то прилетело
		if (messageWrap.innerHTML.trim()) {

			// зададим описанные выше стили
			for (let i in styles) {

				messageWrap.style[i] = styles[i];
			}

			// если не пришёл тег div (при этом если дочерних элементов у класса нет, то children.length вернёт ноль)
			if (!messageWrap.children.length) {

				// оборачиваем в div
				messageWrap.innerHTML = `<div>${messageWrap.innerHTML}</div>`
			}

			// в цикле пробежимся по дочерним элементам класса-контейнера для сообщений: messageWrap (по сообщениям, которые пришли)
			for (let i in messageWrap.children) {

				if (messageWrap.children.hasOwnProperty(i)) {

					// определим тип стилей

					// если находим поле: success, обратимся к value, в котором хранится строка с классами, то в переменную 
					// положим то что хранится в successStyles, иначе errorStyles
					let typeStyles = /success/i.test(messageWrap.children[i].classList.value) ? successStyles : errorStyles;

					// применяем соответствующие стили
					for (let j in typeStyles) {

						messageWrap.children[i].style[j] = typeStyles[j];

					}

				}

			}

			// подключим слушатели для двух событий, при которых будет вызываться метод, удаляющий сообщение с экрана
			['click', 'scroll'].forEach(event => document.addEventListener(event, hideMessages));

		}

	}
	/**
	 * функция убирает всплывающие сообщения (Выпуск №149 | Пользовательская часть | сохранение заказа)
	 */
	function hideMessages() {

		let messageWrap = document.querySelector('.wq-message__wrap');


		if (messageWrap) {

			messageWrap.remove()

		}

		// отключим слушатели для двух событий
		['click', 'scroll'].forEach(event => document.removeEventListener(event, hideMessages));
	}

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

							['data-totalQty', 'data-totalSum', 'data-totalOldSum', 'data-totalDiscount'].forEach(attr => {

								let cartAttr = attr.replace(/data-/, '').replace(/([^A-Z])([A-Z])/g, '$1_$2').toLowerCase()

								//console.log(cartAttr)

								document.querySelectorAll(`[${attr}]`).forEach(el => {

									if (typeof res[cartAttr] !== 'undefined') {

										// +Выпуск №144
										el.innerHTML = res[cartAttr] + (attr === 'data-totalQty' ? '' : ' руб.');

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

//------------------------------------ валидатор номера телефона (Выпуск №146) ---------------------------------------//

document.querySelectorAll('input[type="tel"]').forEach(item => phoneValidate(item));

function phoneValidate(item) {

	// создадим объект со свойствами для телефонов в конкретном регионе
	let countriesOptions = {

		// +7(495)111-22-33
		'+7': {

			// укажем лимит символов в строке телефона в форме
			limit: 16,
			// укажем св-во, в котором сохраним первые цифры для которых будет осуществляться подмена(здесь- 8 или 7)
			firstDigits: '87',
			// св-во при помощи которого будет осуществляться форматирование телефона (здесь- это объект, в котором мы 
			// будем хранить порядковые номера символов, после которых будем что то вставлть(заменять и т.д.))
			formatChars: {
				2: '(',
				6: ')',
				10: '-',
				13: '-',
			}
		},

		// например дополнительно добавим форматирование для другой страны: +994(123)456-78-99
		'+994': {

			// укажем лимит символов в строке телефона в форме
			limit: 18,
			// св-во при помощи которого будет осуществляться форматирование телефона (здесь- это объект, в котором мы 
			// будем хранить порядковые номера символов, после которых будем что то вствлть(заменять и т.д.))
			formatChars: {

				4: '(',
				8: ')',
				12: '-',
				15: '-',
			}
		}
	};

	item.addEventListener('input', e => {

		if (e.inputType === 'deleteContentBackward' || e.inputType === 'deleteContentForward') {

			// не мешаем пользователю удалять символы в форме(в строке с телефоном) т.е нажимать кнопки: DEL или Backspace 
			return false
		};

		// чистим от не цифр, всё что пользователь вводит в поле тел.номера формы
		item.value = item.value.replace(/\D/g, '');


		if (item.value) {

			// сформируем корректные ключи (по стране)
			for (let code in countriesOptions) {

				// проверим есть ли в введённом в форму телефоне, цифры которые нужно заменить
				if (countriesOptions.hasOwnProperty(code) && countriesOptions[code].firstDigits) {

					// создадим объект регулярного выражения
					let regExp = new RegExp(`^[${countriesOptions[code].firstDigits}]`);

					// если искомые цифры есть
					if (regExp.test(item.value)) {

						// то заменяем их т.е. value на code (здесь- код страны: +7)
						item.value = item.value.replace(regExp, code);
						break;
					}
				}
			}

			// если символа: + нет, его надо подставить
			if (!/^\+/.test(item.value)) {

				item.value = '+' + item.value;
			}

			// снова запустим цикл:
			// сформируем корректные ключи (по стране)
			for (let code in countriesOptions) {

				if (countriesOptions.hasOwnProperty(code)) {

					let regExp = new RegExp(code.replace(/\+/g, '\\+'), 'g');

					if (regExp.test(item.value)) {

						for (let i in countriesOptions[code].formatChars) {

							// приведём к числу строковые ключи объекта и сохраним в переменной
							let j = +i;

							if (item.value[j] && item.value[j] !== countriesOptions[code].formatChars[i]) {

								item.value = item.value.substring(0, j) + countriesOptions[code].formatChars[i] + item.value.substring(j)
							}
						}

						// ограничим данные лимитом, указанным в соответствующем свойстве объекта: countriesOptions
						if (item.value[countriesOptions[code].limit]) {

							item.value = item.value.substring(0, countriesOptions[code].limit);
						}
					}
				}
			}
		}
	});

	// для корректной работы при перезагрузке страницы
	item.dispatchEvent(new Event('input'));

	// если после ввода телефонного номера пользователь попытается изменить формат записи на неправильный, номер 
	// автоматически будет исправлен на корректный
	item.addEventListener('change', () => phoneValidate(item));

}