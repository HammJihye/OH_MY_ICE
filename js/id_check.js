$(document).ready(function(e) { 
	$(".check").on("keyup", function(){ //check라는 클래스에 입력을 감지
		var self = $(this); 
		var userid; 
		
		if(self.attr("id") === "userid"){ 
			userid = self.val(); 
		} 
		
		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
			"./id_check.php",
			{ userid : userid }, 
			function(data){ 
				if(data){ //만약 data값이 전송되면
					self.parent().parent().find("#id_check").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
					self.parent().parent().find("#id_check").css("color", "#F00"); //div 태그를 찾아 css효과로 빨간색을 설정합니다
				}
			}
		);
	});
});