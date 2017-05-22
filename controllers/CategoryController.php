<?php
namespace controllers;
use models\Category;

class CategoryController extends CoreController{


    function __construct()
	{
		
		$this->model = new Category();
		
	}
	/**
	*	все темы 
	*/
    public function getList()
	{
	
	$session = $this->model->checkLogged();
	
	$getAllCategories = $this->model->showCategoriesList();
	
	echo $this->render('show_category.php', ['getAllCategories' => $getAllCategories]);
	
    }

	/**
	*	добавление темы
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
	* удаление темы
	*/
	public function getDelete($params)
	{
		$session = $this->model->checkLogged();
		if(!empty($session)){
		if (isset($params['cat']) && is_numeric($params['cat'])) {

			$this->model->delCatAndRequest($params['cat']);
		
				header('Location: ?/category/list');
			}	
		}
	}
	
	

}



