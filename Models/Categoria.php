<?php
namespace Models;

use \Core\Model;

class Categoria extends Model {

	public function getAll($company)
	{
		$array = [];

		$sql="SELECT categories.*, (select count(products.id) from products where products.category = categories.name_category AND id_company = :id) as total_products FROM categories WHERE id_company = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $company);
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		return $array;
	}

	public function getCategoriaId($id, $company)
	{
		$array = [];

		$sql = "SELECT * FROM categories WHERE id = :id AND id_company = :idc";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->bindValue(':idc', $company);
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
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

	public function saveCategoria($company, $category, $status)
    {

        $sql ="INSERT INTO categories SET id_company = :company, name_category = :n, category_status = :s";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':company', $company);
        $sql->bindValue(':n', $category);
        $sql->bindValue(':s', $status);
        $sql->execute();


        if ($sql->rowCount() > 0) {
            set_flash('success','<span><b> Sucesso - </b> Categoria cadastrada com sucesso!</span>');
        } else {
            set_flash('error','<span><b> Erro - </b> Algo deu errado tente novamente!</span>');
        }
    }

	public function editCategoria($category, $status, $id, $company)
    {

        $sql ="UPDATE categories SET name_category = :n, category_status = :s WHERE id = :id AND id_company = :idc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':n', $category);
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
									<b> Sucesso - </b> Categoria editada com sucesso!</span>
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

	public function delCategory($company, $id)
	{
		$sql ="DELETE FROM categories WHERE id = :id AND id_company = :idc";
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
									<b> Sucesso - </b> Bairro apagado com sucesso!</span>
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