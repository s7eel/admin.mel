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
		$query = "SELECT main.id, class, link, title1, title2, height FROM main, foto WHERE main.id=foto.link_id AND main_foto_id=\"Y\"";
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




}