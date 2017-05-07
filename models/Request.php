<?php
namespace models;

class Request extends Model
{


	/**
	*	добавить вопрос в тему
	*/
    public function addRequest($text, $cat_id, $nameInSession)
	{
	
    $stmt = $this->db->prepare("INSERT INTO request (text, cat_id) VALUES (:text, :cat_id);
                                INSERT INTO author (name, request_id) VALUES (:name, LAST_INSERT_ID())");
    $stmt->bindParam('text', $text, \PDO::PARAM_STR);
    $stmt->bindParam('cat_id', $cat_id, \PDO::PARAM_INT );
    $stmt->bindParam('name', $nameInSession, \PDO::PARAM_STR);
    $stmt->execute();
    }

	/**
	*	показ одной темы с принадлежащими ей вопросами
	*/
    public function showOneCat($id)
	{
	
	$stmt = $this->db->prepare("SELECT cat.category_id, 
	cat.title, req.id, req.text, req.is_published, 
	res.request_id AS has_response,
	a.name,	
	req.dated
    FROM request req 
	LEFT JOIN response res ON res.request_id = req.id  
	JOIN author a ON a.request_id = req.id  
	RIGHT JOIN category cat ON cat.category_id = req.cat_id 
	WHERE cat.category_id ={$id}");
	$stmt->execute();
	return $stmt->fetchAll();

    }


	/**
	*  выборка вопроса к редактированию
	*/
    public function showOneRequest($category_id, $id)
	{
	
	$stmt = $this->db->prepare("SELECT 
	cat.category_id,
	cat.title,
	req.id,
	req.text, 
	req.cat_id,
	req.is_published, 	  
	req.dated, 
	a.name,
	res.id AS res_id,
	res.text AS res_text
    FROM category cat LEFT JOIN request req ON cat.category_id = req.cat_id JOIN author a ON a.request_id= req.id 
	LEFT JOIN response res ON res.request_id=req.id WHERE cat.category_id = :category_id AND req.id= :id");
	$stmt->execute(['category_id'=>$category_id, 'id'=>$id]);
	return $stmt->fetch();
    }
	
	/**
	*	удаление вопроса
	*/
    public function delRequest($id)
	{
	
	$stmt = $this->db->prepare("DELETE request, response, author FROM request 
	LEFT JOIN response ON response.request_id= request.id 
	LEFT JOIN author ON author.request_id= request.id WHERE request.id = :id");
	$stmt ->execute(['id'=>$id]);
    }

	/**
	* Если ответ уже был, редактируем вопрос и ответ
	*/

    public function entryUpdate($id, $params)
	{
	
	$stmt = $this->db->prepare("UPDATE request, 
	response JOIN request req ON req.id = response.request_id
	JOIN author a ON a.request_id = req.id
	SET req.text= :req_text, 		
	req.cat_id = :cat_id, 
	req.is_published= :is_published,
	a.name= :name, 
	response.text= :res_text 
	WHERE req.id = :req_id");
	$stmt->bindParam('req_text', $params['text']);
	$stmt->bindParam('cat_id', $params['cat_id'], \PDO::PARAM_INT);
	$stmt->bindParam('is_published', $params['is_published']);
	$stmt->bindParam('name',$params['name']);
	$stmt->bindParam('res_text', $params['response']);
	$stmt->bindParam('req_id', $id, \PDO::PARAM_INT);
	$stmt ->execute();
	
    }

	/**
	*	Если ответа еще не было, редактируем вопрос и вставляем ответ
	*/

    public function entryUpdateInsert($id, $params)
	{
	
	$stmt = $this->db->prepare("UPDATE request, author JOIN request req ON req.id= author.request_id
	SET req.text= :req_text, 		
	req.cat_id = :cat_id, 
	req.is_published= :is_published,
	author.name= :name 
	WHERE req.id = :req_id;
	INSERT INTO response (request_id, text) VALUES (:request_id, :res_text)");
	$stmt->bindParam('req_text', $params['text']);
	$stmt->bindParam('cat_id', $params['cat_id'], \PDO::PARAM_INT);
	$stmt->bindParam('is_published', $params['is_published']);
	$stmt->bindParam('name',$params['name']);
	$stmt->bindParam('req_id', $id, \PDO::PARAM_INT);
	$stmt->bindParam('request_id', $id, \PDO::PARAM_INT);
	$stmt->bindParam('res_text', $params['response']);
	
	$stmt ->execute();
	
    }
	
	/**
	*	показать только новые вопросы
	*/
    public function showNewRequest()
	{
	
	$stmt = $this->db->prepare("SELECT req.id, req.text, req.dated,cat.category_id, cat.title, res.request_id AS has_response
    FROM request req LEFT JOIN response res ON res.request_id=req.id 
	JOIN category cat ON cat.category_id = req.cat_id WHERE res.request_id IS NULL ORDER BY dated");
	$stmt->execute();
	return $stmt->fetchAll();

    }


}


