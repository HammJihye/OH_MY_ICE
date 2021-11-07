var IMP = window.IMP; // 생략 가능
IMP.init("imp62512360"); // 예: imp00000000
function requestPay() {
  // IMP.request_pay(param, callback) 결제창 호출
  IMP.request_pay({ // param
      pg: "kakaopay",
      pay_method: "card",
      merchant_uid: "merchant_" + new Date().getTime(),
      name: "주문테스트",
      amount: 1,
      buyer_email: "gildong@gmail.com",
      buyer_name: "홍길동",
      buyer_tel: "010-4242-4242",
      buyer_addr: "서울특별시 강남구 신사동",
      buyer_postcode: "01181"
  }, function (rsp) { // callback
      if (rsp.success) {
          // jQuery로 HTTP 요청
        jQuery.ajax({
            url: "http://localhost/test/ttt111.php", // 예: https://www.myservice.com/payments/complete
            method: "GET",
            headers: { "Content-Type": "application/json" },
            data: {
                imp_uid: rsp.imp_uid,
                merchant_uid: rsp.merchant_uid
            }
            }).done(function (data) {
            // 가맹점 서버 결제 API 성공시 로직
            })
            alert("결제에 성공하였습니다. 마이페이지에서 주문내역을 확인가능합니다.");
            location.href='./product.php?menu=ice';
      } else {
          alert("결제에 실패하였습니다. 에러 내용: " +  rsp.error_msg);
      }
  });
}