$(function(){

	var open = true;
	var windowSize = $(window)[0].innerWidth;
 	

	var targetSizeMenu = (windowSize <= 768) ? 250 : 300;
	

	if(windowSize <= 768){
		$(".menu").css("width", "0").css("padding", "0");
		open = false;
		
	}

	$(".menu-btn").click(function(){

	

		if(open){
			$(".menu").animate({"width":"0", "padding" : "0"}, function(){
				open = false;
			});
			$(".content,header").css("width", "100%");
			$(".content,header").animate({"left": "0"},function(){
				open = false;
			});
			
		}else{
			$(".menu").css("display","block");
			$(".menu-wraper").css("width" , targetSizeMenu+"px");
			$(".menu").animate({"width":targetSizeMenu+"px", "padding" : "10px 0"}, function(){
				open = true;
			});
			if(windowSize > 768){
		   		$(".content, header").css("width", "calc(100% - 300px)");


				
			}
			$(".content, header").animate({"left": targetSizeMenu+"px"},function(){
				open = true;
			});
		}
	})

	$(window).resize(function(){
			windowSize = $(window)[0].innerWidth;
			var t = $("body").width();
			var targetSizeMenu = (t <= 768) ? 250 : 300;
		
			
			if(windowSize >= 768){
				open = true;
				$(".content, header").css("width", "calc(100% - 300px)").css("left", "300px");
				$(".menu").css("width","300px").css("padding", "10px 0");
				$(".menu-wraper").css("width", "300px");
			}
			else if(windowSize <= 768){
				$(".menu").css("width", "0").css("padding", "0");
				$(".content,header").css("width","100%").css("left", "0");
				open = false;
			}else{
				open = true;
				$(".content, header").css("width", "calc(100% - 250px)").css("left", "250px");
				$(".menu").css("width", "250px").css("padding", "10px 0");
				$(".menu-wraper").css("width", "250px");
			}

	})

	$("[formato=data]").mask("99/99/9999");

	$("[actionBtn=delete]").click(function(){

		var r = confirm("Deseja excluir o registro?");

		if(r == true){
			return true;
		}else{
			return false;
		}


	});

})