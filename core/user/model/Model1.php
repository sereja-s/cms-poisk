<?php

namespace core\user\model;

use core\base\controller\Singleton;

/** 
 * Пользовательская модель (Выпуск №120)
 * Методы: public function getGoods(); public function applyDiscount();
 */
class Model extends \core\base\model\BaseModel
{

	use Singleton;

	/** 
	 * Метод модели для получения каталога товаров (Выпуск №125)
	 * 1-ый параметр (настройки): $set = [] (принимает), 
	 * 2-ой (фильтры каталога) и 3-ий (цены каталога): &$catalogFilters = null и &$catalogPrices = null (возвращает по ссылке)
	 */
	public function getGoods($set = [], &$catalogFilters = null, &$catalogPrices = null)
	{
		// получим товары с id (для этого используется метод: protected function joinStructure() из BaseModelMethods, 
		// который запускается если есть ячейка: ['join_structure'] при этом вернётся массив вида: id товара => данные 
		// товара) Поэтому делаем следующую проверку:
		if (empty($set['join_structure'])) {

			$set['join_structure'] = true;
		}

		// в $set['where'] должен быть массив
		if (empty($set['where'])) {

			$set['where'] = [];
		}

		// соберём сортировку по умолчанию
		if (empty($set['order'])) {

			$set['order'] = [];

			// если не пусто в таблице: goods в ячейке: parent_id
			if (!empty($this->showColumns('goods')['parent_id'])) {

				// то в начале будем сортировать по ней
				$set['order'][] = 'parent_id';
			}

			// аналогично делаем для ячейки: price
			if (!empty($this->showColumns('goods')['price'])) {

				$set['order'][] = 'price';
			}
		}

		// получим товары получить при этом подаём уже обработанный $set
		$goods = $this->get('goods', $set);

		//$a = 1;

		// все дальнейшие действия выполняем если пришли товары
		if ($goods) {

			if (!empty($this->showColumns('goods')['discount'])) {

				foreach ($goods as $key => $item) {

					$this->applyDiscount($goods[$key], $item['discount']);
				}
			}

			unset($set['join'], $set['join_structure'], $set['pagination']);


			// Получим цены:

			if ($catalogPrices !== false && !empty($this->showColumns('goods')['price'])) {

				// MIN() и MAX()- функции SQL
				$set['fields'] = ['MIN(price) as min_price', 'MAX(price) as max_price'];

				// получим в переменную: массив с min_price(мин.цена) и max_price(макс.цена) товара из таблицы БД: goods
				$catalogPrices = $this->get('goods', $set);

				//$a = 1;

				if (!empty($catalogPrices[0])) {

					$catalogPrices = $catalogPrices[0];
				}
			}


			// Получим фильтры:

			if ($catalogFilters !== false && in_array('filters', $this->showTables())) {

				$parentFiltersFields = [];

				$filtersWhere = [];

				$filtersOrder = [];

				foreach ($this->showColumns('filters') as $name => $item) {

					if (!empty($item) && is_array($item)) {

						$parentFiltersFields[] = $name . ' as f_' . $name; // что бы отличать родителя от значения
					}
				}


				if (!empty($this->showColumns('filters')['visible'])) {

					$filtersWhere['visible'] = 1;
				}

				if (!empty($this->showColumns('filters')['menu_position'])) {

					$filtersOrder[] = 'menu_position';
				}


				// получаем фильтры
				$filters = $this->get('filters', [
					'where' => $filtersWhere,
					'join' => [
						// соединяем таблицу с самой собой
						'filters f_name' => [
							'type' => 'INNER',  // т.к. нам не нужно чтобы приходило значение если нет родителя
							'fields' => $parentFiltersFields,
							'where' => $filtersWhere,
							// укажем признак (из предыдущей таблицы- поле: parent_id смотрит на текущую- поле: id)
							'on' => ['parent_id', 'id']
						],
						// нам нужен джоин (связь) с таблицей связей
						'goods_filters' => [
							// применим расширенный режим (с указанием ключа: 'on') т.к. смотрим не на предыдущую таблицу (здесь- filters f_name), а на другую
							'on' => [
								'table' => 'filters',
								// поле из предыдущей таблицы (id) должно смотреть на поле текущей (filters_id)
								'fields' => ['id', 'filters_id']
							],
							'where' => [
								// строим подзапрос (вложенный запрос), так блок с фильтрами нужно получить для всех товаров в разделе
								'goods_id' => $this->get('goods', [
									'fields' => [$this->showColumns('goods')['id_row']],
									'where' => $set['where'] ?? null,
									// Выпуск №132
									'operand' => $set['operand'] ?? null,
									'return_query' => true
								])
							],

							'operand' => ['IN'],
						]
					],

					// 'return_query' => true
				]);

				//$a = 1;

				// Этот код перенесли выше (-Выпуск №141)
				/* if (!empty($this->showColumns('goods')['discount'])) {
					foreach ($goods as $key => $item) {
						$this->applyDiscount($goods[$key], $item['discount']);
					}
				} */

				// Сделаем подсчёт количества товаров в конкретном фильтре (относительно категории в которой находимся) отдельным запросом:

				if ($filters) {

					// implode() — объединение элементов массива со строкой
					// (Возвращает строку, содержащую строковое представление всех элементов массива в одном порядке со 
					// строкой-разделителем (здесь- запятая) между каждым элементом)
					// array_column() — возвращает значения из одного столбца во входном массиве

					// Получим все уникальные id для фильтров и товаров из массива в переменной: $filters

					$filtersIds = implode(',', array_unique(array_column($filters, 'id')));

					$goodsIds = implode(',', array_unique(array_column($filters, 'goods_id')));

					$query = "SELECT `filters_id` as id, COUNT(goods_id) as count FROM goods_filters WHERE filters_id IN ($filtersIds) AND goods_id IN ($goodsIds) GROUP BY filters_id";

					// количество товаров в конкретных фильтрах (относительно категории в которой находимся) отдельным запросом (придёт: id для каждого фильтра и кол-во товаров, для которых он применён):
					$goodsCountDb = $this->query($query);

					// $a = 1;

					$goodsCount = [];

					if ($goodsCountDb) {

						foreach ($goodsCountDb as $item) {

							// в ячейку с ключём: id (для каждого фильтра) положим значение (массив): его id и кол-во товаров, для которых он применён
							$goodsCount[$item['id']] = $item;
						}
					}

					// формируем фильтр каталога
					$catalogFilters = [];

					foreach ($filters as $item) {

						$parent = [];

						$child = [];

						foreach ($item as $row => $rowValue) {

							// определим родительскую категорию (в массиве: её данные с префиксом: f_): фильтр
							if (strpos($row, 'f_') === 0) {

								$name = preg_replace('/^f_/', '', $row);

								// в ячейку с именем родителя положим его значение
								$parent[$name] = $rowValue;

								// иначе это данные дочерней категории: значения фильтра
							} else {

								// в ячейку с именем дочерней категории положим соответственно её значение
								$child[$row] = $rowValue;
							}
						}


						if (isset($goodsCount[$child['id']]['count'])) {

							$child['count'] = $goodsCount[$child['id']]['count'];
						}

						if (empty($catalogFilters[$parent['id']])) {

							$catalogFilters[$parent['id']] = $parent;

							// создадим элемент для сбора значений фильтров
							$catalogFilters[$parent['id']]['values'] = [];
						}

						// сформируем фильтры
						$catalogFilters[$parent['id']]['values'][$child['id']] = $child;

						if (isset($goods[$item['goods_id']])) {

							if (empty($goods[$item['goods_id']]['filters'][$parent['id']])) {

								$goods[$item['goods_id']]['filters'][$parent['id']] = $parent;
								$goods[$item['goods_id']]['filters'][$parent['id']]['values'] = [];
							}

							$goods[$item['goods_id']]['filters'][$parent['id']]['values'][$item['id']] = $child;
						}
					}
				}
			}
		}

		return $goods ?? null;
	}

