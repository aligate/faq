<?php
namespace models;
use lib\DataBase;

class Model{

protected $db = null;

	function __construct()
	{
		
		$this->db = DataBase::getDbConnection();
	}
	
//Получение всех категорий
	public function findAllСategories()
	{
		$sth = $this->db->prepare("SELECT * FROM category ORDER BY category_id");
		if ($sth->execute()) {
			return $sth->fetchAll();
		}
		return false;
	}
	
	public function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['users'])) {
            return $_SESSION['users'];
        }

        header("Location: ?/admin/login");
    }
	
	public function checkResponse($request_id){
	
	$stmt = $this->db->prepare("SELECT count(*) AS has_response FROM request INNER JOIN response ON response.request_id = request.id
	WHERE request.id = {$request_id}");
	$stmt->execute();
	$result =  $stmt->fetch();
	return $result['has_response'];
	
}
	
	
	

}

