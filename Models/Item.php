<?php
namespace Models;

use \Core\Model;

class Item extends Model {

    public function getItens($company)
    {
        $array = [];

        // $sql ="SELECT * FROM product_options as po INNER JOIN category_option as co ON(po.id_category_option = co.id_category_option) INNER JOIN products as p ON(po.id_product = p.id_product) ORDER BY co.category_name_option";
        $sql ="SELECT 
                opi.id,
                opi.name_option_item,
                opi.price_option_item,
                opi.option_item_status,
                op.name_option,
                p.name_product
                 FROM options_product_item as opi INNER JOIN options_product as op ON(opi.id_option_product = op.id) INNER JOIN products as p ON(opi.id_product = p.id) WHERE opi.id_company = :idc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idc', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function getItemId($id, $company)
    {
        $array = [];

        // $sql ="SELECT * FROM product_options as po INNER JOIN category_option as co ON(po.id_category_option = co.id_category_option) INNER JOIN products as p ON(po.id_product = p.id_product) ORDER BY co.category_name_option";
//        $sql ="SELECT
//            po.id_option,
//            po.name_option,
//            po.price_option,
//            po.available,
//            co.id_category_option,
//            co.category_name_option,
//            p.name_product,
//            p.id_product
//            FROM product_options as po INNER JOIN category_option as co ON(po.id_category_option = co.id_category_option) INNER JOIN products as p ON(po.id_product = p.id_product) WHERE po.id_option = :id";
        $sql ="SELECT 
                opi.id,
                opi.name_option_item,
                opi.price_option_item,
                opi.option_item_status,
                opi.id_product,
                opi.id_option_product,
                op.name_option,
                p.name_product
                 FROM options_product_item as opi INNER JOIN options_product as op ON(opi.id_option_product = op.id) INNER JOIN products as p ON(opi.id_product = p.id) WHERE opi.id = :id AND opi.id_company = :idc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':idc', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function saveItem($nome, $id_category, $id_product, $price_option, $available, $company)
    {
//        echo "<pre>";
//        print_r($nome);
//        echo "<pre>";
//        print_r($id_category);
//        echo "<pre>";
//        print_r($id_product);
//        echo "<pre>";
//        print_r($price_option);
//        echo "<pre>";
//        print_r($available);
//        echo "<pre>";
//        print_r($company);
//        exit;
        $sql ="INSERT INTO options_product_item SET id_company = :idc, id_product = :id, id_option_product = :iop, name_option_item = :n, price_option_item = :poi, option_item_status = :s";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idc', $company);
        $sql->bindValue(':id', $id_product);
        $sql->bindValue(':iop', $id_category);
        $sql->bindValue(':n', $nome);
        $sql->bindValue(':poi', $price_option);
        $sql->bindValue(':s', $available);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;>
									<< class="fa fa-times"></>
									</button>
									<span>
									<b> Sucesso - </b> Item cadastrado com sucesso!</span>
								  </div>';
        } else {
            $_SESSION['alert'] = '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;>
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Erro - </b> Algo deu errado tente novamente!</span>
								  </div>';
        }
    }

    public function editItem($nome, $id_category, $id_product, $price_option, $id_option, $status, $company)
    {
        $sql ="UPDATE options_product_item SET name_option_item = :n, price_option_item = :po, option_item_status = :s WHERE id = :id AND id_company = :idc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':n', $nome);
        $sql->bindValue(':po', $price_option);
        $sql->bindValue(':s', $status);
        $sql->bindValue(':id', $id_option);
        $sql->bindValue(':idc', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;>
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Item Editado com sucesso!</span>
								  </div>';
        } else {
            $_SESSION['alert'] = '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;>
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Erro - </b> Algo deu errado tente novamente!</span>
								  </div>';
        }
    }

    public function active($id_option)
    {
        $new_status = 0;
        $sql ="UPDATE product_options SET available = :a WHERE id_option = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':a', $new_status);
        $sql->bindValue(':id', $id_option);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function inactive($id_option)
    {
        $new_status = 1;
        $sql ="UPDATE product_options SET available = :a WHERE id_option = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':a', $new_status);
        $sql->bindValue(':id', $id_option);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delItem($id, $company)
	{
		$sql ="DELETE FROM options_product_item WHERE id = :id AND id_company = :idc";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->bindValue(':idc', $company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Item apagado com sucesso!</span>
								  </div>';
        } else {
            $_SESSION['alert'] = '<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Erro - </b> Algo deu errado tente novamente!</span>
								  </div>';
        }
	}
}