	/** 
	 * Метод применения скидок (Выпуск №126)
	 */
	public function applyDiscount(&$data, $discount)
	{
		// Выпуск №150 | Пользовательская часть | сохранение товаров заказа
		if (!empty($this->showColumns('goods')['discount'])) {

			$data['old_price'] = null;
		}

		if ($discount) {

			$data['old_price'] = $data['price'];

			$data['discount'] = $discount;

			$data['price'] = $data['old_price'] - ($data['old_price'] / 100 * $discount);
		}
	}


	/** 
	 * Метод работы с поиском по каталогу товаров
	 * (на вход: 1- получили то что введено в поисковую строку, 2- получили то где ищем (приоритет поиска), 
	 * 3-ий параметр- кол-во показываемых подсказок (ссылок)) 
	 */
	public function search($data, $table = false, $qty = false)
	{
		// экранируем слешами (для корректного поиска)
		$data = addslashes($data);

		// разбираем поисковую строку и строим поисковый массив (систему уточнений)
		// (т.е. сначала ищем всю строку (длину), потом ищем уменьшенную на один элемент и т.д)

		$arr = preg_split('/(,|\.)?\s+/', $data, 0, PREG_SPLIT_NO_EMPTY);

		// Сформируем поисковый массив
		$searchArr = [];

		$order = [];

		//  запустим цикл без условий
		for (;;) {

			if (!$arr) {

				// выходим из цикла когда массив с поисковой фразой очистится
				break;
			}

			// implode()- Возвращает строку, содержащую строковое представление всех элементов массива в одном порядке со 
			// строкой-разделителем (необязательный параметр. По умолчанию используется пустая строка) между каждым элементом
			$searchArr[] = implode(' ', $arr);

			// удаляем последний элемент
			unset($arr[count($arr) - 1]);
		}

		//-------------------------------------------------------------------------------------------------------------//

		// массив полей(в полях конкретной таблицы) в которых будем искать
		$searchRows = [];

		// массив по которому будем сортировать (кол-во полей для сортировки можно менять)
		$orderRows = ['name'];

		// массив полей по которорым будем искать
		$fields = [];

		// поля, которые есть в БД
		$columns = $this->showColumns($table);

		// поля, которые понадобятся для поиска (поле с первичным ключом)
		$fields[] = $columns['id_row'] . ' as id';



		// +Выпуск №113
		// сформируем переменую с названием поля для выпадающего меню с результатом поиска:
		// если существует ячейка: $columns['name'], то будем исползовать конструкцию: CASE и через WHEN и THEN 
		// заполнять поле: name из таблицы по указанным условиям (здесь если имя не равно пустой строке, то в 
		// переменную: $fieldName сохраним строку с именем (и названием таблицы впереди) иначе - пустую строку )
		$fieldName = isset($columns['name']) ? "CASE WHEN {$table}.name <> '' THEN {$table}.name " : '';



		foreach ($columns as $col => $value) {

			if ($col !== 'name' && stripos($col, 'name') !== false) {

				if (!$fieldName) {

					$fieldName = 'CASE ';
				}

				// +Выпуск №113
				$fieldName .= "WHEN {$table}.$col <> '' THEN {$table}.$col ";
			}

			// формируем поля в которых будем искать (здесь- по текстовому признаку (по вхождению в поле слов: char или text))
			if (
				isset($value['Type']) &&
				(stripos($value['Type'], 'char') !== false ||
					stripos($value['Type'], 'text') !== false)
			) {

				$searchRows[] = $col;
			}
		}



		if ($fieldName) {

			// сохраним в массиве, то что пришло в переменную и закроем конструкцию: CASE (описана выше) конструкцией: END и далее укажем: как псевдоним имени
			$fields[] = $fieldName . 'END as name';

			// иначе (если в $fieldName ничего не пришло)
		} else {

			// сохраним в массиве идентификатор как псевдоним имени
			$fields[] = $columns['id_row'] . ' as name';
		}

		// чтобы понимать из какой таблицы получены данные (исходя из этого значения будем фоормировать алиас)
		// добавим в массив ещё поле (с названием таблицы)
		$fields[] = "('$table') AS table_name";


		// здесь- формируем массивы: where и order для использования их в buildUnion (меетоде-строителе Union-запросов )
		$res = $this->createWhereOrder($searchRows, $searchArr, $orderRows, $table);


		$where = $res['where'];

		// если $order ещё не заполнялось
		!$order && $order = $res['order'];

		//-------------------------------------------------------------------------------------------------------------//

		if ($where) {

			if ($table === 'goods') {

				$this->buildUnion($table, [
					'fields' => $fields,
					'where' => $where,
					'join' => [
						'catalog' => [
							//'fields' => ['name as category_name'],
							'on' => ['parent_id', 'id']
						]
					]
				]);
			} else {

				// обратимся к методу модели для формирования UNION запросов к базе данных (Выпуск №111)
				$this->buildUnion($table, [
					'fields' => $fields,
					'where' => $where,
					'no_concat' => true
				]);
			}
		}

		// $this->test();


		$orderDirection = null;


		if ($order) {

			$orderDirection = 'DESC';
		}

		//==============================================================================================================//

		// Выпуск №112- ORM builder UNION запросов ч.2
		$result = $this->getUnion([
			//'type' => 'all',
			//'pagination' => [],
			//'limit' => 3,
			'order' => $order,
			'order_direction' => $orderDirection
		]);

		$a = 1;
	}

