<?php
namespace Models;

use \Core\Model;

class Relatorio extends Model {

	public function getCat()
	{
		$array = array();

		$sql ="SELECT * FROM cat_despesa";
		$sql = $this->db->query($sql);

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getTotalDespesas($data_inicial, $data_final)
	{
	
		$sql ="SELECT SUM(valor) as total FROM despesa
					  WHERE data_d BETWEEN '$data_inicial' AND '$data_final'";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}
	}

	public function getTotalEntrada($data_inicial, $data_final)
	{

		$sql ="SELECT sum(valor) as total FROM receita
					  WHERE data_d BETWEEN '$data_inicial' AND '$data_final'";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}
	}

	public function getTotalPedido($data_inicial, $data_final, $company)
	{

		$sql ="SELECT COUNT(id) as total FROM orders
					  WHERE date_order BETWEEN '$data_inicial' AND '$data_final' AND id_company = '$company'";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}
	}

	public function getTotalValorPedidoDayBetween($data_inicial, $data_final)
	{
		$sql ="SELECT SUM(valor) as total_day FROM receita
					  WHERE id_cat = 6 AND data_d BETWEEN '$data_inicial' AND '$data_final'";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}

		$sql ="SELECT SUM(valor) as total FROM pedidos
					  WHERE data_pedido BETWEEN '$data_inicial' AND '$data_final'";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}
	}

	public function getTotalDespesasDay($data)
	{
	
		$sql ="SELECT SUM(valor) as total_day FROM despesa
					  WHERE data_d = '$data'";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}
	}

	public function getTotalEntradaDay($data)
	{

		$sql ="SELECT sum(valor) as total_day FROM receita
					  WHERE data_d = '$data'";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}
	}

	public function getTotalPedidoDay($data)
	{

		$sql ="SELECT COUNT(id) as total_day FROM pedidos
					  WHERE data_pedido = '$data'";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}
	}

	public function getTotalValorPedidoDay($data)
	{

		$sql ="SELECT SUM(valor) as total_day FROM receita
					  WHERE data_d = '$data' AND id_cat = 6";
		$sql = $this->db->query($sql);
	
		if ($sql->rowCount() > 0) {
			return $sql->fetch(\PDO::FETCH_ASSOC);
		}
	}

	public function getTotalEDPV($data)
	{
		$array = [];

		// total de entrada
		$sqle ="SELECT SUM(valor) as total_entrada FROM receita
					  WHERE data_d = '$data'";
		$sqle = $this->db->query($sqle);
	
		if ($sqle->rowCount() > 0) {
			$array['entrada'] = $sqle->fetch(\PDO::FETCH_ASSOC);
		}

		// total de despesas
		$sqlp ="SELECT SUM(valor) as total_despesa FROM despesa
					  WHERE data_d = '$data'";
		$sqlp = $this->db->query($sqlp);
	
		if ($sqlp->rowCount() > 0) {
			$array['despesa'] = $sqlp->fetch(\PDO::FETCH_ASSOC);
		}

		// total de pedidos
		$sqlped ="SELECT COUNT(id) as total_pedidos FROM pedidos WHERE data_pedido = '$data'";
		$sqlped = $this->db->query($sqlped);
	
		if ($sqlped->rowCount() > 0) {
			$array['pedidos'] = $sqlped->fetch(\PDO::FETCH_ASSOC);
		}

		// total valor de pedidos
		$sqlped ="SELECT SUM(valor) as total_pedidos FROM receita
					  WHERE data_d = '$data' AND id_cat = 6";
		$sqlped = $this->db->query($sqlped);
	
		if ($sqlped->rowCount() > 0) {
			$array['valor_pedidos'] = $sqlped->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function getMaisVendidos()
    {
        $sql ="SELECT SUM(mais_vendidos.qt_prod) as total,
			products.name_product, products.image FROM mais_vendidos INNER JOIN products 
			ON(mais_vendidos.id_prod = products.id_product)
			GROUP BY id_prod ORDER BY total DESC LIMIT 5;";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

	public function addDespesa($descricao, $valor, $data_d, $conta, $id_cat)
	{
		$sql ="INSERT INTO despesa SET descricao = :descricao, valor = :valor, data_d = :data_d,
		conta = :conta, id_cat = :id_cat";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':descricao', $descricao);
		$sql->bindValue(':valor', $valor);
		$sql->bindValue(':data_d', date('Y-m-d', strtotime($data_d)));
		$sql->bindValue(':conta', $conta);
		$sql->bindValue(':id_cat', $id_cat);
		$sql->execute();

		if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Despesa cadastrada com sucesso!</span>
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

	public function getAllReco()
	{
		$array = array();

		$sql ="SELECT descricao,
					  valor,
					  data_parc,
					  qtd_parc,
					  id_cat,
					  img,
					  nome,
					  ventrada,
					  juro,
					  conta FROM des_recorrente as dr INNER JOIN cat_despesa as cd ON(dr.id_cat = cd.id)";
		$sql = $this->db->prepare($sql);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function addDesRecorrente($descricao, $valor, $ventrada, $juro, $qtd_parc, $data_parc, $conta, $id_cat)
	{
		if ($juro == null) {
			$sql ="INSERT INTO des_recorrente SET descricao = :descricao, valor = :valor, ventrada = :ventrada, juro = :juro, qtd_parc = :qtd_parc, data_parc = :data_parc, conta = :conta, id_cat = :id_cat";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':valor', $valor);
			$sql->bindValue(':ventrada', $ventrada);
			$sql->bindValue(':juro', $juro);
			$sql->bindValue(':qtd_parc', $qtd_parc);
			$sql->bindValue(':data_parc', date('Y-m-d', strtotime($data_parc)));
			$sql->bindValue(':conta', $conta);
			$sql->bindValue(':id_cat', $id_cat);
			$sql->execute();
		} else {
			$new_valor_total = ($juro/100) * $valor;
			$total_juros = $new_valor_total + $valor;
			$sql ="INSERT INTO des_recorrente SET descricao = :descricao, valor = :valor, ventrada = :ventrada, juro = :juro, qtd_parc = :qtd_parc, data_parc = :data_parc, conta = :conta, id_cat = :id_cat";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':valor', $total_juros);
			$sql->bindValue(':ventrada', $ventrada);
			$sql->bindValue(':juro', $juro);
			$sql->bindValue(':qtd_parc', $qtd_parc);
			$sql->bindValue(':data_parc', date('Y-m-d', strtotime($data_parc)));
			$sql->bindValue(':conta', $conta);
			$sql->bindValue(':id_cat', $id_cat);
			$sql->execute();
		}
		
		if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Despesa cadastrada com sucesso!</span>
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

	public function getBairroId($id)
	{
		$array = [];

		$sql = "SELECT * FROM bairros WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		
		if ($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function saveBairro($bairro, $taxa, $retirada)
	{
		$sql ="INSERT INTO bairros SET nome_bairro = :b, taxa_entrega = :t, retirada = :r";
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

	public function editBairro($bairro, $taxa, $retirada, $id_bairro)
	{
		$sql ="UPDATE bairros SET nome_bairro = :b, taxa_entrega = :t, retirada = :r WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':b', $bairro);
		$sql->bindValue(':t', $taxa);
		$sql->bindValue(':r', $retirada);
		$sql->bindValue(':id', $id_bairro);
		$sql->execute();

		if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top:10px;">
									<i class="fa fa-times"></i>
									</button>
									<span>
									<b> Sucesso - </b> Bairro atualizado com sucesso!</span>
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

	public function delBairro($id)
	{
		$sql ="DELETE FROM bairros WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
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
									<b> Sucesso - </b> Altera????o feita com sucesso!</span>
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