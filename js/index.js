$(document).ready( function(){
	$("#learn,#practice,#else").mouseover(function(){
		$(this).addClass("mouseover");
	});

	$("#learn,#practice,#else").mouseout(function(){
		$(this).removeClass("mouseover");
	});

 	$(".link1").click(function(){
		$(".link1").addClass("selected");
		$(".link2").removeClass("selected");
		$('.feedback-form').show();
		$('.resource-form').hide();
	});

	$(".link2").click(function(){
		$(".link2").addClass("selected");
		$(".link1").removeClass("selected");
		$('.resource-form').show();
		$('.feedback-form').hide();
	});

});