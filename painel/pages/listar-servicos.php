<?php
		
		if(isset($_GET["excluir"])){
			$idExcluir = (int)$_GET["excluir"];
			Painel::deletar('tb_site.servicos', $idExcluir);
			Painel::redirect(INCLUDE_PATH_PAINEL."listar-servicos");
		}else if(isset($_GET["order"]) && $_GET["id"]){
			Painel::orderItem("tb_site.servicos", $_GET["order"], $_GET["id"]);
		}
		$paginaAtual = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
		$porPagina = 3;
		
		$servicos = Painel::selectAll("tb_site.servicos", ($paginaAtual - 1) * $porPagina, $porPagina);
		


?>

<div class="box-content">
	<h2><i class="fa fa-id-card-o" aria-hidden="true"></i>Serviços Cadastrados</h2>

	<div class="wraper-table">
	<table>
		<tr>
			<td>Serviço</td>
			<td>#</td>
			<td>#</td>
			<td>#</td>
			<td>#</td>
			
		</tr>

		<?php

			foreach ($servicos as $key => $value) {

		?>


		<tr>
			<td><?php echo $value["servico"];?></td>
			<td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-servicos?id=<?php echo $value["id"];?>"><i style="" class="fas fa-pencil-alt"></i> Editar</a></td>
			<td><a actionBtn="delete" class="btn delete" href="<?php INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id'];?>"><i class="fa fa-times"></i> Deletar</a></td>
			<td><a class="btn order" href="<?php INCLUDE_PATH_PAINEL ?>listar-servicos?order=up&id=<?php echo $value["id"]?>"><i class="fa fa-angle-up"></a></td>
			<td><a class="btn order" href="<?php INCLUDE_PATH_PAINEL ?>listar-servicos?order=down&id=<?php echo $value["id"]?>"><i class="fa fa-angle-down"></a></td>
		</tr>
	


	<?php  } ?>

	</table>
	</div><!--wraper-table-->

	<div class="paginacao">

		<?php


			$totalPaginas = ceil(count(Painel::selectAll("tb_site.servicos"))  / $porPagina);

			for($i = 1; $i <= $totalPaginas; $i++){
				if($i == $paginaAtual){
					echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
				}else{
					echo '<a  href="'.INCLUDE_PATH_PAINEL.'listar-servicos?pagina='.$i.'">'.$i.'</a>';
				}
				
			}

		?>

	</div><!--paginacao-->

</div><!--box-content-->