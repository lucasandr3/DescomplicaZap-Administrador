<?php
namespace Models;

use \Core\Model;

class Pedido extends Model {
    
    public function newPedido($pedido, $data, $hora, $total, $subtotal, $endereco, $entrega, $pagamento, $troco, $ids)
    {
        $sql ="INSERT INTO pedidos SET pedido = :p, total = :t, subtotal = :st,
            pagamento = :pg, entrega = :en, troco = :tr, endereco = :ende,
            data_pedido = :dta, hora_pedido = :hp";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':p', $pedido);
        $sql->bindValue(':t', $total);
        $sql->bindValue(':st', $subtotal);
        $sql->bindValue(':pg', $pagamento);
        $sql->bindValue(':en', $entrega);
        $sql->bindValue(':tr', $troco);
        $sql->bindValue(':ende', $endereco);
        $sql->bindValue(':dta', $data);
        $sql->bindValue(':hp', $hora);
        $sql->execute();

        if($sql->rowCount() > 0) {

            $idcat = 6;
            $descricao = 'Pedidos';
            $conta = 'Empresa';
            $id_pedido = $this->db->lastInsertId();

            $sqle ="INSERT INTO receita SET id_cat = :ic, descricao = :d, valor = :v, data_d = :dt, conta = :ct, id_pedido = :i";
            $sqle = $this->db->prepare($sqle);
            $sqle->bindValue(':ic', $idcat);
            $sqle->bindValue(':d', $descricao);
            $sqle->bindValue(':v', $total);
            $sqle->bindValue(':dt', $data);
            $sqle->bindValue(':ct', $conta);
            $sqle->bindValue(':i', $id_pedido);
            $sqle->execute();

            foreach (json_decode($ids) as $value) {
                $sqlm ="INSERT INTO mais_vendidos SET id_prod = :id_prod, qt_prod = :qt_prod, id_pedido = :id";
                $sqlm = $this->db->prepare($sqlm);
                $sqlm->bindValue(':id_prod', $value->id);
                $sqlm->bindValue(':qt_prod', $value->qt);
                $sqlm->bindValue(':id', $id_pedido);
                $sqlm->execute();
            }

            return true;
        } else {
            return false;
        }
    }

    public function getAllPedidos($id_company)
    {
        $sql ="SELECT * FROM pedidos WHERE id_company = :id_company ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function getAll($company)
    {
        $sql ="SELECT * FROM orders WHERE order_status = 'WAITING' AND id_company = :id ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function getAllProgress($company)
    {
        $sql ="SELECT * FROM orders WHERE order_status = 'PROGRESS' AND id_company = :id ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function getAllDelivery($company)
    {
        $sql ="SELECT * FROM orders WHERE order_status = 'DELIVERY' AND id_company = :id ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function getAllFinalizados($status, $company)
    {
        $sql ="SELECT * FROM orders WHERE order_status = :os AND id_company = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':os', $status);
        $sql->bindValue(':id', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function getAllCancelados($status, $company)
    {
        $sql ="SELECT * FROM orders WHERE order_status = :os AND id_company = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':os', $status);
        $sql->bindValue(':id', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function getPedidoId($id, $company)
    {
        $sql ="SELECT * FROM orders WHERE id = :id AND id_company = :idc";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->bindValue(':idc', $company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch(\PDO::FETCH_ASSOC);
        }
    }

    public function setStatusOrder($id, $status)
    {
        $sql ="UPDATE pedidos SET status_do_pedido = :st WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':st', $status);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            
            return true;
        } else {
            return false;
        }
    }

    public function setCancelOrder($id, $status)
    {
        $sql ="UPDATE pedidos SET status_do_pedido = :st WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':st', $status);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $sqlr ="DELETE FROM receita WHERE id_pedido = :idp";
            $sqlr = $this->db->prepare($sqlr);
            $sqlr->bindValue(':idp', $id);
            $sqlr->execute();

            $sqlm ="DELETE FROM mais_vendidos WHERE id_pedido = :idpm";
            $sqlm = $this->db->prepare($sqlm);
            $sqlm->bindValue(':idpm', $id);
            $sqlm->execute();
            
            return true;
        } else {
            return false;
        }
    }
    
    public function getAllNeigth()
    {
        $array = [];

		$sql ="SELECT * FROM bairros";
		$sql = $this->db->query($sql);
		
		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		return $array;
    }
}