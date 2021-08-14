<?php
namespace Controllers;

use \Core\Controller;
use \Models\Categoria;
use \Models\Users;

class CategoriaController extends Controller {

	private $user;

    public function __construct()
    {
        $this->user = new Users();

        if (!$this->user->verifyLogin()) {
            header("Location: ".BASE_URL."login");
            exit;
		}

		// if (!$this->user->hasPermission('dashboard_view')) {
		// 	$this->loadView('404/500');
        //     exit;
        // } 
    }

	public function index()
	{
		$data = [];

		$data = array('user' => $this->user);

        $data['name'] = $this->user->getName();

		$data['title'] = 'Categorias';
		$data['menu']    = 'categoria';

		$categoria = new Categoria();

		$data['categorias'] = $categoria->getAll(getUser()->id_company);
      
		$this->loadTemplate('categoria/categorias', $data);
	}

	public function addAction()
    {
        $categoria = new Categoria();
        if(isset($_POST['company']) && !empty($_POST['company'])) {
            
            $company   = addslashes(trim($_POST['company']));
            $category   = addslashes(trim($_POST['name_category']));
            $status     = addslashes(trim($_POST['status']));

            $categoria->saveCategoria($company, $category, $status);
            redirect('categoria');
        }
    }

	public function edit($id)
	{
		$data = [];

		$data = array('user' => $this->user);

        $data['name'] = $this->user->getName();

		$data['title'] = 'Edição de categoria';
		$data['menu']    = 'categoria';

		$categoria = new Categoria();

		$data['categoria'] = $categoria->getCategoriaId($id, getUser()->id_company);
      
		$this->loadTemplate('categoria/categoria_edit', $data);
	}

	public function editAction()
    {
        $categoria = new Categoria();
        if(isset($_POST['name_category']) && !empty($_POST['name_category'])) {
            
            $category   = addslashes(trim($_POST['name_category']));
            $status     = addslashes(trim($_POST['status']));
            $id         = addslashes(trim($_POST['id']));

            $categoria->editCategoria($category, $status, $id, getUser()->id_company);
            redirect('categoria/edit/'.$id);
        }
    }

	public function delete($id)
	{
		$categoria = new Categoria();
		$categoria->delCategory(getUser()->id_company, $id);
		redirect('categoria');
	}

}