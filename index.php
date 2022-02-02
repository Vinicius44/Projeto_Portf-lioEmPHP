<?php include("config.php"); ?>
<?php Site::updateUsuarioOnline();?>
<?php Site::contador();?>
<!DOCTYPE html>
<html>
<head>
	<title>Projeto 01</title>
	

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">

	<link href="<?php echo INCLUDE_PATH;?>estilo/all.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH;?>estilo/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
	<meta charset="utf-8">
</head>
<body>

<base base="<?php echo INCLUDE_PATH;?>"/>

	<?php

		$url = isset($_GET["url"]) ? $_GET["url"] : "home";

		switch ($url){
			case 'depoimentos':
				echo '<target target="depoimentos" />';
				break;

			case 'servicos':
				echo '<target target="servicos" />';
				break;
			
		}


	?>


	<div class="sucesso">
		Formulário enviado com sucesso!
	</div>

	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH?>Imagens/ajax-loader.gif">
	</div><!--overlay-loading-->

	<header>
		<div class="center">

		<div class="logo left"><a href="">Logomarca</a></div>

		<nav class="desktop right">
			<ul>
				<li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
				<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
				<li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
				<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
			</ul>
		</nav>

		<nav class="mobile right">
			<div class="botao-menu-mobile">
				<i class="fas fa-ellipsis-h"></i>
			</div>
			<ul>
				<li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
				<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
				<li><a href="<?php echo INCLUDE_PATH;?>servicos">Servicos</a></li>
				<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
			</ul>
		</nav>
		<div class="clear"></div>
		</div><!--center-->

	</header>


	<div class="container-principal">
	<?php

		

		if(file_exists("pages/".$url.".php")){
			include("pages/".$url.".php");
		}else{
			if($url != 'depoimentos' && $url != 'servicos'){
				$pagina404 = true;
				include("pages/404.php");
			}else{
				include("pages/home.php");
			}
		}

	?>
	</div><!--container-principal-->


	<footer <?php if(isset($pagina404) && ($pagina404 == true)) echo 'class="fixed"'; ?>>
		<div class="center">
		<p>Todos os direitos reservados</p>
		</div><!--center=-->
	</footer>

	<script src="<?php echo INCLUDE_PATH;?>js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	
	<script src="<?php echo INCLUDE_PATH;?>js/scripts.js" type="text/javascript"></script>
	<?php

		if($url == "contato"){
	?>
	<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAscNI4gbAA24lU555Jd0ewdEtw_E4WJEM" type="text/javascript"></script>
	<script src="<?php echo INCLUDE_PATH;?>js/map.js" type="text/javascript"></script>

	<?php }?>

	<script src="<?php echo INCLUDE_PATH;?>js/formularios.js" type="text/javascript"></script>

</body>
</html>