function fregisterform_submit(f){
    
    if(f.mb_name.value.length < 1){
        alert("이름을 입력하십시오.");
        f.mb_name.focus();
        return false;
    }
    if(f.userid.value.length < 1){
        alert("아이디를 입력하십시오.");
        f.mb_id.focus();
        return false;
    }
    if(f.mb_pwd.value.length < 3){
        alert("비밀번호를 3글자 이상 입력하십시오.");
        f.mb_pwd.focus();
        return false;
    }
    if(f.mb_pwd.value != f.repwd.value){
        alert("비밀번호가 같지 않습니다.");
        f.repwd.focus();
        return false;
    }
    if(f.email1.value.length < 1 && f.email2.value.length < 1){
        alert("이메일을 입력하십시오.");
        f.email1.focus();
        return false;
    }
    if(f.gender.value == "slc1"){
        alert("성별을 선택해주십시오.");
        return false;
    }
    if(f.mb_postcode.value.length < 1){
        alert("주소을 입력해주십시오.");
        return false;
    }
    return true;
}