$(function(){


		$("nav.mobile").click(function(){
			var listaMenu = $("nav.mobile ul");

				/*
				if(listaMenu.is(":hidden") == true){
					listaMenu.fadeIn();
				}else{
					listaMenu.fadeOut();
				}*/

	
				if(listaMenu.is(":hidden") == true){
					
					var icone = $(".botao-menu-mobile").find("i");
					icone.removeClass("fas fa-ellipsis-h");
					icone.addClass("far fa-times-circle");
					listaMenu.slideToggle();
				}else{

					var icone = $(".botao-menu-mobile").find("i");	
					icone.removeClass("far fa-times-circle");
					icone.addClass("fas fa-ellipsis-h");
					listaMenu.slideToggle();
				}
		});

		if($('target').length > 0){
			//elemento existe
			var elemento = '#'+$('target').attr('target');
			var divScroll = $(elemento).offset().top;
			

			$("html,body").animate({scrollTop:divScroll},1500);         
		}


		carregarDinamico();
		function carregarDinamico(){
			$("[realtime]").click(function(){
				
				var pagina = $(this).attr('realtime');
				$('.container-principal').load('/Projetos_PHP/Projeto_01/pages/'+pagina+'.php');
				return false;
			})
		}

});