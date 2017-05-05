<?php
namespace models;

class Category extends Model{

	/**
	*	список тем
	*/
    public function showCategoriesList()
	{
	
	$stmt = $this->db->prepare("SELECT req.cat_id, 
	cat.category_id, 
	cat.title, 
	count(req.id) AS requests, 
	sum(is_published = '1') AS is_published,
	(count(req.id) - count(req.id = res.request_id)) AS no_response 
	FROM request AS req LEFT JOIN response AS res ON res.request_id = req.id RIGHT JOIN category AS cat 
	ON req.cat_id = cat.category_id GROUP BY category_id");
	$stmt->execute();
	return $stmt->fetchAll();
	
	}

	/**
	*	создание новой темы
	*/
    public function createCategory($title){
	
    $stmt = $this->db->prepare("INSERT INTO category (title) VALUES (:title)");
    $stmt->execute(['title'=>$title]);
    }
	
	/**
	*	удаление темы со всеми вопросами и ответами
	*/
    public function delCatAndRequest($id){
	
	$stmt = $this->db->prepare("DELETE category, request, response, author FROM category 
	LEFT JOIN request ON  request.cat_id=category.category_id 
	LEFT JOIN response ON response.request_id= request.id 
	LEFT JOIN author ON author.request_id= request.id WHERE category_id = :id");
	$stmt->execute(['id'=> $id]);
	
    }



}


