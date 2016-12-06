// Change on click for XS and XL models on first sites
$("#testbtn").click(function () {
    $('[id^="pid"]').removeClass();
    $('[id^="pid"]').addClass("col-xs-2 babes-item");
    $('.babes-item h4').css('padding-left', '5px');
    $('.babes-item').attr('style', 'width: 137px !important;');
    $('.babes-item').css('margin-left', '9px');
    $('.thumb').css('width', '125px');
    $('.thumb').css('height', '182px');
    $('.imgcontainer').css('width', '125px');
    $('.imgoverlay1').css('width', '41px');
    $('.imgoverlay1').css('height', '41px');
    $('.imgoverlay2').css('width', '25px');
    $('.imgoverlay2').css('height', '25px');
    $('.imgoverlay2').css('top', '-6px');
    $('.imgoverlay2').css('right', '-6px');
    $('.imgoverlay3').css('width', '41px');
    $('.imgoverlay3').css('height', '41px');
    $('.imgoverlay4').css('width', '41px');
    $('.imgoverlay4').css('height', '41px');
    $('#commentaries').css('display', 'none');
    $('.text-muted').css('font-size', '9px');
    $('.babes-item h4').css('font-size', '12px');
});

$("#testbtn2").click(function () {
    $('[id^="pid"]').removeClass();
    $('[id^="pid"]').addClass("col-xs-4 babes-item");
    $('.babes-item h4').css('padding-left', '5px');
    $('.babes-item').attr('style', 'width: 266px !important;');
    $('.babes-item').css('margin-left', '22px');
    $('.thumb').css('width', '254px');
    $('.thumb').css('height', '370px');
    $('.imgcontainer').css('width', '254px');
    $('.imgoverlay1').css('width', '61px');
    $('.imgoverlay1').css('height', '61px');
    $('.imgoverlay2').css('width', '40px');
    $('.imgoverlay2').css('height', '40px');
    $('.imgoverlay2').css('top', '-10px');
    $('.imgoverlay2').css('right', '-10px');
    $('.imgoverlay3').css('width', '61px');
    $('.imgoverlay3').css('height', '61px');
    $('.imgoverlay4').css('width', '61px');
    $('.imgoverlay4').css('height', '61px');
    $('#commentaries').css('display', 'block');
    $('.text-muted').css('font-size', '12px');
    $('.babes-item h4').css('font-size', '14px');
});

// Thumbnails cycler
$arr = [];
$root = [];
var count = 0;
var timer;
var $n;
var s;
var $g;

$(document).ready(function()
{
    cycle = function(el, n)
    {
        s = el.attr('src');
        $root.push(s.substring(0, s.lastIndexOf('/') + 1));
        count = (count+1)%$arr[n].length;
        el.attr('src', $root[0] + $arr[n][count]);
    };

    $('.thumb').hover(function()
    {
        var $this = $(this);
        $g = $this.attr('first');
        $n = $this.attr('id');
        //alert($g);
        var f = $g.substring($g.lastIndexOf('/')+1, $g.length);
        //alert(f);
        //alert($arr[$n]);
        $arr[$n] = jQuery.grep($arr[$n], function(value) {
            return value != f;
        });
        //alert($arr[$n]);
        //$arr[$n].push(f);
        $arr[$n].unshift(f);
        //alert($arr[$n]);
        cycle($this, $n);
        timer = setInterval(function(){ cycle($this, $n); }, 650);
    }, function()
    {
        clearInterval(timer);
        //var $a = $n;
        count = 0;
        $n = 0;
        s = 0;
        $(this).attr('src', $g); //$root[0] + $arr[$a][0]);
        $root = [];
    });

    $.ajax({
        url: "getImages.php",
        dataType: "json",
        success: function (data)
        {
            $arr = data;
        }
    });
});