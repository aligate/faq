<?php

namespace models;

class Admin extends Model{
	
	/**
	*	добавление админа
	*/
	public function addNewAdmin($name, $password){
		
	$stmt= $this->db->prepare("INSERT INTO admin (name, password) VALUES (:name, :password)");
	$stmt->execute(['name' =>trim(addslashes($name)), 'password'=>md5($password)]);
	
	}
	
	/**
	*	список админов
	*/
	public function selectAllAdmin(){
		
		$stmt = $this->db->prepare("SELECT * FROM admin");
		$stmt->execute();
		return $stmt->fetchAll();
		
	}
	
	/**
	*	выборка админа к редактированию
	*/
	public function selectOneAdmin($id){
		
		$stmt = $this->db->prepare("SELECT * FROM admin WHERE id = :id");
		$stmt->execute(['id' =>$id]);
		return $stmt->fetch();
	}
	
	/**
	*	редактирование админа
	*/
	public function updateAdminPass($id, $password){
		
		$stmt = $this->db->prepare("UPDATE admin SET password = :password WHERE id= :id");
		$stmt->execute(['password'=>md5($password), 'id'=>$id]);
		
	}
	
	/**
	*	удаление админа
	*/
	public function deleteAdmin($admin){
		
	$stmt = $this->db->prepare("DELETE FROM admin WHERE id = :id");
	$stmt->execute(['id'=>$admin]);
		
	}
	
	/**
	*	авторизация админа
	*/
	public function findAuth($log, $pass)
	{
		$stmt = $this->db->prepare("SELECT * FROM admin WHERE name = :name AND password = :password");
		
		$stmt->execute(['name'=>$log, 'password'=>md5($pass)]);
		
		return $stmt->fetch(); 
		
		}
		
	
}











