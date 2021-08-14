<?php
namespace Controllers;

use \Core\Controller;
use \Models\Store;
use \Models\Users;
use \Models\Relatorio;
use \Models\Pedido;

class HomeController extends Controller {

    private $user;
    private $userSession;

    public function __construct()
    {
        $this->user = new Users();
        // $this->userSession = getUser();

        if (!$this->user->verifyLogin()) {
            redirect("login");
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

        //$data['name'] = $this->user->getName();

        $store = new Store();

        $data['title'] = 'Dashboard';
        $data['menu'] = 'home';

        $data['total_stores'] = $store->getTotalStores();
        // $data['platforms'] = $store->getPlatforms(getUser()->id_company);
        // $data['total_pratos'] = $store->qtPratos(getUser()->id_company);
    
        $data1 = mktime(0, 0, 0, date('m') , 1 , date('Y'));
		$data2 = mktime(23, 59, 59, date('m'), date("t"), date('Y'));

		$data['data_inicial'] = date('Y-m-d',$data1);
		$data['data_final']   = date('Y-m-d',$data2);

		$r = new Relatorio();
//		$data['total_entrada'] = $r->getTotalEntrada($data['data_inicial'], $data['data_final']);
//		$data['total_despesa'] = $r->getTotalDespesas($data['data_inicial'], $data['data_final']);
		//$data['total_pedido'] = $r->getTotalPedido($data['data_inicial'], $data['data_final'], getUser()->id_company);

        $pedido = new Pedido();
        // $data['new_orders'] = $pedido->getAll(getUser()->id_company);
        // $data['orders_progress'] = $pedido->getAllProgress(getUser()->id_company);
        // $data['orders_delivery'] = $pedido->getAllDelivery(getUser()->id_company);
//        echo "<pre>";
//        print_r($data['new_orders']);
//        exit;
        $this->loadTemplate('home/home', $data);
    }
}