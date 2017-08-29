/**
 * Created by admin on 2017/8/20.
 * 实现按钮点击相关模块显示
 */
/*
$(function(){
    var $oTab=$(".tab ul li");
    $oTab.click(function () {
        //被选中的标题粉色背景
        $(this).addClass("selected").siblings().removeClass("selected");
        //获取索引
        var $i=$oTab.index(this);
        console.log($i);
        $("div.squ div").eq($i).show().siblings().hide();
    }).hover(function () {
        $(this).addClass("hover");
    }, function () {
        $(this).removeClass("hover");
    })
})
*/
//获取不同的按钮
var $oSettingBtn=$(".p-setting a");
var $oCollectBtn=$(".user-activity ul li:nth-child(1)");
var $oCommentBtn=$(".user-activity ul li:nth-child(2)");
var $oOrderBtn=$(".user-activity ul li:nth-child(3)");
var $oShoppingCarBtn=$(".user-activity ul li:nth-child(4)");
var $oAlbumBtn=$(".p-main-right-header ul li:nth-child(1)");
var $oVideoBtn=$(".p-main-right-header ul li:nth-child(2)");
var $oMsgBtn=$(".p-main-right-header ul li:nth-child(3)");
//获取不同的区域模块
var $setting=$(".p-main-right .personal-settings");
var $collect=$(".p-main-right .personal-collect");
var $comment=$(".p-main-right .personal-comment");
var $order=$(".p-main-right .personal-order");
var $shoppingcar=$(".p-main-right .personal-shoppingcar");
var $album=$(".p-main-right .personal-album");
var $video=$(".p-main-right .personal-video");
var $msg=$(".p-main-right .personal-msg");

function go() {
     $order.addClass("personal-show").siblings().addClass("personal-hide");
     $order.show();

    // $album.hide();
    console.log($);
    console.log("nihao");
    console.log($order);


}