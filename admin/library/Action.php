<?php
/**
 * Created by PhpStorm.
 * User: s7eel
 * Date: 29.10.2016
 * Time: 10:30
 * Главный класс по действиям пользователя
 */
class Action{

	protected $template_name;
	protected $catStorage;

	/**
	 * Action constructor.
	 * @param $template
	 * @param $db
	 * Функция конструктора, принимающая тимплейт и как свойство - экземпляр
	 * класса MainStorage, являющийся соединением с базой данных и несущий
	 * основные функции
	 */
	public function __construct($template, $db){
	    $this->template_name = $template;
		$this->catStorage = new MainStorage($db);
	}

	/**
	 * Функция перенаправки на индексную страницу
	 */
	public function redirect(){
		header('Location:'.$_SERVER['PHP_SELF']);
	}

	/**
	 * Основная страница вывода каталогов с заглавными фотографиями и всеми данными, плюс
	 * поля формы для обработки данных в зависимости от пользователя
	 */
	public function showcatalogs(){
		$title = 'Show all catalogs';
		$layout_name = 'layouts/showcatalog.php';
		$catalogs = $this->catStorage->getcatalogs();
		include_once $this->template_name;
	}

	/**
	 * Изменение титлов каталогов, получение айди каталога для изменения по форме,
	 * Получение из базы данных - данных о каталоге и выведение их в новом тимплейте
	 * для дальнейшей обработки с помощью savetitle();
	 */
	public function changetitle(){
		$id = filter_input(INPUT_POST, 'id');
		if($id) {
			$title = 'Change titles of catalogs';
			$layout_name = 'layouts/changetitle.php';
			$catalogs = $this->catStorage->getcatalogByid($id);
			include_once $this->template_name;
		}else{
			die('NOT ENOUGH DATA FOR PROCESS');
		}
	}

	/**
	 * Получение титлов из формы changetitle(); и занесение новых данных в БД
	 */
	public function savetitle(){
		$id = filter_input(INPUT_POST, 'id');
		$title1 = filter_input(INPUT_POST, 'title1');
		$title2 = filter_input(INPUT_POST, 'title2');
		if(!empty($id)&&!empty($title1)&&!empty($title2)){
			$this->catStorage->savetitle($id, $title1, $title2);
			$this->redirect();
		}else{
			die('NOT ALL DATA');
		}
	}
	/**
	 * Получение исходной высоты главного фото каталога, id каталога, и изменение
	 * данного показателя в зависимости  от пользователя
	 */
	public function changeheight(){
		$id = filter_input(INPUT_POST, 'id');
		$height = filter_input(INPUT_POST, 'height');
		if($height){
			if($height=='1'){
				$height='2';
			}else{
				$height='1';
			}
		}
		if(!empty($id)){
			$this->catStorage->changeHeightFoto($id, $height);
			$this->redirect();
		}else{
			die('something has happened :-(');
		}
	}
	/**
	 * Изменение местоположения каталога относительно каталогов
	 * Получение каталога по айди, выведение новой страницы с данным каталогом
	 */
	public function changecategory(){
		$title = 'change category of catalog';
		$id = filter_input(INPUT_POST, 'id');
		$layout_name = 'layouts/changecategory.php';
		$catalogs = $this->catStorage->getcatalogByid($id);
		if($catalogs){
			include_once $this->template_name;
		}else{
			die('something has happened :-( during last page');
		}
	}

	/**
	 * Принимает в массив все инпуты из формы, передающие наименование каталога,
	 * обрезаем пробелы с начала и конца строки и зашиваем в БД
	 */
	public function savecatalog(){
		$id = filter_input(INPUT_POST, 'id');
		$class = array(
			filter_input(INPUT_POST, 'interio_work'),
			filter_input(INPUT_POST, 'interio_life'),
			filter_input(INPUT_POST, 'furniture'),
			filter_input(INPUT_POST, 'landscape'),
		);
		$class = trim(implode(' ', $class));
		if($this->catStorage->savecatalog($id, $class)){
			$this->redirect();
		}else{
			die('something has happened :-( during last page');
		}
	}
	/**
	 * Добавление каталога
	 */
public function addcatalog(){
	$title1 = filter_input(INPUT_POST, 'title1');
	$title2 = filter_input(INPUT_POST, 'title2');
	$height = filter_input(INPUT_POST, 'height');
	$class = array(
		filter_input(INPUT_POST, 'interio_work'),
		filter_input(INPUT_POST, 'interio_life'),
		filter_input(INPUT_POST, 'furniture'),
		filter_input(INPUT_POST, 'landscape'),
	);
	$class = trim(implode(' ', $class));
	if(empty($title1)||empty($title2)||empty($height)||empty($class)){
		die('NOT ALL DATA');
	}else{
		$this->catStorage->addcatalogdata($title1, $title2, $height, $class);
		$this->redirect();
	}
}

















}