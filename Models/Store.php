<?php
namespace Models;

use \Core\Model;

class Store extends Model {

	public function getInfo()
	{
		$array = [];

		$sql ="SELECT * FROM informacoes";
		$sql = $this->db->query($sql);
		
		if ($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}
		
		return $array;
	}

	public function getTotalStores()
	{
		$sql = "SELECT COUNT(id) as total FROM companies";
		$sql = $this->db->query($sql);
		return $sql->fetch(\PDO::FETCH_ASSOC);
	}

	public function getStores()
	{
		$sql = "SELECT * FROM companies WHERE company_status = 'ACTIVE'";
		$sql = $this->db->query($sql);
		return $sql->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getStoresInactives()
	{
		$sql = "SELECT * FROM companies WHERE company_status = 'INACTIVE'";
		$sql = $this->db->query($sql);
		return $sql->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getStoreDetail($id)
	{
		$sql = "SELECT * FROM companies as c INNER JOIN config_menu as cm ON(c.id = cm.id_company) INNER JOIN store_info as si ON(c.id = si.id_company) WHERE c.id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		return $sql->fetch(\PDO::FETCH_ASSOC);
	}
	
	public function getUsersStore($id)
	{
		$sql = "SELECT * FROM usuarios as u INNER JOIN permission_groups as pg ON(u.id_permissao = pg.id_group) WHERE u.id_company = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		return $sql->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getStoreDesative($id)
	{
		$sql = "UPDATE companies SET company_status = 'INACTIVE' WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			set_flash('success', 'Status alterado com sucesso!');
		} else {
			set_flash('error', 'ALgo deu errado, tente novamente.');
		}	
	}

	public function getStoreActive($id)
	{
		$sql = "UPDATE companies SET company_status = 'ACTIVE' WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			set_flash('success', 'Status alterado com sucesso!');
		} else {
			set_flash('error', 'ALgo deu errado, tente novamente.');
		}	
	}
	
	public function getPlatforms()
	{
		$array = [];
		$sql ="SELECT DISTINCT platform, COUNT( platform ) as total_platform FROM platform_access GROUP BY platform";
		$sql = $this->db->query($sql);
		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function qtPratos($company)
	{
		$array = [];

		$sql ="SELECT count(id) as total FROM products WHERE id_company = :id_company";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_company', $company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function editStore($nome, $rua, $bairro, $cidade, $numero, $telefone, $img=NULL, $company)
	{
		if($img) {

			$sql ="UPDATE store_info SET name_store = :n, street = :r, neighborhood = :b, city = :c, number = :nu, phone = :t, logo = :l WHERE id_company = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':n', $nome);
			$sql->bindValue(':r', $rua);
			$sql->bindValue(':b', $bairro);
			$sql->bindValue(':c', $cidade);
			$sql->bindValue(':nu', $numero);
			$sql->bindValue(':t', $telefone);
			$sql->bindValue(':l', $img);
			$sql->bindValue(':id', $company);
			$sql->execute();

		} else {

			$sql ="UPDATE store_info SET name_store = :n, street = :r, neighborhood = :b, city = :c, number = :nu, phone = :t WHERE id_company = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':n', $nome);
			$sql->bindValue(':r', $rua);
			$sql->bindValue(':b', $bairro);
			$sql->bindValue(':c', $cidade);
			$sql->bindValue(':nu', $numero);
			$sql->bindValue(':t', $telefone);
			$sql->bindValue(':id', $company);
			$sql->execute();

		}


		if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Alteração feita com sucesso!</span>
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

    public function editLayout($layout, $company)
    {

        $sql ="UPDATE config_menu SET view_products = :v WHERE id_company = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':v', $layout);
        $sql->bindValue(':id', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Alteração feita com sucesso!</span>
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

    public function editTheme($layout, $company)
    {

        $sql ="UPDATE config_menu SET skin = :s WHERE id_company = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':s', $layout);
        $sql->bindValue(':id', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Alteração feita com sucesso!</span>
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

	public function updateHora($hora, $campo)
	{
		$sql ="UPDATE informacoes SET $campo = :c";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':c', $hora);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

    public function closeStore($status, $company)
    {
        $sql ="UPDATE store_info SET open_status = :status WHERE id_company = :idc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':status', $status);
        $sql->bindValue(':idc', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function openStore($status, $company)
    {
        $sql ="UPDATE store_info SET open_status = :status WHERE id_company = :idc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':status', $status);
        $sql->bindValue(':idc', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}