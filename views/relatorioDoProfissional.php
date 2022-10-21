
<?php

	require_once("../controllers/profissionalController.php");
	require_once("../Model/cadastroProfissionalModel.php");
	require_once("../Model/profissionalModel.php");
	require_once("../Model/servicoModel.php");
	require_once("../Model/loginModel.php");
	
	//session_start();
	$validar = $_SESSION["nomeUsuario"];

	
	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";
	
	if (empty($validar)){
		
		header("Location:../index.php");
		
	}else{
		
			if (isset($_SESSION['listaRelatorioProfissionais'])){
				
				$listaRelProfissionais = $_SESSION['listaRelatorioProfissionais'];
				if (sizeof($listaRelProfissionais)==0){$teste = 'Nenhum registro encontrado!';
				
				
				}else{
					$teste = '';
				};
				unset($_SESSION['listaRelatorioProfissionais']);
				
				
			}else{
			$teste = '';
			$profissionalController = new profissionalController();
			$listaRelProfissionais = $profissionalController->relatorioTodosProfissionais();
			}
		}
		
		
		
	

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	 <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
	    <link href="../views/bootstrap/css/estilo.css" rel="stylesheet">


</head>
 	<p class='center sub-titulo'><p>

	 <fieldset>
	
	 
						<h1>Relatório dos Profissionais Cadastrados </h1>
						
	 	                <p>____________________________________________________________________________________</p>
									<center><?php echo $teste; ?></center>
<?php 								
									$cont = 1;

									foreach($listaRelProfissionais as $itemLista){
							
										$cont++;
										echo "<strong>Serviço: </strong>".$itemLista->getServicoModel()->getNome_serv()."</p>" ;
									    echo "<strong>Nome: </strong>".$itemLista->getProfissionalModel()->getNome_pro()."</p>";		
										echo "<strong>CPF: </strong>".$itemLista->getProfissionalModel()->getCpf_pro()."</p>";	
										echo "<strong>Data de Nascimento: </strong>".$itemLista->getProfissionalModel()->getData_nascimento_pro()."</p>";	
										echo "<strong>Data de Cadastro: </strong>".$itemLista->getProfissionalModel()->getData_cadastro_pro()."</p>";
										echo "<strong>Escolaridade: </strong>".$itemLista->getProfissionalModel()->getEscolaridade_pro()."</p>";
										echo "<strong>Endereço: </strong>".$itemLista->getProfissionalModel()->getEndereco_pro()."</p>";
										echo "<strong>CEP: </strong>".$itemLista->getProfissionalModel()->getCep_pro()."</p>";
										echo "<strong>Bairro: </strong>".$itemLista->getProfissionalModel()->getBairro_pro()."</p>";
										echo "<strong>Cidade: </strong>".$itemLista->getProfissionalModel()->getCidade_pro()."</p> ";
										echo "<strong>Estado: </strong>".$itemLista->getProfissionalModel()->getEstado_pro()."</p>";
										echo "<strong>Experiência: </strong> ".$itemLista->getProfissionalModel()->getResumo_experiencia_pro()."</p>";
										echo "<strong>Telefone: </strong>".$itemLista->getProfissionalModel()->getTelefone_pro()."</p>";
										echo "<strong>E-mail: </strong>".$itemLista->getProfissionalModel()->getEmail_pro()."</p>";
								        echo"<p>...........................................................................................................................................................................</p>";
									}?>	
									
									<button   class='btn btn-lg btn-primary btn-block' type='submit' >
									<img  src="../imagens/impressora.png" width="32" height="32"  onclick="javascript:window.print();"></button>

 </fieldset>

			
					
	
					
					
			



</html>	