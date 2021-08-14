<?php
namespace Controllers;

use \Core\Controller;
use \Models\Store;
use \Models\Users;

class StoreController extends Controller {

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
        $data = array('user' => $this->user);

        $data['name'] = $this->user->getName();

        $store = new Store();

        $data['title'] = 'Empresas';
        $data['menu'] = 'empresaac';

        $data['stores'] = $store->getStores();

        $this->loadTemplate('stores/stores_actives', $data);
    }

    public function store_inactive()
    {
        $data = array('user' => $this->user);

        $data['name'] = $this->user->getName();

        $store = new Store();

        $data['title'] = 'Empresas';
        $data['menu'] = 'empresain';

        $data['stores'] = $store->getStoresInactives();

        $this->loadTemplate('stores/stores_inactives', $data);
    }

    public function details($id, $type)
    {
        $store = new Store();
        
        $data['title'] = 'Empresas';
        if($type === 'active') {
            $data['menu'] = 'da';
        } else {
            $data['menu'] = 'di';
        }   

        $data['stores_details'] = $store->getStoreDetail($id);
        $data['users_store'] = $store->getUsersStore($id);
 
        $this->loadTemplate('stores/details', $data);
    }

    public function desative($id)
    {
        $store = new Store();
        
        $data['title'] = 'Empresas';
        $data['menu'] = 'empresaac';

        $store->getStoreDesative($id);
        redirect('store');
    }

    public function active($id)
    {
        $store = new Store();
        
        $data['title'] = 'Empresas';
        $data['menu'] = 'empresaac';

        $store->getStoreActive($id);
        redirect('store');
    }
}