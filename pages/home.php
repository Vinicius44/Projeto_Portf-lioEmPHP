

	<section class="banner-principal">
		<div class="overlay"></div>
		<div class="center">
		
		<form class="ajax-form" method="post">
			<h2>Qual o seu melhor email?</h2>
			<input type="email" name="email" required="" placeholder="E-mail">
			<input type="hidden"name="identificador" value="form_home"/>
			<input type="submit" name="acao" value="Cadastrar!">
		</form>
		</div><!--center-->
	</section><!--banner-principal-->

	<section class="descricao-autor">
		<div class="center">
		<div class="w50 left">
		<h2><?php echo $infoSite["nome"];?></h2>
		<p><?php echo $infoSite["descricao"]?></p>
		</div><!--w50-->

		<div class="w50 left img">
		</div><!--w50-->
		<div class="clear"></div>

		</div><!--center-->

	</section><!--descricao-autor-->

	<section class="especialidades">

		<div class="center">

		<h2 class="title">Especialidades</h2>
		
			<div class="w33 left box-especialidade">
				<h3><i class="<?php echo $infoSite["icone1"]; ?>"></i></h3>
				<h4>CSS3</h4>
				<p><?php echo $infoSite["descricao1"]?>
				</p>
			</div><!--box-especiabilidade-->

			<div class="w33 left box-especialidade">
				<h3><i class="<?php echo $infoSite["icone2"]; ?>"></i></h3>
				<h4>HTML5</h4>
				<p><?php echo $infoSite["descricao2"] ?>
				</p>
			</div><!--box-especiabilidade-->

			<div class="w33 left box-especialidade">
				<h3><i class="<?php echo $infoSite["icone3"]; ?>"></i></h3>
				<h4>JAVASCRIPT</h4>
				<p><?php echo $infoSite["descricao3"] ?>
				</p>
			</div><!--box-especiabilidade-->
			<div class="clear"></div>
		</div><!--center-->
	</section><!--especialidades-->

	<section class="extras">
		<div class="center">
			<div id="depoimentos" class="w50 left depoimentos-container">
				<h2 class="title">Depoimentos dos nossos clientes</h2>
				<?php

					$sql = Mysql::conectar()->prepare("SELECT * FROM `tb_site.depoimentos` ORDER BY order_id ASC LIMIT 3");
					$sql->execute();
					$depoimentos = $sql->fetchAll();
					foreach($depoimentos as $key => $value){



				?>
				<div class="depoimento-single">
					<p class="depoimento-descricao"><?php echo $value["depoimento"]?></p>
					<p class="nome-autor"><?php echo $value["nome"] ?> - <?php echo $value["data"] ?></p>
				</div><!--depoimento-single-->

			<?php } ?>
				
			</div><!--w50-->

			<div id="servicos" class="w50 left servicos-container">
				<h2 class="title">Serviços</h2>
				<div class="servicos">
				<ul>
					<?php 

						$sql = Mysql::conectar()->prepare("SELECT * FROM `tb_site.servicos` ORDER BY order_id ASC LIMIT 3");
						$sql->execute();
						$servicos = $sql->fetchAll();
						foreach($servicos as $key => $value){

					?>
					<li><?php  echo $value["servico"] ?></li>

				<?php } ?>

					
				</ul>
				</div><!--servicos-->
				</div><!--depoimento-single-->
			</div><!--w50-->
			<div class="clear"></div>
		</div><!--center-->
	</section><!--extra-->