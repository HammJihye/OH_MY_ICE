function historyDel() {
    var form = document.f;
    var boo = false;                // 삭제할 항목을 체크했는지 여부 구분자
   
    if (document.getElementsByName("chk[]").length > 0) {
     for (var i=0;i<document.getElementsByName("chk[]").length;i++) {
      if (document.getElementsByName("chk[]")[i].checked == true) {
       boo = true;
       break;
      }
     }
    }

    if (boo) {
     form.action = "../delete.php";
     form.submit();
    } else {
     alert("개별 삭제하실 항목을 적어도 하나는 체크해 주십시오.");
    }
}
function exchangeRequest() {
  form.action = "./update.php?request=exchange";
  form.submit();
}
function selectAll(selectAll)  {
  const checkboxes 
      = document.getElementsByName('chk[]');
  
  checkboxes.forEach((checkbox) => {
    checkbox.checked = selectAll.checked;
  })
}