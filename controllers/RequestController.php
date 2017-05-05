<?php
namespace controllers;
use models\Request;

class RequestController extends CoreController{


    function __construct()
	{
		
		$this->model = new Request();
		
	}
	
	/**
	*	показ вопросов одной темы
	*/
    public function getEntry($params)
	{
	
	$session = $this->model->checkLogged();
	
	if (isset($params['cat']) && is_numeric($params['cat'])) {
				
				$entry = $this->model->showOneCat($params['cat']);
		
				
				echo $this->render('show_entry.php',['entry'=> $entry]);
			}
	
    }

	/**
	*	добавление вопроса в выбранную тему
	*/
    public function postAdd($params, $post){
	$session = $this->model->checkLogged();
	$text= (string)$post['text'];
	$id = (int)$params['cat'];
	$this->model->addRequest($text, $id, $session['name']);
	header('Location: ?/request/entry/cat/'.$params['cat']);
    }
	
	/**
	*	удаление вопроса из темы
	*/
    public function getDelete($params)
	{
		$session = $this->model->checkLogged();
		if (isset($params['id']) && is_numeric($params['id'])) {

			$this->model->delRequest($params['id']);
		
				header('Location: ?/request/entry/cat/'.$params['cat']);
			
		}
	}
	
	/**
	*	вывод формы для редактирования
	*/
    public function getEdit($params){
	
	$session = $this->model->checkLogged();
	
	if(isset($params)){
		
		$entryToEdit = $this->model->showOneRequest((int)$params['cat'], (int)$params['id']);
		
		
	}
	$categories = $this->model->findAllСategories();

	echo $this->render('edit_entry.php', ['entryToEdit'=>$entryToEdit,'categories'=>$categories]);
    }
	
	/**
	*	редактирование/ добавление ответа выбранного вопроса
	*/
    public function postUpdate($params, $post)
	{
	
	$session = $this->model->checkLogged();
	
	if(isset($post)){
		
		$updateArray = $post;
		$id = (int)$params['id'];
		$hasResponse = $this->model->checkResponse($id);
		if($hasResponse){
			$this->model->entryUpdate($id, $updateArray);
		}
		else{
			$this->model->entryUpdateInsert($id, $updateArray);
		}
		
		header('Location: ?/request/entry/cat/'.$params['cat']);
	}
	
	
    }
	
	/**
	* показ всех новых вопросов
	*/
    public function getNew()
	{
	
	$newEntries = $this->model->showNewRequest();


	echo $this->render('new_entry.php', ['newEntries'=> $newEntries]);
		
    }

}



