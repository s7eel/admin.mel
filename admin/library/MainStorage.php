<?php
/**
 * Created by PhpStorm.
 * User: s7eel
 * Date: 29.10.2016
 * Time: 10:26
 * Главный каталог по доступу к базе данных и основных функций вывода
 */
class MainStorage{

    protected $db;
    
    public function __construct($db){
        $this->db = new mysqli(
        	$db['host'],
	        $db['user'],
	        $db['pass'],
	        $db['name']);
    }

	/**
	 * Получаем выборку всех id, классов, заглавных фото из БД
	 * @return array|bool
	 * возвращаем массив с данными из БД
	 */
	public function getcatalogs(){
		$query = "SELECT main.id, class, link, title1, title2, height FROM main, foto WHERE main.id=foto.link_id AND main_foto_id=\"Y\" ORDER BY foto.id DESC";
		$result = $this->db->query($query);
		if ($result) {
			$catalogs=array();
			while ($new_item = $result->fetch_assoc()) {
				$catalogs[]=$new_item;
			}
			return $catalogs;
		}else{
			return false;
		}
	}

	public function getcatalogByid($id){
		$query = "SELECT main.id, link, class, title1, title2 FROM main,foto WHERE main.id=foto.link_id AND main.id='$id' AND main_foto_id=\"Y\"";
		$result = $this->db->query($query);
		if($result){
			return $result;
		}
		return false;
	}

	public function savetitle($id, $title1, $title2){
		$query = "UPDATE main SET title1='$title1', title2='$title2' WHERE id='$id'";
		if($this->db->query($query)){
			return TRUE;
		}
		return FALSE;
	}

	public function changeHeightFoto($id, $height){
		$query = "UPDATE main SET height='$height' WHERE id='$id'";
		$result = $this->db->query($query);
		if($result){
			return true;
		}
			return false;
	}

	/**
	 * @param $id - айди изменяемого каталога
	 * @param $class - новый класс для сохранения
	 * @return bool - тру в случае успеха или фолс в случае неудачи
	 */
	public function savecatalog($id, $class){
		$query = "UPDATE main SET class='$class' WHERE id='$id'";
		if($this->db->query($query)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	/**
	 * @param $title1 - Добавление нового титл1 в каталог
	 * @param $title2 - Добавление нового титл2 в каталог
	 * @param $height - Добавление высоты нового каталога
	 * @param $class - Добавление нового класса в каталог
	 * @return bool|mixed - возвращает либо айди новоносозданного каталога либо FALSE
	 */
	public function addcatalogdata($title1, $title2, $height, $class){
		$query = "INSERT INTO main (title1, title2, height, class) VALUES ('$title1','$title2', '$height', '$class')";
		if ($this->db->query($query)) {
			$id = $this->db->insert_id;
			return $id;
		} else {
			return FALSE;
		}
	}

	/**
	 * @param $id - айди новосозданного каталога
	 * @param $link - ссылка на дефолтное или любое другое изображение
	 * @return bool
	 * Вносит изменение в таблицу foto присваивая линк заглавного фото
	 */
	public function addmainfoto($id, $link, $main_foto_id){
		$query = "INSERT INTO foto (link, link_id, main_foto_id) VALUES ('$link', '$id', '$main_foto_id')";
		if($this->db->query($query)){
			return TRUE;
		}else{
			return FALSE;
		}

	}

	/**
	 * @param $id - Айди входящего каталога
	 * @return array|bool - Возвращает массив ссылок на фотографии из базы данных или FALSE
	 */
	public function getfotobyID($id){
		$query = "SELECT link FROM main, foto WHERE main.id=foto.link_id AND main.id='$id'";
		if ($result = $this->db->query($query)) {
			$res_array = array();
			while ($item = $result->fetch_assoc() ){
				$res_array[] = $item;
			}
			return $res_array;
		}
			return FALSE;
	}














}