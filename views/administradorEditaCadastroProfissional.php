
<?php

	require_once("../controllers/profissionalController.php");
	require_once("../Model/cadastroProfissionalModel.php");
	require_once("../Model/profissionalModel.php");
	require_once("../Model/servicoModel.php");
	require_once("../Model/loginModel.php");

	//***********session_start();
	$validar = $_SESSION["nomeUsuario"];
	

	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";
	
	if (empty($validar)){
		
		header("Location:../index.php");
		
	}else{
		
		$id_profissional = $_GET['id'];
		$_SESSION["id_profissionalEdita"] = $id_profissional;
		
		$profissionalController = new profissionalController();
		$cadastroProfissionalModel = $profissionalController->mostrarDadosProfissionalId($id_profissional);
		
		$profissionalModel = new profissionalModel();
		$servicoModel = new servicoModel();
		$loginModel = new loginModel();
		
		$profissionalModel = $cadastroProfissionalModel->getProfissionalModel();
		$servicoModel = $cadastroProfissionalModel->getServicoModel();
		$loginModel = $cadastroProfissionalModel->getLoginModel();
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

		<title>Bem vindo ao site - Construção civil - Em buscas de Profissionais</title>

		<!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
		<link href="../views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../views/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<link href="../views/bootstrap/css/signin.css" rel="stylesheet">
		<link href="../views/bootstrap/css/default.min.css" rel="stylesheet"> 

		<!-- Custom CSS --> 
		<link href="../views/bootstrap/css/freelancer.css" rel="stylesheet">
	
		<!-- jQuery Função: após minimizar o site. O menu é exibido através de um botão na parte superior à direita do site. -->
		<script src="../views/bootstrap/js/jquery.js"></script>
		<script src="../views/bootstrap/js/jquery-1.5.2.min.js"></script>
		<script src="../views/bootstrap/js/jquery.maskedinput-1.3.min.js"></script>

		<script>
			jQuery(function($){
				//$("#data").mask("99/99/9999");
				$("#cpf").mask("999.999.999-99");
				$("#campoTelefone").mask("(99) 99999999?9")
				.live('focusout', function (event) {
					var target, phone, element;
					target = (event.currentTarget) ? event.currentTarget : event.srcElement;
					phone = target.value.replace(/\D/g, '');
					element = $(target);
					element.unmask();
				
					if(phone.length > 10) {
						element.mask("(99) 99999-999?9");
					} else {
						element.mask("(99) 9999-9999?9");
					}
				});

				$("#cep").mask("99999-999");
			}); 
		</script>
		
		
		
		<script>
			function validarCPF( cpf ){
				var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
	
				if(!filtro.test(cpf))
				{
					window.alert("CPF inválido. Tente novamente.");
					return false;
				}
   
				cpf = remove(cpf, ".");
				cpf = remove(cpf, "-");
	
				if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
				cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
				cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
				cpf == "88888888888" || cpf == "99999999999")
				{
					window.alert("CPF inválido. Tente novamente.");
					return false;
				}

				soma = 0;
				for(i = 0; i < 9; i++)
				{
					soma += parseInt(cpf.charAt(i)) * (10 - i);
				}
	
				resto = 11 - (soma % 11);
				if(resto == 10 || resto == 11)
				{
					resto = 0;
				}
				if(resto != parseInt(cpf.charAt(9))){
					window.alert("CPF inválido. Tente novamente.");
					return false;
				}
	
				soma = 0;
				for(i = 0; i < 10; i ++)
				{
					soma += parseInt(cpf.charAt(i)) * (11 - i);
				}
				
				resto = 11 - (soma % 11);
				if(resto == 10 || resto == 11)
				{
					resto = 0;
				}
	
				if(resto != parseInt(cpf.charAt(10))){
					window.alert("CPF inválido. Tente novamente.");
					return false;
				}
	
				return true;
			}
 
			function remove(str, sub) {
				i = str.indexOf(sub);
				r = "";
				if (i == -1) return str;
				{
					r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
				}
	
				return r;
			}

			/**
			* MASCARA ( mascara(o,f) e execmascara() ) CRIADAS POR ELCIO LUIZ
			* elcio.com.br
			*/
			function mascara(o,f){
				v_obj=o
				v_fun=f
				setTimeout("execmascara()",1)
			}

			function execmascara(){
				v_obj.value=v_fun(v_obj.value)
			}

			function cpf_mask(v){
				v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
				v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
				v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
				v=v.replace(/(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
				return v
			}
		</script>
		
		
		
		
 
		<!-- Bootstrap Core JavaScript -->
		<script src="../views/bootstrap/js/bootstrap.min.js"></script>
		<script src="../views/bootstrap/js/ie-emulation-modes-warning.js"></script>
			
		<!-- Custom Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

	</head>


	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			
			<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header page-scroll">
		       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					
					<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		       </button>
		          
					<a class="navbar-brand" href="../index.php"><b>CLICWORKS<b/> <br/>
					<p>Buscas de Profissionais de construção civil<p/></a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		            
				<ul class="nav navbar-nav navbar-right">
		             
		            <li class="page-scroll">
					
						<a href="../views/areaAdministradorProfissionais.php">Retornar aos dados dos Profissionais</a>
						
		            </li> 
		        </ul>	
		    </div>
		   
		<!-- /.navbar-collapse -->
		</div>
		
	<!-- /.container-fluid -->
	</nav>

	
	<div class="container" >
		
		<div>
		
			<br><br><br><br>
		
			<h5>Área Restrita do profissional / Editar Cadastro</h5>
			<h6> <?php echo "Seja bem-vindo(a) ". $validar;?> </h6> 
			
			</br><p><center style="color:red;">
				<?php
					if(isset($_SESSION['cpfProJaCadastrado'])){
						echo $_SESSION['cpfProJaCadastrado'];
						unset ($_SESSION['cpfProJaCadastrado']);
					}
				?>
				
				</center></p>
				
				<p><center style="color:red;">
				<?php
					if(isset($_SESSION['EmailProJaCadastrado'])){
						echo $_SESSION['EmailProJaCadastrado'];
						unset ($_SESSION['EmailProJaCadastrado']);
					}
				?>
				
				</center></p>
					<p><center style="color:ciano;">
						<?php
							if(isset($_SESSION['atualizacaoProfissional'])){
								echo $_SESSION['atualizacaoProfissional'];
								unset ($_SESSION['atualizacaoProfissional']);
							}
						?>
					</center></p>
					</br>
					
			<p style="font-size: 12px;">* Campos obrigatórios</p>
			</br>
				
			
		</div>
	
	
		
		<form method="POST" action="../controllers/profissionalController.php">
			<div  class="col-sm-4 form-group">
			
				<label for="nome">Nome Completo*</label><br>
				<input class="form-control"  type="text" name="editar_nome_pro" size="35" value="<?php echo $profissionalModel->getNome_pro();?>" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Nome Completo" required autofocus>
				</br>
				
				<label for="cpf">CPF*</label><br>
				<input class="form-control"  type="text" name="editar_cpf_pro" id="cpf" value="<?php echo $profissionalModel->getCpf_pro();?>" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" required autofocus>
				</br>
				
				<label 	 for="data_de_nascimento">Data de Nascimento*</label><br>
				<input  class="form-control"  type="date" name="editar_data_pro"  value="<?php echo $profissionalModel->getData_nascimento_pro();?>" id="data" width="10%" required autofocus>
				</br>
				
				<label  for="escolaridade" > Escolaridade*</label><br>
					<select class="form-control" name="editar_escolaridade_pro" id="txt_plataforma" required autofocus>
						<option value="<?php echo $profissionalModel->getEscolaridade_pro();?>"> <?php echo $profissionalModel->getEscolaridade_pro();?></option>
						<option value="Ensino fundamental incompleto">Ensino fundamental incompleto</option>
						<option value="Ensino fundamental completo">Ensino fundamental completo</option>
						<option value="Ensino medio incompleto">Ensino medio incompleto</option>
						<option value="Ensino medio completo">Ensino medio completo</option>
						<option value="Ensino superior incompleto">Ensino superior incompleto</option>
						<option value="Ensino superior completo">Ensino superior completo</option>
						
					</select>
				</br>
				
				<label  for="endereco" > Endereço*</label><br>
				<input  class="form-control" type="text" name="editar_endereco_pro" value="<?php echo $profissionalModel->getEndereco_pro();?>" size="25" pattern="[aA-zZ0-9çÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ.:ºª-\s]+$" placeholder="Endereço" required autofocus>
				</br>
				
				<label for="cep">CEP*</label><br>
				<input  class="form-control" type="text" name="editar_cep_pro" id="cep" value="<?php echo $profissionalModel->getCep_pro();?>"  size="25" placeholder="00000-000" required autofocus>
				</br>
				
				<label for="bairro">Bairro*</label><br>
				<input   class="form-control" type="text" name="editar_bairro_pro" value="<?php echo $profissionalModel->getBairro_pro();?>" size="25" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Nome do bairro" required autofocus>
				</br>
				
				<label for="profissao">Cidade*</label><br>
				<input  class="form-control" type="text" name="editar_cidade_pro" value="<?php echo $profissionalModel->getCidade_pro();?>" size="25"  pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Nome da cidade" required autofocus>
				</br>
				
				<label for="inputCadastro" class="sr-only">Estado</label>ESTADO*
								<select class="form-control" name="editar_estado_pro" id="txt_plataforma" required autofocus>
									<option value="<?php echo $profissionalModel->getEstado_pro();?>"> <?php echo $profissionalModel->getEstado_pro();?></option>
									<option value="Acre">Acre</option>
									<option value="Alagoas">Alagoas</option>
									<option value="Amapá">Amapá</option>
									<option value="Amazonas">Amazonas</option>
									<option value="Bahia">Bahia</option>
									<option value="Ceará">Ceará</option>
									<option value="Distrito Federal">Distrito Federal</option>
									<option value="Espírito Santo">Espírito Santo</option>
									<option value="Goiás">Goiás</option>
									<option value="Maranhão">Maranhão</option>
									<option value="Mato Grosso">Mato Grosso</option>
									<option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
									<option value="Minas Gerais">Minas Gerais</option>
									<option value="Pará">Pará</option>
									<option value="Paraíba">Paraíba</option>
									<option value="Paraná">Paraná</option>
									<option value="Pernambuco">Pernambuco</option>
									<option value="Piauí">Piauí</option>
									<option value="Rio de Janeiro">Rio de Janeiro</option>
									<option value="Rio Grande do Norte">Rio Grande do Norte</option>
									<option value="Rio Grande do Sul">Rio Grande do Sul</option>
									<option value="Rondônia">Rondônia</option>
									<option value="Roraima">Roraima</option>
									<option value="Santa Catarina">Santa Catarina</option>
									<option value="São Paulo">São Paulo</option>
									<option value="Sergipe">Sergipe</option>
									<option value="Tocantins">Tocantins</option>
								
								</select>
								<br/>
				
			</div>            
	
		
			<div  class="col-sm-4 form-group">
			
				<label for="profissao">Profissão*</label><br>
					<select class="form-control" name="editar_profissao_pro" id="txt_plataforma" required autofocus>
						<option value="<?php echo $profissionalModel->getId_serv_pro();?>"> <?php echo $servicoModel->getNome_serv();?></option>
						<option value="1">Ajudante</option>
						<option value="2">Arquiteto</option>
						<option value="3">Calheiro</option>
						<option value="4">Carpinteiro</option>
						<option value="5">Desenhista</option>
						<option value="6">Eletricista</option>
						<option value="7">Encanador</option>
						<option value="8">Gesseiro</option>
						<option value="9">Marceneiro</option>
						<option value="10">Pedreiro</option>
						<option value="11">Pintor</option>
						<option value="12">Projetista</option>
						<option value="13">Serralheiro</option>
						<option value="14">Telhadista</option>
						<option value="15">Vidraceiro</option>
						<option value="16">Outros</option>
					
					</select>																
				<br/></br>
				
				
				<label for="inputCadastro" class="sr-only">Experiência profissional</label>EXPERIENCIA PROFISSIONAL* <br/><span id="cont">(No máximo 85 caracteres)</span>
				<textarea name="editar_experiencia_pro" class="form-control" onkeyup="blocTexto(this.value)"  id="texto"  cols="35" rows ="10" tabindex="2" pattern="[aA-zZ0-9çÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ.-_,:;!ªº\s]+$" placeholder="Digite aqui a experiência de sua profissão" required autofocus><?php echo $profissionalModel->getResumo_experiencia_pro();?></textarea>
				<br/><br/>
				
				
				<label for="telefone">Telefone*</label><br>
				<input  class="form-control" type="text" name="editar_telefone_pro" id="campoTelefone"  value="<?php echo $profissionalModel->getTelefone_pro();?>"  placeholder="(_) 0000-0000" required autofocus>
				</br>
				
				<label for="email">E-mail*</label><br>
				<input  class="form-control" type="email" name="editar_email_pro" size="35"  value="<?php echo $profissionalModel->getEmail_pro();?>" pattern="[a-zA-Z0-9._%+-wWyYkK]+@[a-zA-Z0-9.-wWyYkK]+\.[a-zA-ZwWyYkK]{2,4}$" placeholder="exemplo@email.com" required autofocus>
				</br>
				
				<label for="senha">Nova Senha  - (CASO QUEIRA TROCAR A SENHA) </label><br>
				<input  class="form-control" type="password" name="editar_senha_pro" size="25" placeholder="***********" >
		
				</br>
				<button class="btn btn-primary" type="submit">Salvar</button>
				<input type="hidden" name="acao" id="acao" value="editarCadastroProfissionalId">
				
			</div>
		
		</form>
		
		<div  class="col-sm-4 form-group">
			<h2 class="form-signin-heading text-center"><img alt= class="img-responsive" center src="..\imagens\foto_editar.jpg	" width="390px" height="390px"> </h2>
		</div>
	
	</div>
</html>
