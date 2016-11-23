<?php include_once("conexao.php") ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Escola do futuro</title>

	<link rel="stylesheet"  href="../css/bootstrap.css">
	<link rel="stylesheet"  href="../css/bootstrap-theme.css">
</head>
<body style="background-color:white">

<?php 
	session_start();
	if(isset ($_SESSION["login"])){
		$login = $_SESSION["login"];
		$cod = $_SESSION["cod"];
		$nome = $_SESSION["nome"];
		$tipo = $_SESSION["tipo"];
		}
?>
<div>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a href="../Home/index.php" class="navbar-brand"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> HOME</a>
					</li>
					<?php 
					if( isset($_SESSION["login"]) && ($tipo == "funcionario") ){ 
					?>
						<li>
							<li class="dropdown">
					        	<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastro <span class="caret"></span></a>
					         	<ul class="dropdown-menu">
					            <li><a href="../Usuario/cadProf.php">Professor</a></li>
					            <li><a href="../Usuario/cadAlun.php">Aluno</a></li>
					     
					          </ul>
					        </li>
						</li>
					<?php 
					} 
					?>
					<?php 
					if( isset($_SESSION["login"]) ){ 
					?>
						<li>
							<li class="dropdown">
					        	<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projeto <span class="caret"></span></a>
					         	<ul class="dropdown-menu">
					         	<?php if( $_SESSION["tipo"] == "gestor" ){ ?>
					         	<li><a href="../Projeto/cadastroProjeto.php">Cadastrar</a></li>
					         	<?php } ?>
					            <li><a href="../Projeto/busProjCan.php">Consultar</a></li>
					            <?php if( $_SESSION["tipo"] == "gestor" ){ ?>
					         	<li><a href="../Projeto/busProjFin.php">Finalizar</a></li>
					         	<?php } ?>
					          </ul>
					        </li>
						</li>
					<?php 
					} 
					?>
					<?php 
					if( isset($_SESSION["login"])  ){ 
					?>
						<li>
							<li class="dropdown">
					        	<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Criterio Avaliação <span class="caret"></span></a>
					         	<ul class="dropdown-menu">
					         	<li><a href="../criterio/cadastroCriterio.php">Cadastrar</a></li>
					            <li><a href="../criterio/buscarCriterio.php">Consultar</a></li>
					          </ul>
					        </li>
						</li>
					<?php 
					} 
					?>
					<?php 
					if( isset($_SESSION["login"])){ 
					?>
						<li>
							<li class="dropdown">
					        	<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatório <span class="caret"></span></a>
					         	<ul class="dropdown-menu">
					            <li><a href="../Relatorio/projetosCategoria.php">Projetos por Categoria</a></li>
					            <li><a href="../Relatorio/buscarProjetoAprovado.php">Investimentos Financeiros</a></li>
					          </ul>
					        </li>
						</li>
					<?php 
					} 
					?>
				</ul>
				<form class="navbar-form navbar-left" method="POST" action="../Projeto/busProjApr.php">
			        <div class="form-group">
			          	<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
							<input type="text" class="form-control" name="nome" placeholder="Buscar Projetos" aria-describedby="basic-addon1">
						</div>
			        </div>
			        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar</button>
			     </form>				
				<ul class="nav navbar-nav navbar-right">
					<?php if( ! isset($_SESSION["login"])){ ?>
					<li>
						<a href="../Usuario/loginUsuario.php"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Entrar</a>
					</li>
					<?php }else{ ?>
					<li>
						<a href="../Usuario/dadosUsuario.php?cpf=<?php echo $cpf ?>" class="text-capitalize"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $login ?></a> 
					</li>
					<li>
						<a href="../sair.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair</a>
					</li>
					<?php } ?>
				</ul>				
			</div>
		</div>
	</nav>
</div>

<div class="container">
	<div class="col-md-10 col-md-offset-1" style="background-color:white">
	
	


	

