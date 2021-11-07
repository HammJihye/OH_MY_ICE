<?php
/*
if (isset($_COOKIE['cookie_name'])) {
    unset($_COOKIE['cookie_name']);
    setcookie('cookie_name', '', time() - 3600, '/');
}
*/
$cookiePno = $_GET['product']; // 여기서 $no는 상품번호이다.
$i=0;
$save="";
if(isset($_COOKIE['today_view'])){ // today_view라는 쿠키가 존재하면
    $todayview=$_COOKIE['today_view']; // $todayview 변수에 today_view 쿠키를 저장한다.
    $tod2=explode(",", $_COOKIE['today_view']); // today_view 쿠키를 ','로 나누어 구분한다.
    
    $tod=array_reverse($tod2); // 최근 목록으로 뽑기 위해 배열을 최신 것부터로 반대로 정렬해준다.
    

    // 중복을 막기위한 save 변수 지정
    
    while($i<sizeof($tod)){ // $tod배열의 사이즈만큼 반복한다.
    
        if($cookiePno==$tod[$i]){
    
    
            $save="no";
    
    
    
        }
    
    
        $i++;
    
    
    }
    

}

// 저장된 쿠키값이 없을 경우 새로 쿠키를 저장하는 소스
if(!isset($_COOKIE['today_view'])){
    setcookie('today_view', $cookiePno, time() + 21600, "/");
    
}

// 저장된 쿠키값이 존재하고, 중복된 값이 아닌 경우 기존의 today_view 쿠키에 현재 쿠키를 추가하는 소스
if(isset($_COOKIE['today_view'])){
    if($save != 'no'){
    
        setcookie('today_view' , $todayview. "," . $cookiePno , time() + 21600, "/");
    
    
    }
    if($save != 'no'){
        
        //setcookie('test111' , $todayview. "," . $cookiePno , time() + 21600, "/");
        if(sizeof($tod)>4){
            //setcookie('test111' , "abc" , time() + 21600, "/");
            $find_count=strpos($todayview, ",");
            $todayview = substr($todayview, $find_count+1);
            setcookie('today_view', $todayview. "," . $cookiePno, time() + 21600, "/");
        
        }else {
            setcookie('today_view' , $todayview. "," . $cookiePno , time() + 21600, "/");
        }
    
    
    }

}
?>