	/** 
	 * Метод для формирования инструкций WHERE и ORDER для системы поиска (Выпуск №109)	 
	 * (на вход: 1- массив полей в которых будем искать, 2- массив того, что мы ищем, 3- массив по которому сортируем, 
	 * 4 -переменная (таблица)) 
	 */
	protected function createWhereOrder($searchRows, $searchArr, $orderRows, $table)
	{
		$where = '';
		$order = [];

		if ($searchRows && $searchArr) {

			$columns = $this->showColumns($table);

			if ($columns) {

				// определи первую скобку в инструкции: where
				$where = '(';

				foreach ($searchRows as $row) {

					// на каждой итерации добавляем ещё одну скобку (будут группы запросов)
					$where .= '(';

					foreach ($searchArr as $item) {

						if (in_array($row, $orderRows)) {

							// символ: %- означает искать и до и после
							$str = "($row LIKE '%$item%')";

							if (!in_array($str, $order)) {

								$order[] = $str;
							}
						}


						// +Выпуск №113
						if (isset($columns[$row])) {

							$where .= "{$table}.$row LIKE '%$item%' OR ";
						}
					}


					// preg_replace() — поиск и замена регулярных выражений
					// на вход: 1- шаблон (регулярное выражение) для поиска, 2- строка (или массив со строками) для замены
					// 3- строка или массив со строками для поиска и замены (где ищем)
					$where = preg_replace('/\)?\s*or\s*\(?$/i', '', $where) . ') OR ';
				}

				// обработаем переменную ещё раз (обрежем лишний OR с пробелом в конце и добавим закрыващую скобку в конце запроса)
				$where && $where = preg_replace('/\s*or\s*$/i', '', $where) . ')';
			}
		}

		return compact('where', 'order');
	}
}
