<?php

require_once("../db/conexao.php");
require_once("../Model/clienteModel.php");
require_once("../Model/profissionalModel.php");
require_once("../Model/servicoModel.php");
require_once("../Model/loginModel.php");
require_once("../Model/administradorModel.php");
require_once("../Model/cadastroClienteModel.php");
require_once("../Model/cadastroProfissionalModel.php");
require_once("../Model/cadastroAdministradorModel.php");

class mao_De_Obra_Dao{
    
	//Método para cadastrar cliente
    public function cadastrarCliente(loginModel $loginModel, clienteModel $clienteModel){
		
        try {
        
            $this->conn = new conexao();
			
			$stmt = $this->conn->prepare("INSERT INTO logins(login, senha, nivel_acesso) VALUES(?, ?, ? )   "  );
			$stmt->bindValue(1, $loginModel->getLogin(), PDO::PARAM_STR);
			$stmt->bindValue(2, $loginModel->getSenha(), PDO::PARAM_STR);
			$stmt->bindValue(3, $loginModel->getNivel_acesso(), PDO::PARAM_STR);
            $executa_um = $stmt->execute();
			
			
            $stmt2 = $this->conn->prepare("INSERT INTO clientes(id_login_cli, nome_cli, data_nascimento_cli, data_cadastro_cli, endereco_cli, cep_cli, bairro_cli, cidade_cli, estado_cli, telefone_cli, email_cli) VALUES(last_insert_id(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )   "  ) ;
		
            $stmt2->bindValue(1, $clienteModel->getNome_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(2, $clienteModel->getData_Nascimento_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(3, $clienteModel->getData_Cadastro_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(4, $clienteModel->getEndereco_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(5, $clienteModel->getCep_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(6, $clienteModel->getBairro_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(7, $clienteModel->getCidade_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(8, $clienteModel->getEstado_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(9, $clienteModel->getTelefone_cli(), PDO::PARAM_STR);
			$stmt2->bindValue(10, $clienteModel->getEmail_cli(), PDO::PARAM_STR);
			
			$executa_dois = $stmt2->execute();
            $this->conn = null;
			
            if($executa_um and $executa_dois){   
                return true;
            }  else {
                return false;    
            }
            
        }catch (Exception $ex) {
            echo "Erro: " . $ex->getMessage();
        }       
        
    }
	

	//Método para cadastrar profissional
	public function cadastrarProfissional(loginModel $loginModel, servicoModel $servicoModel, profissionalModel $profissionalModel){
	
        try {
        
            $this->conn = new conexao();
			
			$stmt = $this->conn->prepare("INSERT INTO logins(login, senha, nivel_acesso) VALUES(?, ?, ? )   "  );
			$stmt->bindValue(1, $loginModel->getLogin(), PDO::PARAM_STR);
			$stmt->bindValue(2, $loginModel->getSenha(), PDO::PARAM_STR);
			$stmt->bindValue(3, $loginModel->getNivel_acesso(), PDO::PARAM_STR);
            $executa_um = $stmt->execute();
			
			
            $stmt2 = $this->conn->prepare("INSERT INTO profissionais(id_login_pro, id_serv_pro, nome_pro, cpf_pro, data_nascimento_pro, data_cadastro_pro, escolaridade_pro, endereco_pro, cep_pro, bairro_pro, cidade_pro, estado_pro, resumo_experiencia_pro, telefone_pro, email_pro) VALUES( last_insert_id() , ? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )   "  ) ;
			
			$stmt2->bindValue(1, $servicoModel->getId_serv(), PDO::PARAM_STR);
            $stmt2->bindValue(2, $profissionalModel->getNome_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(3, $profissionalModel->getCpf_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(4, $profissionalModel->getData_Nascimento_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(5, $profissionalModel->getData_Cadastro_pro(), PDO::PARAM_STR);
		    $stmt2->bindValue(6, $profissionalModel->getEscolaridade_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(7, $profissionalModel->getEndereco_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(8, $profissionalModel->getCep_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(9, $profissionalModel->getBairro_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(10, $profissionalModel->getCidade_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(11, $profissionalModel->getEstado_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(12, $profissionalModel->getResumo_experiencia_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(13, $profissionalModel->getTelefone_pro(), PDO::PARAM_STR);
			$stmt2->bindValue(14, $profissionalModel->getEmail_pro(), PDO::PARAM_STR);
			
			$executa_dois = $stmt2->execute();
            $this->conn = null;
			
            if($executa_um and $executa_dois){   
               
			   return true;
			   
            }else{
				
                return false;    
            }
            
        }catch(Exception $ex) {
			
            echo "Erro: " . $ex->getMessage();
        }       
        
    }
	
	
	
	//Método para validar o login
	public function validaLogin(loginModel $loginModel){
		
		try{
			  $this->conn = new conexao();
			  $query = ("SELECT * FROM logins WHERE login ='".$loginModel->getLogin()."' AND senha = '".$loginModel->getSenha()."'");
			  $stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  return $stmt;
		
		 echo $rows;
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}	
	}
	
	
	//Método para mostrar os dados do cliente quando for editar
	public function mostrarDadosCliente($nomeUsuario){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT c.id_cli,	c.id_login_cli,	c.nome_cli, date_format(c.data_nascimento_cli,'%Y-%m-%d') as data_nascimento_cli, date_format(c.data_cadastro_cli,'%Y-%m-%d') as data_cadastro_cli,	c.endereco_cli,	c.cep_cli,	c.bairro_cli,	c.cidade_cli,	c.estado_cli,	c.telefone_cli,	c.email_cli, l.* FROM clientes c, logins l WHERE c.id_login_cli = l.id_login and l.login = '".$nomeUsuario."' ");
			$stmt = $this->conn->prepare($query);
			 
			$stmt->execute();
			  
			return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	//Método para mostrar os dados do clinte para o Administrador editar de acordo com o seu id
	public function mostrarDadosClienteId($id_cliente){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT c.id_cli,	c.id_login_cli,	c.nome_cli, date_format(c.data_nascimento_cli,'%Y-%m-%d') as data_nascimento_cli, date_format(c.data_cadastro_cli,'%Y-%m-%d') as data_cadastro_cli,	c.endereco_cli,	c.cep_cli,	c.bairro_cli,	c.cidade_cli,	c.estado_cli,	c.telefone_cli,	c.email_cli, l.* FROM clientes c, logins l WHERE c.id_login_cli = l.id_login and c.id_cli = '".$id_cliente."' ");
			$stmt = $this->conn->prepare($query);
			 
			$stmt->execute();
			  
			return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	//Método para o cliente poder atualizar os seus dados 
	public function editarCadastroCliente(loginModel $loginModel, clienteModel $clienteModel){
			
		try{
			
			$this->conn = new conexao();
			
			$stmt = $this->conn->prepare("UPDATE clientes SET nome_cli = ?, data_nascimento_cli = ?, endereco_cli = ?, cep_cli = ?, bairro_cli = ?, cidade_cli = ?, estado_cli = ?, telefone_cli = ?, email_cli = ? where id_login_cli = (SELECT id_login FROM logins WHERE login = ? )");
			
			$stmt->bindValue(1, $clienteModel->getNome_cli(), PDO::PARAM_STR);
			$stmt->bindValue(2, $clienteModel->getData_nascimento_cli(), PDO::PARAM_STR);
			$stmt->bindValue(3, $clienteModel->getEndereco_cli(), PDO::PARAM_STR);
			$stmt->bindValue(4, $clienteModel->getCep_cli(), PDO::PARAM_STR);
			$stmt->bindValue(5, $clienteModel->getBairro_cli(), PDO::PARAM_STR);
			$stmt->bindValue(6, $clienteModel->getCidade_cli(), PDO::PARAM_STR);
			$stmt->bindValue(7, $clienteModel->getEstado_cli(), PDO::PARAM_STR);
			$stmt->bindValue(8, $clienteModel->getTelefone_cli(), PDO::PARAM_STR);
			$stmt->bindValue(9, $clienteModel->getEmail_cli(), PDO::PARAM_STR);
			$stmt->bindValue(10, $loginModel->getLogin(), PDO::PARAM_STR);
			$executa_um = $stmt->execute();
			$executa_dois = true;
			
			if(strlen(trim($loginModel->getSenha()))>0) {
				
				$stmt2 = $this->conn->prepare("UPDATE logins SET senha = ? where login = ? ");
			
				$stmt2->bindValue(1, $loginModel->getSenha(), PDO::PARAM_STR);
				$stmt2->bindValue(2, $loginModel->getLogin(), PDO::PARAM_STR);
				$executa_dois = $stmt2->execute();
			
			}
			
			
			$this->conn = null;
			
            if($executa_um and $executa_dois){   
                return true;
            }  else {
                return false;    
            }
			
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	//Método para o Administrador poder atualizar os dados dos clientes pelo id
	public function editarCadastroClienteId(loginModel $loginModel, clienteModel $clienteModel){
			
		try{
			
			$this->conn = new conexao();
			
			$stmt = $this->conn->prepare("UPDATE clientes SET nome_cli = ?, data_nascimento_cli = ?, endereco_cli = ?, cep_cli = ?, bairro_cli = ?, cidade_cli = ?, estado_cli = ?, telefone_cli = ?, email_cli = ? where id_cli = ? ");
			
			$stmt->bindValue(1, $clienteModel->getNome_cli(), PDO::PARAM_STR);
			$stmt->bindValue(2, $clienteModel->getData_nascimento_cli(), PDO::PARAM_STR);
			$stmt->bindValue(3, $clienteModel->getEndereco_cli(), PDO::PARAM_STR);
			$stmt->bindValue(4, $clienteModel->getCep_cli(), PDO::PARAM_STR);
			$stmt->bindValue(5, $clienteModel->getBairro_cli(), PDO::PARAM_STR);
			$stmt->bindValue(6, $clienteModel->getCidade_cli(), PDO::PARAM_STR);
			$stmt->bindValue(7, $clienteModel->getEstado_cli(), PDO::PARAM_STR);
			$stmt->bindValue(8, $clienteModel->getTelefone_cli(), PDO::PARAM_STR);
			$stmt->bindValue(9, $clienteModel->getEmail_cli(), PDO::PARAM_STR);
			$stmt->bindValue(10, $clienteModel->getId_cli(), PDO::PARAM_STR);
			$executa_um = $stmt->execute();
			$executa_dois = true;
			
			if(strlen(trim($loginModel->getSenha()))>0) {
				
				$stmt2 = $this->conn->prepare("UPDATE logins SET senha = ? where id_login = (SELECT id_login_cli FROM clientes where id_cli = ?) ");
			
				$stmt2->bindValue(1, $loginModel->getSenha(), PDO::PARAM_STR);
				$stmt2->bindValue(2, $clienteModel->getId_cli(), PDO::PARAM_STR);
				$executa_dois = $stmt2->execute();
			
			}
			
			
			$this->conn = null;
			
            if($executa_um and $executa_dois){   
                return true;
            }  else {
                return false;    
            }
			
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	//Método para mostrar os dados do profissional quando ele for editar
	public function mostrarDadosProfissional($nomeUsuario){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT p.id_pro,	p.id_login_pro, p.id_serv_pro, p.nome_pro, p.cpf_pro, date_format(p.data_nascimento_pro,'%Y-%m-%d') as data_nascimento_pro, date_format(p.data_cadastro_pro,'%Y-%m-%d') as data_cadastro_pro, p.escolaridade_pro, p.endereco_pro, p.cep_pro, p.bairro_pro,	p.cidade_pro,	p.estado_pro, p.resumo_experiencia_pro,	p.telefone_pro,	p.email_pro, s.*, l.* FROM profissionais p, servicos s, logins l WHERE p.id_serv_pro = s.id_serv and p.id_login_pro = l.id_login and l.login = '".$nomeUsuario."' ");
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	//Método mostrar os dados dos profissionais pelo id quando o administrador for editar
	public function mostrarDadosProfissionalId($id_profissional){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT p.id_pro,	p.id_login_pro, p.id_serv_pro, p.nome_pro, p.cpf_pro, date_format(p.data_nascimento_pro,'%Y-%m-%d') as data_nascimento_pro, date_format(p.data_cadastro_pro,'%Y-%m-%d') as data_cadastro_pro, p.escolaridade_pro, p.endereco_pro, p.cep_pro, p.bairro_pro,	p.cidade_pro,	p.estado_pro, p.resumo_experiencia_pro,	p.telefone_pro,	p.email_pro, s.*, l.* FROM profissionais p, servicos s, logins l WHERE p.id_serv_pro = s.id_serv and p.id_login_pro = l.id_login and p.id_pro = '".$id_profissional."' ");
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	
	//Método editar cadastro do profsissional - quando o profissional for atualizar seus dados
	public function editarCadastroProfissional(loginModel $loginModel, servicoModel $servicoModel, profissionalModel $profissionalModel){
			
		try{
			$this->conn = new conexao();
			
			$stmt = $this->conn->prepare("UPDATE profissionais SET id_serv_pro = ?, nome_pro = ?, cpf_pro = ?, data_nascimento_pro = ?, escolaridade_pro = ?, endereco_pro = ?, cep_pro = ?, bairro_pro = ?, cidade_pro = ?, estado_pro = ?, resumo_experiencia_pro = ?, telefone_pro = ?, email_pro = ? where id_login_pro = (SELECT id_login FROM logins WHERE login = ? )");
			
			$stmt->bindValue(1, $servicoModel->getId_serv(), PDO::PARAM_STR);
			$stmt->bindValue(2, $profissionalModel->getNome_pro(), PDO::PARAM_STR);
			$stmt->bindValue(3, $profissionalModel->getCpf_pro(), PDO::PARAM_STR);
			$stmt->bindValue(4, $profissionalModel->getData_nascimento_pro(), PDO::PARAM_STR);
			$stmt->bindValue(5, $profissionalModel->getEscolaridade_pro(), PDO::PARAM_STR);
			$stmt->bindValue(6, $profissionalModel->getEndereco_pro(), PDO::PARAM_STR);
			$stmt->bindValue(7, $profissionalModel->getCep_pro(), PDO::PARAM_STR);
			$stmt->bindValue(8, $profissionalModel->getBairro_pro(), PDO::PARAM_STR);
			$stmt->bindValue(9, $profissionalModel->getCidade_pro(), PDO::PARAM_STR);
			$stmt->bindValue(10, $profissionalModel->getEstado_pro(), PDO::PARAM_STR);
			$stmt->bindValue(11, $profissionalModel->getResumo_experiencia_pro(), PDO::PARAM_STR);
			$stmt->bindValue(12, $profissionalModel->getTelefone_pro(), PDO::PARAM_STR);
			$stmt->bindValue(13, $profissionalModel->getEmail_pro(), PDO::PARAM_STR);
			$stmt->bindValue(14, $loginModel->getLogin(), PDO::PARAM_STR);
			$executa_um = $stmt->execute();
			$executa_dois = true;
			
			if(strlen(trim($loginModel->getSenha()))>0)     {
				
				$stmt2 = $this->conn->prepare("UPDATE logins SET    senha = ? where login = ? ");
			
				$stmt2->bindValue(1, $loginModel->getSenha(), PDO::PARAM_STR);
				$stmt2->bindValue(2, $loginModel->getLogin(), PDO::PARAM_STR);
				$executa_dois = $stmt2->execute();
			};
			
            $this->conn = null;
			
            if($executa_um and $executa_dois){   
			
                return true;
            }  else {
                return false;    
            }
			
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	//Método editar cadastro do profsissional pelo id - quando o administrador for atualizar seus dados
	public function editarCadastroProfissionalId(loginModel $loginModel, servicoModel $servicoModel, profissionalModel $profissionalModel){
			
		try{
			$this->conn = new conexao();
			
			$stmt = $this->conn->prepare("UPDATE profissionais SET id_serv_pro = ?, nome_pro = ?, cpf_pro = ?, data_nascimento_pro = ?, escolaridade_pro = ?, endereco_pro = ?, cep_pro = ?, bairro_pro = ?, cidade_pro = ?, estado_pro = ?, resumo_experiencia_pro = ?, telefone_pro = ?, email_pro = ? where id_pro = ?");
			
			$stmt->bindValue(1, $servicoModel->getId_serv(), PDO::PARAM_STR);
			$stmt->bindValue(2, $profissionalModel->getNome_pro(), PDO::PARAM_STR);
			$stmt->bindValue(3, $profissionalModel->getCpf_pro(), PDO::PARAM_STR);
			$stmt->bindValue(4, $profissionalModel->getData_nascimento_pro(), PDO::PARAM_STR);
			$stmt->bindValue(5, $profissionalModel->getEscolaridade_pro(), PDO::PARAM_STR);
			$stmt->bindValue(6, $profissionalModel->getEndereco_pro(), PDO::PARAM_STR);
			$stmt->bindValue(7, $profissionalModel->getCep_pro(), PDO::PARAM_STR);
			$stmt->bindValue(8, $profissionalModel->getBairro_pro(), PDO::PARAM_STR);
			$stmt->bindValue(9, $profissionalModel->getCidade_pro(), PDO::PARAM_STR);
			$stmt->bindValue(10, $profissionalModel->getEstado_pro(), PDO::PARAM_STR);
			$stmt->bindValue(11, $profissionalModel->getResumo_experiencia_pro(), PDO::PARAM_STR);
			$stmt->bindValue(12, $profissionalModel->getTelefone_pro(), PDO::PARAM_STR);
			$stmt->bindValue(13, $profissionalModel->getEmail_pro(), PDO::PARAM_STR);
			$stmt->bindValue(14, $profissionalModel->getId_pro(), PDO::PARAM_STR);
			$executa_um = $stmt->execute();
			$executa_dois = true;
			
			if(strlen(trim($loginModel->getSenha()))>0)     {
				
				$stmt2 = $this->conn->prepare("UPDATE logins SET senha = ? where id_login = (SELECT id_login_pro FROM profissionais where id_pro = ?) ");
			
				$stmt2->bindValue(1, $loginModel->getSenha(), PDO::PARAM_STR);
				$stmt2->bindValue(2, $profissionalModel->getId_pro(), PDO::PARAM_STR);
				$executa_dois = $stmt2->execute();
				
			};
			
            $this->conn = null;
			
            if($executa_um and $executa_dois){   
                return true;
            }  else {
                return false;    
            }
			
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	
	//Mostrar os dados do administrador quando ele for em editar cadastro
	public function mostrarDadosAdministrador($nomeUsuario){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT a.id_adm,	a.id_login_adm,	a.nome_adm,	a.email_adm, l.* FROM administrador a, logins l WHERE a.id_login_adm = l.id_login and l.login = '".$nomeUsuario."' ");
			$stmt = $this->conn->prepare($query);
			 
			$stmt->execute();
			  
			return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	
	//Método editar o cadastro do administrador - quando o administrador for atualizar seus dados 
	public function editarCadastroAdministrador(loginModel $loginModel, administradorModel $administradorModel){
			
		try{
			
			$this->conn = new conexao();
			
			$stmt = $this->conn->prepare("UPDATE administrador SET nome_adm = ?, email_adm = ? where id_login_adm = (SELECT id_login FROM logins WHERE login = ? )");
			
			$stmt->bindValue(1, $administradorModel->getNome_adm(), PDO::PARAM_STR);
			$stmt->bindValue(2, $administradorModel->getEmail_adm(), PDO::PARAM_STR);
			$stmt->bindValue(3, $loginModel->getLogin(), PDO::PARAM_STR);
			$executa_um = $stmt->execute();
			$executa_dois = true;
			
			
			if(strlen(trim($loginModel->getSenha()))>0)     {
				
				$stmt2 = $this->conn->prepare("UPDATE logins SET senha = ? where  login = ? ");
			
				$stmt2->bindValue(1, $loginModel->getSenha(), PDO::PARAM_STR);
				$stmt2->bindValue(2, $loginModel->getLogin(), PDO::PARAM_STR);
				$executa_dois = $stmt2->execute();
				
			}
			
			$this->conn = null;
			
            if($executa_um and $executa_dois){   
                return true;
            }  else {
                return false;    
            }
			
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	//Método para exibir todos os dados dos profissionais para os clientes e profissionais visualizarem
	public function exibirDadosProfissionais(){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT p.id_pro, p.id_login_pro, p.id_serv_pro, p.nome_pro, p.cpf_pro, date_format(p.data_nascimento_pro,'%Y-%m-%d') as data_nascimento_pro, date_format(p.data_cadastro_pro,'%Y-%m-%d') as data_cadastro_pro, p.escolaridade_pro, p.endereco_pro, p.cep_pro, p.bairro_pro, p.cidade_pro, p.estado_pro, p.resumo_experiencia_pro, p.telefone_pro, p.email_pro, s.* FROM profissionais p, servicos s WHERE p.id_serv_pro = s.id_serv ORDER BY s.nome_serv");
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	
	//Método para exibir os dados dos profissionais por profissão
	public function exibirBuscaPorProfissao($cod){
		
		$consulta = "SELECT p.id_pro, p.id_login_pro, p.id_serv_pro, p.nome_pro, p.cpf_pro, date_format(p.data_nascimento_pro,'%Y-%m-%d') as data_nascimento_pro, date_format(p.data_cadastro_pro,'%Y-%m-%d') as data_cadastro_pro, p.escolaridade_pro, p.endereco_pro, p.cep_pro, p.bairro_pro,	p.cidade_pro,	p.estado_pro, p.resumo_experiencia_pro,	p.telefone_pro,	p.email_pro, s.* FROM profissionais p, servicos s WHERE p.id_serv_pro = s.id_serv and s.id_serv = '";
		
			
		$consulta = $consulta.$cod."' ";	
		
		
		try{
			$this->conn = new conexao();
			
			$query = ($consulta);
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}	
	}
	
	
	//Método exibr todos os dados dos clientes para o administrador poder visualizar
	public function exibirDadosClientes(){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT id_cli, id_login_cli, nome_cli, date_format(data_nascimento_cli,'%Y-%m-%d') as data_nascimento_cli, date_format(data_cadastro_cli,'%Y-%m-%d') as data_cadastro_cli, endereco_cli, cep_cli, bairro_cli, cidade_cli, estado_cli, telefone_cli, email_cli FROM clientes  ORDER BY nome_cli ");
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	}
	
	
	//Método verificar se o login já existe quando o cliente ou o profissional forem cadastrar
	public function verificarLoginExistente($loginModel){
		try{
			$this->conn = new conexao();
			$query = ("SELECT login FROM logins where login = '".trim($loginModel->getLogin())."' ");
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			
			return $stmt;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	//PROFISSIONAL CADASTRO - Método verificar se o CPF já existe quando o profissional for cadastrar
	public function verificarCpfProfissional($profissionalModel){
	
		try{
		
			$this->conn = new conexao();
			$query = ("SELECT cpf_pro FROM profissionais where cpf_pro = '".trim($profissionalModel->getCpf_pro())."' ");
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
		
		
			return $stmt;
		
		}catch (Exception $ex){
		
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	//ADMINISTRADOR - Método verificar se além do CPF dele se existe outro cadastro que tenham os mesmos números ao atualizar o CPF
	public function verificarCpfProfissionalDiferente($profissionalModel){
	
		try{
		
			$this->conn = new conexao();
			$query = ("SELECT cpf_pro FROM profissionais where cpf_pro = '".trim($profissionalModel->getCpf_pro())."' and id_pro <> '".trim($profissionalModel->getId_pro())."'");
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
		
		
			return $stmt;
		
		}catch (Exception $ex){
		
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	//NOVOOOOOOOOOOOO 
	//PROFISSIONAL EDITAR  CPF- Metodo que valida o CPF do profissional quando for editar
	public function profVerificaCpfProfissional($profissionalModel, $loginModel){
	
		try{
		
			$this->conn = new conexao();
			$query = ("SELECT cpf_pro FROM profissionais where cpf_pro = '".trim($profissionalModel->getCpf_pro())."' and id_login_pro <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') "); 
			
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
		
		
		
			return $stmt;
		
		}catch (Exception $ex){
		
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	//NOVO PROFISSIONAL EDITA EMAIL 
	public function profVerificaEmailProfissional($profissionalModel, $loginModel){
	
		try{
		
			$this->conn = new conexao();
			$query1 = ("SELECT email_cli FROM clientes where email_cli = '".trim($profissionalModel->getEmail_pro())."' and id_login_cli <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') "); 
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			if (($stmt1 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query2 = ("SELECT email_pro FROM profissionais where email_pro = '".trim($profissionalModel->getEmail_pro())."' and id_login_pro <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') ");
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();
			
			if (($stmt2 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query3 = ("SELECT email_adm FROM administrador where email_adm = '".trim($profissionalModel->getEmail_pro())."' and id_login_adm <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') ");
			$stmt3 = $this->conn->prepare($query3);
			$executa_tres = $stmt3->execute();
			
			if (($stmt3 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
		
		}catch (Exception $ex){
		
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	
	
	
	
	
	// CLIENTE CADASTRO - Método verificar e-mail - O cliente ao cadastrar ele irá ver se o e-mail já existe
	public function verificarEmailDoCliente($clienteModel){
		try{
			
			$this->conn = new conexao();
			$query1 = ("SELECT email_cli FROM clientes where email_cli = '".trim($clienteModel->getEmail_cli())."' ");
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			if (($stmt1->rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
		
			$query2 = ("SELECT email_pro FROM profissionais where email_pro = '".trim($clienteModel->getEmail_cli())."' ");
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();
			
			if (($stmt2 -> rowCount()) > 0){
				
				$this->conn = null;           
				return true;
			}
		
			$query3 = ("SELECT email_adm FROM administrador where email_adm = '".trim($clienteModel->getEmail_cli())."' ");
			$stmt3 = $this->conn->prepare($query3);
			$executa_tres = $stmt3->execute();

			if (($stmt3 -> rowCount()) > 0){
            
				$this->conn = null;
				return true;
			}
			
			$this->conn = null;
            return false;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	
	}
	
	
	//NOVO CLIENTE EDITA EMAIL 
	public function cliVerificaEmailCliente($clienteModel, $loginModel){
	
		try{
		
			$this->conn = new conexao();
			$query1 = ("SELECT email_cli FROM clientes where email_cli = '".trim($clienteModel->getEmail_cli())."' and id_login_cli <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') "); 
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			if (($stmt1 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query2 = ("SELECT email_pro FROM profissionais where email_pro = '".trim($clienteModel->getEmail_cli())."' and id_login_pro <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') ");
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();
			
			if (($stmt2 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query3 = ("SELECT email_adm FROM administrador where email_adm = '".trim($clienteModel->getEmail_cli())."' and id_login_adm <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') ");
			$stmt3 = $this->conn->prepare($query3);
			$executa_tres = $stmt3->execute();
			
			if (($stmt3 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
		
		}catch (Exception $ex){
		
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	
	
	
	// ADMINISTRADOR EDITAR CLIENTE - Método verificar se existe além do e-mail do cliente um outro e-mail igual
	public function verificarEmailDoClienteDiferente($clienteModel){
		try{
			
			
			$this->conn = new conexao();
			$query1 = ("SELECT email_cli FROM clientes where email_cli = '".trim($clienteModel->getEmail_cli())."' and id_cli <> '".trim($clienteModel->getId_cli())."'");
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			if (($stmt1 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query2 = ("SELECT email_pro FROM profissionais where email_pro = '".trim($clienteModel->getEmail_cli())."' and id_login_pro <> (SELECT id_login_cli FROM clientes WHERE id_cli = '".trim($clienteModel->getId_cli())."') ");
			
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();
			
			if (($stmt2 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query3 = ("SELECT email_adm FROM administrador where email_adm = '".trim($clienteModel->getEmail_cli())."' and id_login_adm <> (SELECT id_login_cli FROM clientes WHERE id_cli = '".trim($clienteModel->getId_cli())."') ");
			$stmt3 = $this->conn->prepare($query3);
			$executa_tres = $stmt3->execute();
			
			if (($stmt3 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	
	}
	
	
	
	// PROFISSIONAL CADASTRO - Método verificar e-mail - O profissional ao cadastrar ele irá ver se o e-mail já existe 
	public function verificarEmailDoProfissional($profissionalModel){
		try{
			
			$this->conn = new conexao();
			$query1 = ("SELECT email_cli FROM clientes where email_cli = '".trim($profissionalModel->getEmail_pro())."' ");
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			if (($stmt1 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			$query2 = ("SELECT email_pro FROM profissionais where email_pro = '".trim($profissionalModel->getEmail_pro())."' ");
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();
			
			if (($stmt2 -> rowCount()) > 0){
			
				$this->conn = null;           
				return true;
			}
		
			$query3 = ("SELECT email_adm FROM administrador where email_adm = '".trim($profissionalModel->getEmail_pro())."' ");
			$stmt3 = $this->conn->prepare($query3);
			$executa_tres = $stmt3->execute();

			if (($stmt3 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			$this->conn = null;
			return false;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	
	}
	
	
	
	// ADMINISTRADOR - Método que verifica se existe além do e-mail do profissional um outro e-mail quando o administrador for editar os dados do profissional 
	public function verificarEmailDoProfissionalDiferente($profissionalModel){
		try{
			
			$this->conn = new conexao();
			$query1 = ("SELECT email_cli FROM clientes where email_cli = '".trim($profissionalModel->getEmail_pro())."' and id_login_cli <> (SELECT id_login_pro FROM profissionais WHERE id_pro = '".trim($profissionalModel->getId_pro())."') ");
			
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			if (($stmt1 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query2 = ("SELECT email_pro FROM profissionais where email_pro = '".trim($profissionalModel->getEmail_pro())."' and id_pro <> '".trim($profissionalModel->getId_pro())."'");
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();
			
			if (($stmt2 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query3 = ("SELECT email_adm FROM administrador where email_adm = '".trim($profissionalModel->getEmail_pro())."' and id_login_adm <> (SELECT id_login_pro FROM profissionais WHERE id_pro = '".trim($profissionalModel->getId_pro())."') ");
			
			$stmt3 = $this->conn->prepare($query3);
			$executa_tres = $stmt3->execute();
			
			if (($stmt3 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	
	}
	
	
	
	// ADMINISTRADOR EDITA SEU EMAIL - Método verificar se existe além do e-mail do administrador um outro e-mail igual 
	public function verificarEmailDoAdministrador($administradorModel, $loginModel){
		try{
			
			$this->conn = new conexao();
			$query1 = ("SELECT email_cli FROM clientes where email_cli = '".trim($administradorModel->getEmail_adm())."' and id_login_cli <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') "); 
			
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			if (($stmt1 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query2 = ("SELECT email_pro FROM profissionais where email_pro = '".trim($administradorModel->getEmail_adm())."' and id_login_pro <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') ");
			
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();
			
			if (($stmt2 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
			
			
			$query3 = ("SELECT email_adm FROM administrador where email_adm = '".trim($administradorModel->getEmail_adm())."' and id_login_adm <> (SELECT id_login FROM logins WHERE login = '".trim($loginModel->getLogin())."') ");
			
			$stmt3 = $this->conn->prepare($query3);
			$executa_tres = $stmt3->execute();
			
			if (($stmt3 -> rowCount()) > 0){
				
				$this->conn = null;
				return true;
			}
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	
	}
	
	
	// Método excluir o cadastro do cliente pelo id - Isso quando o administrador for excluir um cliente 
	public function excluirCadastroCliente($idLoginCliente){
		try{
			
			$this->conn = new conexao();
			$query1 = ("DELETE FROM clientes where id_login_cli = ".trim($idLoginCliente));
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			
			$query2 = ("DELETE FROM logins where id_login = '".trim($idLoginCliente)."'  ");
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();

			$this->conn = null;
			
            if($executa_um and $executa_dois){   
                return true;
            }  else {
                return false;    
            }
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	
	}
	
	
	// Método excluir o cadastro do profissional pelo id - Isso quando o administrador for excluir um profissional
	public function excluirCadastroProfissional($idLoginProf){
		try{
			$this->conn = new conexao();
			
			$query1 = ("DELETE FROM profissionais where id_login_pro = ".trim($idLoginProf));
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			
			$query2 = ("DELETE FROM logins where id_login = '".trim($idLoginProf)."' ");
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();

			$this->conn = null;
			
            if($executa_um and $executa_dois){   
                return true;
            }  else {
                return false;    
            }
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
	
	}

	
	//Método exibir no relatório os dados de todos os clientes cadstrados no sistema
	public function relatorioTodosClientes(){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT id_cli, id_login_cli, nome_cli, date_format(data_nascimento_cli,'%Y-%m-%d') as data_nascimento_cli, date_format(data_cadastro_cli,'%Y-%m-%d') as data_cadastro_cli, endereco_cli, cep_cli, bairro_cli, cidade_cli, estado_cli, telefone_cli, email_cli FROM clientes  ORDER BY nome_cli ");
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	//Método exibir no relatório os dados de todos os clientes por Estado cadstrados no sistema
	public function relatorioClientesEstado($estado){
		
		
		$consulta = "SELECT id_cli, id_login_cli, nome_cli, date_format(data_nascimento_cli,'%Y-%m-%d') as data_nascimento_cli, date_format(data_cadastro_cli,'%Y-%m-%d') as data_cadastro_cli, endereco_cli, cep_cli, bairro_cli, cidade_cli, estado_cli, telefone_cli, email_cli FROM clientes WHERE estado_cli =  '";
			
			
		$consulta = $consulta.$estado."' ";	
		
		
		try{
			$this->conn = new conexao();
			
			$query = ($consulta);
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}	
		
	}
	
	
	
	//Método exibir no relatório os dados de todos os profissionais cadstrados no sistema
	public function relatorioTodosProfissionais(){
		
		try{
			$this->conn = new conexao();
			$query = ("SELECT p.id_pro, p.id_login_pro, p.id_serv_pro, p.nome_pro, p.cpf_pro, date_format(p.data_nascimento_pro,'%Y-%m-%d') as data_nascimento_pro, date_format(p.data_cadastro_pro,'%Y-%m-%d') as data_cadastro_pro, p.escolaridade_pro, p.endereco_pro, p.cep_pro, p.bairro_pro, p.cidade_pro, p.estado_pro, p.resumo_experiencia_pro, p.telefone_pro, p.email_pro, s.* FROM profissionais p, servicos s WHERE p.id_serv_pro = s.id_serv ORDER BY s.nome_serv");
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		 echo $rows;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	
	//Método exibir no relatório os dados de todos os profissionais por profissão cadstrados no sistema
	public function relatorioProfissionaisPorProfissao($codP){
		
		$consulta = "SELECT p.id_pro, p.id_login_pro, p.id_serv_pro, p.nome_pro, p.cpf_pro, date_format(p.data_nascimento_pro,'%Y-%m-%d') as data_nascimento_pro, date_format(p.data_cadastro_pro,'%Y-%m-%d') as data_cadastro_pro, p.escolaridade_pro, p.endereco_pro, p.cep_pro, p.bairro_pro,	p.cidade_pro,	p.estado_pro, p.resumo_experiencia_pro,	p.telefone_pro,	p.email_pro, s.* FROM profissionais p, servicos s WHERE p.id_serv_pro = s.id_serv and s.id_serv = '";
		
			
		$consulta = $consulta.$codP."' ";	
		
		
		try{
			$this->conn = new conexao();
			
			$query = ($consulta);
			$stmt = $this->conn->prepare($query);
			 
			  $stmt->execute();
			  
			  return $stmt;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}	
		
	}

	
	//Método que verifica o E-mail -  De acordo com o e-mail digitado pelo usuário ele verificará se e-mail digitado exite para poder enviar o login e a senha por e-mail
	public function verificarEmail($email){
		
		try{
			
			$this->conn = new conexao();
			$query1 = ("SELECT email_cli FROM clientes where email_cli = '".trim($email)."' ");
			$stmt1 = $this->conn->prepare($query1);
			$executa_um = $stmt1->execute();
			
			if (($stmt1 -> rowCount()) > 0){
            $this->conn = null;
			return true;
			}
			
			$query2 = ("SELECT email_pro FROM profissionais where email_pro = '".trim($email)."' ");
			$stmt2 = $this->conn->prepare($query2);
			$executa_dois = $stmt2->execute();
			
			if (($stmt2 -> rowCount()) > 0){
			$this->conn = null;           
			return true;
			}
		
			$query3 = ("SELECT email_adm FROM administrador where email_adm = '".trim($email)."' ");
			$stmt3 = $this->conn->prepare($query3);
			$executa_tres = $stmt3->execute();

			if (($stmt3 -> rowCount()) > 0){
				$this->conn = null;
				return true;
			}
			
			$this->conn = null;
			return false;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	

	
	
	
	//Método que verifica o login -  De acordo com o e-mail digitado pelo usuário ele verificará o login para poder armazenar e enviar por e-mail junto com a senha
	public function verificarLogin($email){
		
		try{
			
			$this->conn = new conexao();
			$query1 = ("select l.login from profissionais p, logins l where p.id_login_pro = l.id_login 
			and p.email_pro = '".trim($email)."' ");
			$stmt1 = $this->conn->prepare($query1);
			$stmt1->execute();
			
			$this->conn = null;
			return $stmt1;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	//NOVOOOOOO
	public function obterLoginCliente($email){
		
		try{
			
			$this->conn = new conexao();
			$query1 = ("select l.login from clientes c, logins l where c.id_login_cli = l.id_login 
			and c.email_cli = '".trim($email)."' ");
			$stmt1 = $this->conn->prepare($query1);
			$stmt1->execute();
			
			$this->conn = null;
			return $stmt1;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	//NOVO Metodo que irá obter o login do profissional para enviar por e-mail  
	public function obterLoginProfissional($email){
		
		try{
			
			$this->conn = new conexao();
			$query1 = ("select l.login from profissionais p, logins l where p.id_login_pro = l.id_login 
			and p.email_pro = '".trim($email)."' ");
			$stmt1 = $this->conn->prepare($query1);
			$stmt1->execute();
			
			$this->conn = null;
			return $stmt1;
		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
	//NOVOOOOOO ATUALIZANDO A SENHA E ENVIAR PARA O EMAIL
	public function atualizaSenha($login, $senha){
		
		try{
			
			
			$this->conn = new conexao();
			$stmt2 = $this->conn->prepare("UPDATE logins SET senha = '".$senha."' where login = '".$login."'");
			
			//$stmt2->bindValue(1, $senha, PDO::PARAM_STR);
			//$stmt2->bindValue(2, $login, PDO::PARAM_STR);
			$executa = $stmt2->execute();
	
            $this->conn = null;
			
            if($executa){   
			
                return true;
				
            }  else {
				
                return false;    
            }

		
		}catch (Exception $ex){
			
			echo "Erro: " . $ex->getMessage();
		}
		
	}
	
	
}