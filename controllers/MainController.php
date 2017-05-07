<?php

namespace controllers;
use models\Main;

class MainController extends CoreController
{
	
	function __construct()
	{
		
		$this->model = new Main();
		
	}
	

	/**
	 * Вывод всех рубрик и вопросов
	 * @return array
	 */
	public function getList()
	{
		
		$data = $this->model->findAll();
		
		echo $this->render('view.php', ['data' =>$data]);
		
	}
	
	public function getForm(){
		
		$categories = $this->model->findAllСategories();
		echo $this->render('form.php', ['categories' =>$categories]);
	}
	
	
	/**
	 * отправка через форму вопроса посетителем сайта
	 * 
	 */
	public function postForm($params, $post){
	$name = '';
	$email = '';
	$text = '';
	$category = '';
	$message= [];
	$categories = $this->model->findAllСategories();
	if(isset($post))
	{
	$name = (string)$post['name'];
	$email = (string)$post['email'];
	$text = (string)$post['text'];
	$category = $post['cat'];
	

	if($name==='')
	{
		$message['error'][] = "Введите ваше имя";
	}
	if($email==='') 
	{
		$message['error'][] = "Введите ваш email";
	}
	if($text ==='') 
	{
		$message['error'][] = "Введите текст вопроса";
	}

	
	if(empty($message))
	{
	
	if($this->model->add(['text'=>$text, 'category' => $category, 'name' => $name, 'email' => $email]))
		{
		$message['success'][] = "Вaш вопрос получен! Спасибо за Ваш интерес к нашей фирме";
		}
	}
	}
	echo $this->render('form.php', ['message'=>$message, 'categories' =>$categories, 'name' =>$name, 'email'=>$email, 'text'=>$text]);	
	
	
}

	
}

