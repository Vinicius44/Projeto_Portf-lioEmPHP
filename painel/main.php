<?php
	if(isset($_GET['loggout'])){
		Painel::loggout();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Painel de Controle</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Fonts-->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
	<!---->                                   
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
	<link href="<?php echo INCLUDE_PATH;?>estilo/all.css" rel="stylesheet">
</head>
<body>


<div class="menu">
	<div class="menu-wraper">
	<div class="box-usuario">

		<?php

			if($_SESSION["img"] == ""){

		?>


		<div class="avatar-usuario">
			<i class="fa fa-user"></i>
		</div><!--avatar-usuario-->

		<?php }else{ ?>

		<div class="imagem-usuario">
			<img src='<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION["img"]; ?>' />
		</div><!--avatar-usuario-->

		<?php } ?>

		<div class="nome-usuario">
			<p><?php echo $_SESSION["nome"]; ?></p>
			<p><?php echo pegaCargo($_SESSION["cargo"]);?></p>
		</div><!--nome-usuario-->
	</div><!--box-usuario-->

	<div class="itens-menu">
		<h2>Cadastro</h2>
		
		<a <?php selecionadoMenu("cadastro-depoimento");?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastro-depoimento">Cadastrar Depoimento</a>
		<a <?php selecionadoMenu("cadastrar-servico");?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastro-servico">Cadastrar Serviço</a>
		<a <?php selecionadoMenu("cadastrar-slides");?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastro-slides">Cadastrar Slides</a>
		<h2>Gestão</h2>
		<a <?php selecionadoMenu("listar-depoimentos");?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-depoimentos">Listar Depoimentos</a>
		<a <?php selecionadoMenu("listar-servicos");?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-servicos">Listar Serviços</a>
		<a <?php selecionadoMenu("listar-slides");?> href="<?php echo INCLUDE_PATH_PAINEL?>listar-slides">Listar Slides</a>
		<h2>Administração do painel</h2>
		<a <?php selecionadoMenu("editar-usuario");?> href="<?php echo INCLUDE_PATH_PAINEL?>editar-usuario">Editar Usuário</a>
		<a <?php selecionadoMenu("adicionar-usuario");?> <?php verificaPermissaoMenu(2);?> href="<?php echo INCLUDE_PATH_PAINEL?>adicionar-usuario">Adicionar Usuários</a>
		<h2>Configuração Geral</h2>
		<a <?php selecionadoMenu("editar-site");?> href="<?php echo INCLUDE_PATH_PAINEL?>editar-site">Editar Site</a>
		<h2>Gestão de Notícias</h2>
		<a <?php selecionadoMenu("cadastro-categorias");?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastro-categorias">Cadastrar Categorias</a>
		<a <?php selecionadoMenu("gerenciar-categorias");?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-categorias">Gerenciar Categorias</a>
		<a <?php selecionadoMenu("cadastro-noticias");?> href="<?php echo INCLUDE_PATH_PAINEL?>cadastro-noticias">Cadastrar Notícias</a>
		<a <?php selecionadoMenu("gerenciar-noticias");?> href="<?php echo INCLUDE_PATH_PAINEL?>gerenciar-noticias">Gerenciar Notícias</a>
	</div><!--itens-menu-->

</div><!--menu-wraper-->
</div><!--menu-->
	<header>
		<div class="center">
			<div class="menu-btn">
				<i class="fa fa-bars"></i>
			</div><!--menu-btn-->



			<div class="center">
				<div class="loggout">
					
					<a <?php if(@$_GET["url"] == ""){ ?>style="background: #68727a; padding: 10px 15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa fa-home"></i><span> Página Inicial</span></a>
					<a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"><i class="fa fa-window-close"></i><span> Sair</span></a>
				</div><!--loggout-->
			</div><!--center-->


			<div class="clear"></div>
		</div><!--center-->
	</header>
<div class="content">
	
	
	<?php Painel::carregarPagina();?>

	

</div><!--content-->


<script type="text/javascript" src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL?>js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL?>js/main.js"></script>
<script src="https://cdn.tiny.cloud/1/ltn5cqnmnoy52w8zjqaaf49lyg1j27mu3x7b8ciupxsm2cxy/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
	tinymce.init({
		selector: '.tinymce',
		//plugins: 'image',

	});
</script>
</body>
</html>