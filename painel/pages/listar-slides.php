<?php
		
		if(isset($_GET["excluir"])){
			$idExcluir = (int)$_GET["excluir"];
			$selectImagem = Mysql::conectar()->prepare("SELECT slides FROM `tb_site.slides` WHERE id = ?");
			$selectImagem->execute(array($_GET["excluir"]));
			$imagem = $selectImagem->fetch()["slides"];
			Painel::deleteFile($imagem);
			Painel::deletar('tb_site.slides', $idExcluir);
			Painel::redirect(INCLUDE_PATH_PAINEL."listar-slides");
		}else if(isset($_GET["order"]) && $_GET["id"]){
			Painel::orderItem("tb_site.slides", $_GET["order"], $_GET["id"]);
		}
		$paginaAtual = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
		$porPagina = 3;
		
		$slides = Painel::selectAll("tb_site.slides", ($paginaAtual - 1) * $porPagina, $porPagina);
		


?>

<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i>Slides Cadastrados</h2>

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

			foreach ($slides as $key => $value) {

		?>


		<tr>
			<td><?php echo $value["nome"];?></td>
			<td><img style="border: 1px solid #ccc;width: 50px; height: 50px;" src="<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value["slides"];?>"></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-slides?id=<?php echo $value["id"];?>"><i style="" class="fas fa-pencil-alt"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php INCLUDE_PATH_PAINEL ?>listar-slides?excluir=<?php echo $value['id'];?>"><i class="fa fa-times"></i> Deletar</a></td>
			<td><a class="btn order" href="<?php INCLUDE_PATH_PAINEL ?>listar-slides?order=up&id=<?php echo $value["id"]?>"><i class="fa fa-angle-up"></a></td>
			<td><a class="btn order" href="<?php INCLUDE_PATH_PAINEL ?>listar-slides?order=down&id=<?php echo $value["id"]?>"><i class="fa fa-angle-down"></a></td>
		</tr>
	


	<?php  } ?>

	</table>
	</div><!--wraper-table-->

	<div class="paginacao">

		<?php


			$totalPaginas = ceil(count(Painel::selectAll("tb_site.slides"))  / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual){
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
				}else{
					echo '<a  href="'.INCLUDE_PATH_PAINEL.'listar-slides?pagina='.$i.'">'.$i.'</a>';
				}
				
			}

		?>

	</div><!--paginacao-->

</div><!--box-content-->