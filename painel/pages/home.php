<?php   
	$usuarioOnline = Painel::listarUsuariosOnline();
	$pegarVisitasTotais = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
	$pegarVisitasTotais->execute();
	$pegarVisitasTotais = $pegarVisitasTotais->rowCount();

	$pegarVisitasHoje = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
	$pegarVisitasHoje->execute(array(date("Y-m-d")));
	$pegarVisitasHoje = $pegarVisitasHoje->rowCount();
  ?>

<div class="box-content left w100">
		<h2><i class="fa fa-home"></i> Painel de Controle - <?php echo "Danki Code" ?></h2>

		<div class="box-metricas">
			<div class="box-metrica-single" style="background-color: #ff2424">
				<div class="box-metrica-wraper">
					<h2>Usuários Online</h2>
					<p><?php echo count($usuarioOnline);?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->

			<div class="box-metrica-single" style="background-color: #249bff">
				<div class="box-metrica-wraper">
					<h2>Total de Visitas</h2>
					<p><?php  echo $pegarVisitasTotais;?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->

			<div class="box-metrica-single" style="background-color: #ffcc21">
				<div class="box-metrica-wraper">
					<h2>Visitas Hoje</h2>
					<p><?php echo $pegarVisitasHoje;?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->

			<div class="clear"></div>

		</div><!--box-metricas-->
</div><!--box-content-->

<div class="box-content left w50">
	<h2><i class="fa fa-rocket"></i> Usuários Online no Site</h2>

	<div class="table-responsive">

		<div class="row">
			<div class="col">
				<span>IP</span>
			</div><!--col-->
			<div class="col">
				<span>Ultima Ação</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->

		<?php  
			foreach ($usuarioOnline as $key => $value) {
				
			
				
			
		?>

		<div class="row">
			<div class="col">
				<span><?php echo $value["ip"]?></span>
			</div><!--col-->
			<div class="col">
				<span><?php echo date("d/m/Y H:i:s",strtotime($value["ultima_acao"]))?></span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
	<?php } ?>

	</div><!--table-responsive-->
</div><!--box-content-->

<div class="box-content right w50">
	<h2><i class="fa fa-rocket"></i> Usuários do Painel</h2>

	<div class="table-responsive">

		<div class="row">
			<div class="col">
				<span>Nome</span>
			</div><!--col-->
			<div class="col">
				<span>Cargo</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->

		<?php  

			$usuarioPainel = Mysql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
			$usuarioPainel->execute();
			$usuarioPainel = $usuarioPainel->fetchAll();
			foreach ($usuarioPainel as $key => $value) {
				
			
				
			
		?>

		<div class="row">
			<div class="col">
				<span><?php echo $value["user"]?></span>
			</div><!--col-->
			<div class="col">
				<span><?php echo pegaCargo($value["cargo"]);?></span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
	<?php } ?>

	</div><!--table-responsive-->
</div><!--box-content-->