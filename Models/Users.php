<?php
namespace Models;

use \Core\Model;
use \Models\Permissoes;

class Users extends Model
{
	private $uid;
	private $permissoes;

	// Função Verifica se o cliente esta no banco
	public function verifyLogin()
	{
		if (!empty($_SESSION['uLogin'])) {
			$s = $_SESSION['uLogin'];

			$sql ="SELECT * FROM users WHERE token = :hash";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':hash', $s);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$p = new Permissoes();

				$data = $sql->fetch(\PDO::FETCH_ASSOC);
				$this->uid = $data['id'];
				$_SESSION['idus'] = $data['id'];
				//$this->permissoes = $p->getPermissoes($data['id_permissao']);
				
				return true;

			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	// Verifica as permissoes do usuario
	public function hasPermission($permission_slug)
	{
		if (in_array($permission_slug, $this->permissoes)) {
			return true;
		} else {
			return false;
		}
	}

	// Verifica se o username esta correto com expressao regular
	public function validateUserName($u)
	{
		if (preg_match('/^[a-z0-9]+$/', $u)) {
			return true;
		} else {
			return false;
		}
	}

	// verifica se o usuario existe
	public function userExists($u)
	{
		$sql ="SELECT * FROM Users WHERE email_user = :u";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":u", $u);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	//cadastra o usuario no banco
	public function registerUser($nome_user, $email_user, $senha)
	{
		$passhash = password_hash($senha, PASSWORD_DEFAULT);

		$sql ="INSERT INTO Users SET nome_user = :n, email_user = :e, senha = :s";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":n", $nome_user);
		$sql->bindValue(":e", $email_user);
		$sql->bindValue(":s", $passhash);
		$sql->execute();
	}

	//valida o usuario para fazer login
	public function validateUser($email, $senha)
	{
		$sql ="SELECT * FROM users WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();
            
		if ($sql->rowCount() > 0) {
			$info = $sql->fetch(\PDO::FETCH_ASSOC);
	
			if (password_verify($senha, $info['password'])) {

				$token = md5(rand(0,9999).time().$info['id']);
				$this->setLoginHash($info['id'], $token);
				$_SESSION['uLogin'] = $token;
		
				setUser($info);
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	//valida o usuario para fazer login
	public function unlockUser($senha, $id_user)
	{
		$sql ="SELECT * FROM Users WHERE id_user = :id_user";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_user", $id_user);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$info = $sql->fetch();

			if (password_verify($senha, $info['senha'])) {

				// $token = md5(rand(0,9999).time().$info['id_user']);
				// $this->setLoginHash($info['id_user'], $token);
				// $_SESSION['uLogin'] = $token;
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	private function setLoginHash($uid, $hash)
	{
		$sql ="UPDATE users SET token = :hash WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":hash", $hash);
		$sql->bindValue(":id", $uid);
		$sql->execute();
	}

	// Função set o usuario logado para os controllers e model
	public function getUid()
	{
		return $this->uid;
	}

	public function getName()
	{
		$array = array();

		$sql ="SELECT * FROM Users as u INNER JOIN permission_groups as pg on(u.id_permissao = pg.id_group) WHERE id_user = :id_user";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_user", $this->uid);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function toggleStyle()
	{
		$id_user = $_SESSION['idus'];

		$sql ="UPDATE layput SET dark = 1 - dark WHERE id_user = '$id_user'";
		$sql = $this->db->query($sql);
	}

	public function getMode()
	{
		$array = array();

		$id_user = $_SESSION['idus'];

		$sql ="SELECT dark FROM layput WHERE id_user = '$id_user'";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
		   $array = $sql->fetch(\PDO::FETCH_ASSOC);	
		}
		return $array;
	}

	public function getAll()
	{
		$array = array();

		$sql = "SELECT * FROM Users as u INNER JOIN permission_groups as pg on(u.id_permissao = pg.id_group) WHERE status = 0";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);	
		 }
		 return $array;
	}

	public function getAllInative()
	{
		$array = array();

		$sql = "SELECT * FROM Users as u INNER JOIN permission_groups as pg on(u.id_permissao = pg.id_group) WHERE status = 1";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);	
		 }
		 return $array;
	}

	public function getCargos()
    {
        $array = array();
        $sql ="SELECT * FROM permission_groups";
        $sql = $this->db->query($sql);
        if($sql->rowCount() > 0) {
           $array = $sql->fetchAll(\PDO::FETCH_ASSOC); 
        }
        return $array;
	}

	public function saveUsuario($nome_user, $email_user, $senha, $id_permissao, $status, $nome)
    {

		$passhash = password_hash($senha, PASSWORD_DEFAULT);

        $sql ="INSERT INTO Users SET nome_user = :nu, email_user = :em, senha = :s, id_permissao = :id, status = :st, foto = :f";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':nu', $nome_user);		
		$sql->bindValue(':em', $email_user);		
		$sql->bindValue(':s', $passhash);	
		$sql->bindValue(':id', $id_permissao);
		$sql->bindValue(':st', $status);
		$sql->bindValue(':f', $nome);
		$sql->execute();
		
		if($sql->rowCount() > 0) {
			$_SESSION['alert'] = '<div class="alert alert-success mt-4" role="alert">
			            <strong><i class="fas fa-check"></i></strong> Usuário Cadastrado Com Sucesso.
                        </div>';
		} else {
			$_SESSION['alert'] = '<div class="alert alert-danger mt-4" role="alert">
			            <strong><i class="fas fa-frown"></i></strong> Erro ao cadastrar Usuário.
                        </div>';
		}
    }
	
