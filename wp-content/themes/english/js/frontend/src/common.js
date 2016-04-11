$(document).ready(function(){
    $("#menuCtrl").click(function(){
        if($(".menu-main-container").is(":hidden")){
            $(".menu-main-container").show();
        }else{
            $(".menu-main-container").hide();
        }

    });

    function orientationChange() {
        if(window.orientation == 90 || window.orientation == -90){
            alert("请用竖屏查看网站，谢谢！");
        }
    }

    // 添加事件监听
    orientationChange();
    window.onorientationchange = orientationChange;
});
