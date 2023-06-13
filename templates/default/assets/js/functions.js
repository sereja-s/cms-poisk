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

//================================== поиск по каталогу ================================================================//
/* menuSearch();

function menuSearch() {

	//debugger

	// Для кнопки поиска в админке (с id = "searchButton") - div внутри которого расположен другой div с изображением поиска):
	let searchBtn = document.querySelector('#popup-search');


	let searchInput = searchBtn.querySelector('input[type=search]');


	searchBtn.addEventListener('click', () => {

		// что бы блок поиска появился, добавим класс: vg-search-reverse при клике
		searchBtn.classList.add('vg-search-reverse');

		// поставим курсор на поле ввода (фокус)
		searchInput.focus();
	});

	// организуем закрытие поиска при потере фокуса (щелчке на другом месте, переключении вкладок): вешаем событие: blur
	searchInput.addEventListener('blur', e => {

		// организуем в поиске переход по подсказке (ссылке) при нажатии на неё (Выпуск №113)
		if (e.relatedTarget && e.relatedTarget.tagName === 'A') {

			return
		}

		// удалим класс: vg-search-reverse (поле поиска закроется)
		searchBtn.classList.remove('vg-search-reverse');
	});

} */


// в переменную сохраним самовызывающуюся функцию, внутри которой будет реализовано замыкание (для работы с
// появляющимися подсказками при вводе строки в поле поиска) Вызывается сразу после кода
// (эта функция будет возвращать другую функцию, которую мы и будем вызывать по обращению к имени: searchResultHover)
let searchResultHover = (() => {

	// Инициализируем ряд переменных Эти переменные инициализируются один раз (при первом обращении к ф-ии в переменной:
	// searchResultHover) и затем будут замкнуты в участке кода до: return () => {} и фактически выполнятся только один раз 
	// Каждый раз, когда мы будем повторно вызывать: searchResultHover(), будет вызывться функция которая вернулась т.е.
	// return() => { }, а переменные описанные выше неё останутся нетронутыми(т.е.замкнутыми) и будет выполняться (исходя 
	// из нового вызова) участок кода описанный внутри: return () => { }:

	// найдём и сохраним элемент с классом внутри которого будет выпадающее меню с ссылками-подсказками для поиска
	let searchRes = document.querySelector('.search_res')

	// аналогично найдём input с name="search"), содержащийся в блоке
	// поиска (с id="popup-search")
	let searchInput = document.querySelector('#popup-search input[name=search]')

	// объявим переменную- дефолтное значение для Input поиска
	let defaultInputValue = null

	/**
	 * Метод, который будет обрабатывать нажатие стрелочек (вниз-вверх) в подсказках при поиске (Выпуск №100)
	 * (на вход: e- объект события)
	 */
	function searchKeyDown(e) {

		// если элемент с id = popup-search не содержит класса: vg-search-reverse (т.е. не активен) или не нажата кнопка:
		// стрелка-вверх и не нажата кнопка: стрелка-вниз (в объекте: е- событие, есть свойство: key, которое и показывает какую кнопку нажали)
		if (!(document.querySelector('#popup-search').classList.contains('vg-search-reverse')) ||
			(e.key !== 'ArrowUp' && e.key !== 'ArrowDown')) {

			// завершаем работу скрипта
			return;
		}

		// сделаем деструктивное присваивание (приведём к массиву) для содержимого в searchRes.children
		let children = [...searchRes.children];

		if (children.length) {

			// скинем действия по умолчанию (чтобы курсор не перескакивал на начало слова в строке поиска, при нажатии на кнопки: вверх (вниз))
			e.preventDefault();

			// получим активный элемент (выделенная ссылка в выпадающем меню подсказок при поиске)
			// если querySelector() ничего не найдёт, то по умолчанию вернёт: null 
			let activeItem = searchRes.querySelector('.search_act')

			// сформируем переменную по условию и получим индекс элемента, который лежит в activeItem, иначе: -1
			let activeIndex = activeItem ? children.indexOf(activeItem) : -1

			// если нажата кнопка: стрелка-вниз
			if (e.key === 'ArrowUp') {

				// сформируем переменную по условию
				// здесь (children.length - 1) означает последний элемент массива
				activeIndex = activeIndex <= 0 ? children.length - 1 : --activeIndex

				// если не нажата
			} else {

				// сформируем переменную по другому условию
				activeIndex = activeIndex === children.length - 1 ? 0 : ++activeIndex
			}

			// у всех элементов: children необходимо убрать класс: search_act (если он есть)
			children.forEach(item => item.classList.remove('search_act'))

			// обратимся к массиву в переменной: children (его ячейке: [activeIndex])  и добавим класс: search_act
			children[activeIndex].classList.add('search_act')

			// +Выпуск №113
			// в элемент: searchInput (в его значение: value) занесём значение: innerText из children[activeIndex]
			searchInput.value = children[activeIndex].innerText.replace(/\s*\(.+?\)\s*$/, '');
		}
	}

	/**
	 * Метод установки значения по умолчанию: для input в переменной: searchInput (в строке поиска)
	 */
	function setDefaultValue() {

		// в переменную: searchInput (в его переменную: value) положим значение переменной: defaultInputValue
		searchInput.value = defaultInputValue
	}

	// Опишем 2-а слушателя событий:
	// (На вход: 1- событие, 2- функция, должна быть вызвана только тогда, когда на элементе сработает обработчик событий 
	// (для этого передаём её в качестве параметра без круглых скобок))
	// Иначе (с круглыми скобками) ф-я была бы вызвана до обработчика событий

	// Событие: mouseleave срабатывает, когда курсор манипулятора (обычно мыши) перемещается за границы элемента
	searchRes.addEventListener('mouseleave', setDefaultValue)

	// Событие: keydown срабатывает, когда клавиша была нажата
	window.addEventListener('keydown', searchKeyDown)

	// вернется самовызывающая функция (будет вызываться в качестве результата при каждом обращении к 
	// переменной: searchResultHover (к ф-и в ней))
	return () => {

		//setTimeout(() => {

		// в переменую положим значение searchInput (его поля)
		defaultInputValue = searchInput.value;


		// если подсказки(ссылки) существуют в переменной: searchRes (его св-ве: children, его св-ве: length)
		if (searchRes.children.length) {

			//  свойство children объекта возвращает живую коллекцию (HTMLCollection), которая постонно отслеживается
			// (т.к. ссылки здесь будут постоянно меняться) и которая содержит все дочерние элементы узла, на котором оно было вызвано

			// используем деструктивное присваивание (преобразуем значение из searchRes.children в массив указав слева три 
			// точки) и сохраним в переменной: children
			// (Деструктивное присваивание - упрощает извлечение данных из массивов и объектов, при помощи более короткого синтаксиса)
			let children = [...searchRes.children]

			children.forEach(item => {

				// на текущий элемент: item, вешаем обработчик события на событие: mouseover (наведение указателя мыши)
				item.addEventListener('mouseover', () => {

					// уберём у children класс который подсвечивает подсказки (ссылки)
					children.forEach(el => el.classList.remove('search_act'))

					// для текущего элемента: item добавим класс
					item.classList.add('search_act')

					// то что лежит в св-ве innerText (для элемента: item) положим в элемент: searchInput, в его св-во: value
					// (т.е. в поле поиска попадёт название той ссылки, на которую попадёт указатель мыши)
					searchInput.value = item.innerText
				})
			})
		}

		//}, 5000);

	}

})()
// самовызывающуюся функцию необходимо вызывать сразу после того как её код описан
searchResultHover()

