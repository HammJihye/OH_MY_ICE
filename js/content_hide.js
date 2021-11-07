$(function(){
    $("#different_info").hide();
    $("#check_box").click(function(){
        var chk = $(this).is(":checked");
        if(chk){
            $("#same_info").hide();
            $("#different_info").show();
        } else {
            $("#same_info").show();
            $("#different_info").hide();
        }
    });
});