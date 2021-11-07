function fproduct_insert_submit(f){
    
    var fileCheck = document.getElementById("product_img").value;
    
    if(f.p_name.value.length < 1){
        alert("상품 이름을 입력하십시오.");
        f.p_name.focus();
        return false;
    }
    if(f.p_price.value.length < 1){
        alert("상품 가격을 입력하십시오.");
        f.p_price.focus();
        return false;
    }
    if(!fileCheck){
        alert("파일을 첨부해 주세요");
        return false;
    }
    if(f.title.value.length < 1){
        alert("제목을 입력해 주세요.");
        f.title.focus();
        return false;
    }
    if(f.content.value.length < 1){
        alert("내용을 입력해 주세요.");
        f.content.focus();
        return false;
    }
    return true;
}

function frequest_insert_submit(f){
    
    if(f.reason.value == "slc1"){
        alert("이유를 선택해주세요.");
        return false;
    }
    if(f.detail_reason.value.length < 1 && f.reason.value == "etc"){
        alert("이유를 적어주세요.");
        return false;
    }
    if(f.account_num.value.length < 1){
        alert("계좌번호를 입력하세요.");
        f.account_num.focus();
        return false;
    }
    if(f.account_name.value.length < 1){
        alert("에금주를 입력하세요.");
        f.account_name.focus();
        return false;
    }
    return true;
}
function frequest_update_submit(f){
    
    if(f.request_respond.value == "slc1"){
        alert("선택해주세요.");
        return false;
    }
    return true;
}
function fo_state_update_submit(f){
    
    if(f.order_state_update.value == "slc1"){
        alert("선택해주세요.");
        return false;
    }
    return true;
}