/**
 * Метод работы поиска в админке (вывод подсказок(ссылок)) Выпуск №105
 */
function search() {

	let searchInput = document.querySelector('input[name=search]');

	//console.log(searchInput);

	if (searchInput) {

		// (событие oninput происходит сразу после изменения значения элемента)
		//searchInput.oninput = () => {

		// search - событие возникает после того как пользователь нажимает на клавишу Enter или нажимает кнопку "x" (отмена) в элементе input с type="search"
		searchInput.addEventListener('search', () => {

			// сделаем ограничение (подсказки(ссылки) появятся при вводе более одного символа в поисковой строке)
			if (searchInput.value.length > 1) {

				$.ajax({
					url: '/',
					// в Ajax нам нужен объект: data
					data: {
						// в котором будет три поля (свойства)
						data: searchInput.value, // в поле: data отправляем: searchInput.value
						table: document.querySelector('input[name="search_table"]').value, // ищем с приоритетом по товарам(получим соответствующее поле)
						ajax: 'search' // управляющий флаг (для Ajax-контроллера)
					},
					success: res => {

						//console.log(res);

						try {

							res = JSON.parse(res);

							let resBlok = document.querySelector('.search_res');

							let counter = res.length > 20 ? 20 : res.length;

							if (resBlok) {

								resBlok.innerHTML = '';

								for (let i = 0; i < counter; i++) {

									// на вход: 1- параметр: вставляем в конец, 2-ой: что вставляем
									resBlok.insertAdjacentHTML('beforeend', `<a href="${res[i]['alias']}" class="search-popup__category-link">${res[i]['name']}</a><br>`);
								}
								// снова вызовем метод (т.к. там будут все неоходимые элементы)
								searchResultHover();
							}

						} catch (e) {

							alert('Ничего не найдено по вашему запросу')
						}
					}
				})


			} else {
				alert("введите больше одного символа")
			}

		});

		//}
	}
}

search();