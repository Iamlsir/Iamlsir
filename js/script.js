$(window).scroll(function(){
    var scrollTop = $(this).scrollTop();
    //gotop,gobottom 按钮
    if ( scrollTop > 100) {
        $('#gobottom').hide();
        $('#backtop').fadeIn();
    } else {
        $('#backtop').fadeOut();
        $('#gobottom').fadeIn();
    }

    //如果向上滚动就显示菜单栏
    if ( scrollTop < options.scrollTop ){
        $("#header").removeClass().addClass("animated swingInX");
    }else{
        if (scrollTop > 100) $("#header").removeClass().addClass("animated swingOutX");
    }
    options.scrollTop = scrollTop;
});
$('#backtop').click(function(){
    $('html, body').animate({scrollTop : 0},800);
});
$('#gobottom').click(function(){
    $("html, body").animate({ scrollTop: $(document).height() }, 1000);
});
var open = $(".postmenu .open");
if ( open.length ){
    $(open).on("click",function(){
        $(".menu-list").toggle('fast');
    })
}
console.log("%c☞欢迎访问「L-先生」！", "color: orange;");
console.log("%c☞本站由「 Iamlsir 」制作", "color: purple;");
console.log("%c☞©L-先生版权所有","color: brown; font-weight: bold;");
$(document).ready(function () {
    setInterval(function () {
        var now = (new Date()).getTime(),start = Date.parse('Apr 23 2012 09:00:00'),millseconds = now -start, days = Math.floor(millseconds/86400000), hours= Math.floor((millseconds - days*86400000)/3600000), mins = Math.floor((millseconds - days*86400000 - hours*3600000)/60000),secs = Math.floor((millseconds-days*86400000-hours*3600000-mins*60000)/1000);
        if (hours<=9) hours = "0"+hours;
        if (mins<=9) mins = "0"+mins;
        if (secs<=9) secs = "0"+secs;
        $("#runtime").text(" "+days+"天"+hours+"小时"+mins+"分"+secs+"秒");
    },1000);
    $(".menu").on("click",function () {
        $("#nav ul").toggle("fast");
    });
    $(".archives h2").each(function (m,n) {
        $(n).on("click",function (){
            var i = $(n).children("i");
            i.hasClass("fa fa-folder") ? i.removeClass().addClass("fa fa-folder-open") : i.removeClass().addClass("fa fa-folder");
            $(n).next().toggle("fast");
        })
    });
    //图片加载失败后
    $(".postcontent img").error(function(){
        $(this).prop("src",options.themeUrl + '/images/loadfailed.png');
    });

    $(document).pjax("a","#main");
});