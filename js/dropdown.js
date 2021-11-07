$(function(){
	var $firstMenu = $('nav > ul > li '),
			$header = $('#dropdown_menu');
	
	$firstMenu.mouseenter(function(){
		$header.stop().animate({height:'200px'});
	})
	.mouseleave(function(){
		$header.stop().animate({height:'50px'});
	});	
});
