function checkemail(){
	var email1 = document.getElementById("email1").value;
	var email2 = document.getElementById("email2").value;
    if(email1 && email2)
	{
		url = "./id_check.php?mb_email="+email1+"@"+email2;
			window.open(url,"chkid","width=300,height=250");
		}else{
			alert("이메일을 정확히 입력하세요.");
		}
	}