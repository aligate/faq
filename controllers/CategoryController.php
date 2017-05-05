<?php
namespace controllers;
use models\Category;

class CategoryController extends CoreController{


    function __construct()
	{
		
		$this->model = new Category();
		
	}
	/**
	*	показ всех категорий
	*/
    public function getList()
	{
	
	$session = $this->model->checkLogged();
	
	$getAllCategories = $this->model->showCategoriesList();
	
	echo $this->render('show_category.php', ['getAllCategories' => $getAllCategories]);
	
    }

	/**
	*	добовление категории
	*/
    public function postAdd($params, $post)
	{
	$session = $this->model->checkLogged();
	
	if($post){
		$name = (string)$post['name'];
		$this->model->createCategory($name);
		header('Location: ?/category/list');
	}
    }
	
	/**
	* удаление категории
	*/
	public function getDelete($params)
	{
		$session = $this->model->checkLogged();
		if (isset($params['cat']) && is_numeric($params['cat'])) {

			$this->model->delCatAndRequest($params['cat']);
		
				header('Location: ?/category/list');
			
		}
	}
	
	

}



