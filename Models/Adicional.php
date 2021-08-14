<?php
namespace Models;

use \Core\Model;

class Adicional extends Model {

	public function getAll($company)
	{
		$array = [];

		$sql ="SELECT 
                op.id,
                op.id_company,
                op.name_option,
                op.option_status,
                p.name_product,
                (select count(options_product_item.id) from options_product_item WHERE options_product_item.id_option_product = op.id AND id_company = :id) as total_itens
                FROM options_product as op INNER JOIN products as p ON(op.id_product = p.id) WHERE op.id_company = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $company);
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		return $array;
	}

	public function getAdicionalId($id, $comapany)
	{
		$array = [];

		$sql ="SELECT 
                op.id,
                op.id_company,
                op.id_product,
                op.name_option,
                op.option_status,
                p.name_product
                FROM options_product as op INNER JOIN products as p ON(op.id_product = p.id) WHERE op.id = :id AND op.id_company = :idc";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->bindValue(':idc', $comapany);
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function getProducts($company)
	{
		$array = [];

		$sql ="SELECT id, name_product FROM products WHERE id_company = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $company);
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		return $array;
	}

	public function saveBairro($bairro, $taxa, $retirada)
	{
		$sql ="INSERT INTO categories SET nome_bairro = :b, taxa_entrega = :t, retirada = :r";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':b', $bairro);
		$sql->bindValue(':t', $taxa);
		$sql->bindValue(':r', $retirada);
		$sql->execute();

		if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Bairro cadastrado com sucesso!</span>
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

	public function saveAdicional($produto, $adicional, $status, $company)
    {            
        $sql ="INSERT INTO options_product SET id_company = :idc, id_product = :p, name_option = :a, option_status = :s";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':idc', $company);
        $sql->bindValue(':p', $produto);
        $sql->bindValue(':a', $adicional);
        $sql->bindValue(':s', $status);
        $sql->execute();        

        if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Adicional cadastrado com sucesso!</span>
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

	public function editAdicional($option, $status, $id_product, $id, $company)
    {
        $sql ="UPDATE options_product SET id_product = :ip, name_option = :n, option_status = :s WHERE id = :id AND id_company = :idc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':ip', $id_product);
        $sql->bindValue(':n', $option);
        $sql->bindValue(':s', $status);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':idc', $company);
        $sql->execute();

    
        if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Adicional editado com sucesso!</span>
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

	public function delAdicional($id, $company)
	{
		$sql ="DELETE FROM options_product WHERE id = :id AND id_company = :idc";
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
									<b> Sucesso - </b> Adicional apagado com sucesso!</span>
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

	public function qtPratos()
	{
		$array = [];

		$sql ="SELECT count(*) as total FROM products";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function editStore($nome, $rua, $bairro, $cidade, $numero, $telefone, $img=NULL)
	{
		if($img) {

			$sql ="UPDATE informacoes SET nome = :n, rua = :r, bairro = :b, cidade = :c, numero = :nu, telefone = :t, logo = :l";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':n', $nome);
			$sql->bindValue(':r', $rua);
			$sql->bindValue(':b', $bairro);
			$sql->bindValue(':c', $cidade);
			$sql->bindValue(':nu', $numero);
			$sql->bindValue(':t', $telefone);
			$sql->bindValue(':l', $img);
			$sql->execute();

		} else {

			$sql ="UPDATE informacoes SET nome = :n, rua = :r, bairro = :b, cidade = :c, numero = :nu, telefone = :t";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':n', $nome);
			$sql->bindValue(':r', $rua);
			$sql->bindValue(':b', $bairro);
			$sql->bindValue(':c', $cidade);
			$sql->bindValue(':nu', $numero);
			$sql->bindValue(':t', $telefone);
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

}