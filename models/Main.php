<?php

namespace models;

class Main extends Model
{
	
	/**
	* Получение всех опубликованных тем, вопросов и ответов
	* @return array
	*/
	public function findAll()
	{
		$cat = $this->findAllСategories();
		$sth = $this->db->prepare("SELECT cat.category_id, 
							cat.title AS cat_title, 
							req.id,
							req.text AS req_text,
							res.text AS res_text
	FROM category AS cat JOIN request AS req ON req.cat_id = cat.category_id JOIN response AS res ON res.request_id = req.id WHERE req.is_published='1' ORDER BY cat.category_id");
		
		if ($sth->execute()) {
			$data =  $sth->fetchAll();
			$all = [];
			foreach($cat as $key => $item){
				$key = $item['title'];
			foreach($data as $value){
				if($key== $value['cat_title'])
				 $all[$key][] = $value;
			}
			
          }
			return $all;
		}
		return false;
	}
	
	/**
	*	создание вопроса посетителем сайта
	*/
	function add($params)
	{
		$stmt = $this->db ->prepare("INSERT INTO request (text, cat_id) 
		VALUES (:text, :cat_id);INSERT INTO author (name, email, request_id) VALUES (:name, :email, LAST_INSERT_ID())");
		$stmt->bindParam('text', trim($params['text']), \PDO::PARAM_STR);
		$stmt->bindParam('cat_id', $params['category'], \PDO::PARAM_STR);
		$stmt->bindParam('name', trim($params['name']), \PDO::PARAM_STR);
		$stmt->bindParam('email', trim($params['email']), \PDO::PARAM_STR);
		
		
		return $stmt->execute();
		
	}
	
	

	
}