	public function toggleStatus($id_user)
	{
		$sql ="UPDATE Users SET status = 1 - status WHERE id_user = '$id_user'";
        $sql = $this->db->query($sql);
   
        if($sql->rowCount() > 0) {
			$_SESSION['alert'] = '<div class="alert alert-success mt-4" role="alert">
			            <strong><i class="fas fa-check"></i></strong> Usuário Atualizado Com Sucesso.
                        </div>';
		} else {
			$_SESSION['alert'] = '<div class="alert alert-danger mt-4" role="alert">
			            <strong><i class="fas fa-frown"></i></strong> Erro ao Atualizar Usuário.
                        </div>';
		}
	}

	public function getUsuarioId($id_user)
	{
		$array = array();
		$sql ="SELECT * FROM Users as u INNER JOIN permission_groups as pg on(u.id_permissao = pg.id_group) WHERE id_user = :id_user";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();
		if($sql->rowCount() > 0) {
		   $array = $sql->fetch(\PDO::FETCH_ASSOC);	
		}
		return $array;
	}
	
	public function ultimoAcesso($id_user)
	{
		$sql ="UPDATE Users SET hora_saida = NOW() WHERE id_user = '$id_user'";
		$sql = $this->db->query($sql);
	}

	public function getColabId($id_colab)
	{
		$array = array();
		$sql ="SELECT * FROM colaboradores as c INNER JOIN permission_groups as pg on(c.cargo = pg.id_group) WHERE id_colab = :id_colab";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_colab', $id_colab);
		$sql->execute();
		if($sql->rowCount() > 0) {
		   $array = $sql->fetch(\PDO::FETCH_ASSOC);	
		}
		return $array;
    }

    public function editUsuario($nome_user, $email_user, $senha = NULL, $id_permissao, $status, $id_user, $nome_foto)
    {
		$sql ="SELECT foto FROM Users WHERE id_user = '$id_user'";
		$sql = $this->db->query($sql);
		if($sql->rowCount() > 0) {
		   $foto_atual = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		if(!$senha) {

			$sql ="UPDATE Users SET nome_user = :nu, email_user = :em, id_permissao = :id,
			status = :st, foto = :f WHERE id_user = :id_user";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':nu', $nome_user);	
			$sql->bindValue(':em', $email_user);	
			$sql->bindValue(':id', $id_permissao);	
			$sql->bindValue(':st', $status);
			if ($nome_foto == NULL) {
				$sql->bindValue(':f', $foto_atual['foto']);
			} else {
				$sql->bindValue(':f', $nome_foto);
			}
			$sql->bindValue(':id_user', $id_user);
			$sql->execute();	
		} else {

			$sql ="SELECT foto FROM Users WHERE id_user = '$id_user'";
			$sql = $this->db->query($sql);
			if($sql->rowCount() > 0) {
			$foto_atual = $sql->fetch(\PDO::FETCH_ASSOC);
			}

			$passhash = password_hash($senha, PASSWORD_DEFAULT);
			$sql ="UPDATE Users SET nome_user = :nu, email_user = :em, senha = :se, id_permissao = :id,
			status = :st, foto = :f WHERE id_user = :id_user";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':nu', $nome_user);	
			$sql->bindValue(':em', $email_user);	
			$sql->bindValue(':se', $passhash);	
			$sql->bindValue(':id', $id_permissao);	
			$sql->bindValue(':st', $status);
			if ($nome_foto == NULL) {
				$sql->bindValue(':f', $foto_atual['foto']);
			} else {
				$sql->bindValue(':f', $nome_foto);
			}
			$sql->bindValue(':id_user', $id_user);
			$sql->execute();
		}

		if($sql->rowCount() > 0) {
			$_SESSION['alert'] = '<div class="alert alert-success mt-4" role="alert">
			            <strong><i class="fas fa-check"></i></strong> Colaborador Atualizado Com Sucesso.
                        </div>';
		} else {
			$_SESSION['alert'] = '<div class="alert alert-danger mt-4" role="alert">
			            <strong><i class="fas fa-frown"></i></strong> Erro ao Atualizar Colaborador.
                        </div>';
		}
	}

	//valida o usuario para fazer login
	public function validateEmailForgot($email)
	{
		$sql ="SELECT * FROM Users WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$data = $sql->fetch(\PDO::FETCH_ASSOC);
			$_SESSION['id_user_reset'] = $data['id'];
			return true;
		} else {
			return false;
		}
	}
	
	public function newPass($password, $id_user)
	{
		$passhash = password_hash($password, PASSWORD_DEFAULT);

		$sql ="UPDATE Users SET password = :se WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':se', $passhash);
		$sql->bindValue(':id', $id_user);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
		
	}
}