<?php
		
		if(isset($_GET["excluir"])){
			$idExcluir = (int)$_GET["excluir"];
			Painel::deletar('tb_site.categorias', $idExcluir);
			$noticias = Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE categoria_id = ?");
			$noticias->execute(array($idExcluir));
			$noticias = $noticias->fetchAll();
			foreach ($noticias as $key => $value) {
				$imgDelete = $value["capa"];
				Painel::deleteFile($imgDelete);
			}

			$noticias = Mysql::conectar()->prepare("DELETE FROM `tb_site.noticias` WHERE categoria_id = ?");
			$noticias->execute(array($idExcluir));

			Painel::redirect(INCLUDE_PATH_PAINEL."gerenciar-categorias");
		}else if(isset($_GET["order"]) && $_GET["id"]){
			Painel::orderItem("tb_site.categorias", $_GET["order"], $_GET["id"]);
		}

		
		$paginaAtual = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
		$porPagina = 3;
		
		$categorias = Painel::selectAll("tb_site.categorias", ($paginaAtual - 1) * $porPagina, $porPagina);
		


?>

<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i>Categorias Cadastradas</h2>

	<div class="wraper-table">
	<table>
		<tr>
			<td>Nome</td>
			<td>Imagem</td>
			<td>#</td>
			<td>#</td>
			<td>#</td>
			<td>#</td>
		</tr>

		<?php

			foreach ($categorias as $key => $value) {

		?>


		<tr>
			<td><?php echo $value["nome"];?></td>
			
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-categoria?id=<?php echo $value["id"];?>"><i style="" class="fas fa-pencil-alt"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-categorias?excluir=<?php echo $value['id'];?>"><i class="fa fa-times"></i> Deletar</a></td>
			<td><a class="btn order" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=up&id=<?php echo $value["id"]?>"><i class="fa fa-angle-up"></a></td>
			<td><a class="btn order" href="<?php INCLUDE_PATH_PAINEL ?>gerenciar-categorias?order=down&id=<?php echo $value["id"]?>"><i class="fa fa-angle-down"></a></td>
		</tr>
	


	<?php  } ?>

	</table>
	</div><!--wraper-table-->

	<div class="paginacao">

		<?php


			$totalPaginas = ceil(count(Painel::selectAll("tb_site.categorias"))  / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual){
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar?pagina='.$i.'">'.$i.'</a>';
				}else{
					echo '<a  href="'.INCLUDE_PATH_PAINEL.'gerenciar-categorias?pagina='.$i.'">'.$i.'</a>';
				}
				
			}

		?>

	</div><!--paginacao-->

</div><!--box-content-->