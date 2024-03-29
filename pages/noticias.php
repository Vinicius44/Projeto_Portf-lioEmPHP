<?php
	
	$url = explode("/",$_GET["url"]);
	if(!isset($url[2]))
	{
		
		
		if(isset($url[1])){
			$categorias = Mysql::conectar()->prepare('SELECT * FROM `tb_site.categorias` WHERE slug = ?');//SELECIONAR TODAS DA TABELA NOTICIAS ONDE SLUG FOR IGUAL ?
			
			$categorias->execute(array($url[1]));
			$categorias = $categorias->fetch();
			@define("CATEGORIA", $categorias["nome"]);
			@define("ID", $categorias["id"]);
			@define("CATEGORIASLUG", $categorias["slug"]);
		}

		@define("CATEGORIA", $categorias["nome"]);



	
		


?>

<section class="header-noticias">
	<div class="center">
		<h2><i class="fa-regular fa-bell"></i></h2>
		<h2>Acompanhe as últimas <b>notícias do portal</b></h2>
	</div><!--center-->
</section>


<section class="container-portal">
	<div class="center">
		<div class="sidebar">
			<div class="box-content-sidebar">
				<h3><i class="fa fa-search"></i> Realizar uma busca:</h3>
				<form method="post">
					<input type="text" name="parametro" placeholder="O que deseja procurar?" required>
					<input type="submit" name="buscar" value="Pesquisar">
				</form>
			</div><!--box-content-sidebar-->

			<div class="box-content-sidebar">
				<h3><i class="fa fa-list-ul" aria-hidden="true"></i> Selecione a categoria:</h3>
				<form>
					<select>
						<option value="" disabled selected="">Todas as categorias</option>
						<?php

							$categorias = Mysql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY order_id ASC");
							$categorias->execute();
							$categorias = $categorias->fetchAll();

							foreach($categorias as $key => $value){

						?>
						<option <?php if($value["slug"] == @$url[1]) echo "selected";?> value="<?php echo $value["slug"] ?>"><?php  echo $value["nome"]?></option>
						

						<?php

							}

						 ?>
					</select>
				</form>
			</div><!--box-content-sidebar-->

			<div class="box-content-sidebar">
				<h3><i class="fa fa-square" aria-hidden="true"></i> Sobre o autor:</h3>
				<div class="autor-box-portal">
					<div class="box-img-autor"></div>
					
					<div class="texto-autor-portal text-center">
						<?php

							$infoSite = Mysql::conectar()->prepare("SELECT * FROM `tb_site.config` ");
							$infoSite->execute();
							$infoSite = $infoSite->fetch();
						?>
						<h3><?php echo $infoSite["nome"]?></h3>
						<p><?php echo substr($infoSite["descricao"], 0, 300)."..." ?></p>

					</div><!--texto-autor-portal-->
				
				</div><!--autor-box-portal-->
			</div><!--box-content-sidebar-->
		</div><!--sidebar-->


		


		<div class="conteudo-portal">
			<div class="header-conteudo-portal">
				<?php

					$porPagina = 10;
					
					if(isset($url[1])){

						if(CATEGORIA == ""){
							
								echo "<h2>Visualizando todos os Posts</h2>";
							
						}else{
							echo "<h2>Visualizando Posts em <span>".CATEGORIA."</span></h2>";
							
						}
					}


					$query = "SELECT * FROM `tb_site.noticias`"; 

					if(isset($url[1])){

						if(CATEGORIA != ""){
							
							//ID = (int)ID;
							
							$query.= "WHERE categoria_id = ".ID;
								
						}
					}

					if(isset($_POST["parametro"])){
						if(strstr($query, "WHERE") !== false){
							$busca = $_POST["parametro"];
							$query.= " AND titulo LIKE '%$busca%'";
						}else{
							$busca = $_POST["parametro"];
							$query.= " WHERE titulo LIKE '%$busca%'";
						}
					}

					$query2 = "SELECT * FROM `tb_site.noticias`";

					if(CATEGORIA != ""){

						$query2.="WHERE categoria_id = ".ID;
					}

					if(isset($_POST["parametro"])){
						if(strstr($query2, "WHERE") !== false){
							$busca = $_POST["parametro"];
							$query2.= " AND titulo LIKE '%$busca%'";
						}else{
							$busca = $_POST["parametro"];
							$query2.= " WHERE titulo LIKE '%$busca%'";
						}
					}

					$totalPaginas = Mysql::conectar()->prepare($query2);
					$totalPaginas->execute();
					$totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);

					if(isset($_GET["pagina"])){
						
						$pagina = (int)$_GET["pagina"];
						if($pagina > $totalPaginas){
							$pagina = 1;
						}
						$queryPg = ($pagina - 1) * $porPagina;
						$query2.=" ORDER BY id DESC LIMIT $queryPg, $porPagina";
					}else{
						$pagina = 1;
						$query2.=" ORDER BY id ASC LIMIT 0,$porPagina";
					}
					

					$sql = Mysql::conectar()->prepare($query2);
					$sql->execute();
					$noticias = $sql->fetchAll();



				?>
				
				
			</div><!--header-conteudo-portal-->

			<?php

				foreach ($noticias as $key => $value) {
					$sql = Mysql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ? ");
					$sql->execute(array($value["categoria_id"]));
					$categoriaNome = $sql->fetch()["slug"];
			?>

			<div class="box-single-conteudo">
				<h2><?php echo date("d/m/Y",strtotime($value["data"]))?> - <?php echo $value["titulo"]?></h2>
				<p><?php echo substr(strip_tags($value["conteudo"]), 0, 400)."..."; ?></p>
				<a href="<?php echo INCLUDE_PATH; ?>noticias/<?php echo $categoriaNome; ?>/<?php echo $value["slug"]; ?>">Leia mais</a>
			</div><!--box-single-conteudo-->
		<?php } ?>


		<?php  

			
			


		?>



		<div class="paginator">
			
			
			<?php

				for($i = 1; $i <= $totalPaginas; $i++ ){
					$catStr = (CATEGORIA != "") ? "/".CATEGORIASLUG : "";
					if($pagina == $i){
						
						echo "<a class='active-page' href='".INCLUDE_PATH."noticias".$catStr."?pagina=".$i."'>".$i."</a>";		
					}else{
						echo "<a href='".INCLUDE_PATH."noticias".$catStr."?pagina=".$i."'>".$i."</a>";	
					}
					
				}


			?>

		</div><!--paginator-->
		</div><!--conteudo-portal-->

		<div class="clear"></div>
	</div><!--center-->
</section><!--container-portal-->


<?php }else{


	include("noticia_single.php");

} ?>

