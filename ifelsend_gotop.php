<?php
/**
 * @package Go_Top
 * @version 0.1
 */
/*
Plugin Name: GoTop 
Plugin URI: http://ifelsend.com/ 
Description: If Page Scroll, well downer right of your screen on every page.
Author: Naodai [zhao_brain@163.com]
Version: 0.1 
Author URI: http://ifelsend.com/
*/
function gotop() {
	$lyrics = '<div id="toolBackTo" class="back-to" style="right: 210px; ">
<a class="backtotop" href="#top">返回顶部
<img id="back-tip" src="http://ifelsend.com/blog/wp-content/plugins/ifelsend_gotop/back-tip.png" class="back-tip">
</a>
</div>';
	return wptexturize ( $lyrics );
}
function echoGotop() {
	$chosen = gotop();
	echo $chosen;
}
add_action ( 'wp_footer', 'echoGotop' );
// We need some CSS to position the paragraph
function gotopJsCss() {	
echo "
<style type='text/css'>
.back-to {
position: fixed;
bottom: 35px;
_bottom: 35px;
right: 10px;
z-index: 999;
width: 50px;
zoom: 1;
display:none;
}
.back-to .backtotop:hover {
background-color: #333;
background-position: 8px 13px;
}
float: left;
display: block;
width: 50px;
height: 50px;
background: #666 url(http://ifelsend.com/blog/wp-content/plugins/ifelsend_gotop/btt.png) 8px -57px no-repeat;
margin-bottom: 15px;
outline: 0 none;
text-indent: -9999em;
-moz-border-radius: 4px;
-khtml-border-radius: 4px;
-webkit-border-radius: 4px;
border-radius: 4px;
position: relative;
}
position: absolute;
visibility: hidden;
top: -31px;
max-width: 69px;
}
</style>
<script type='text/javascript'>
/**
 * @param acceleration 加速度
 * @param time 时间间隔 (毫秒)
 **/
	acceleration = acceleration || 0.1;
	time = time || 16;
	var x1 = 0;
	var y1 = 0;
	var x2 = 0;
	var y2 = 0;
	var x3 = 0;
	var y3 = 0;
	if (document.documentElement) {
		x1 = document.documentElement.scrollLeft || 0;
		y1 = document.documentElement.scrollTop || 0;
	}
	if (document.body) {
		x2 = document.body.scrollLeft || 0;
		y2 = document.body.scrollTop || 0;
	}
	var x3 = window.scrollX || 0;
	var y3 = window.scrollY || 0; 
	// 滚动条到页面顶部的水平距离
	var x = Math.max(x1, Math.max(x2, x3));
	// 滚动条到页面顶部的垂直距离
	var y = Math.max(y1, Math.max(y2, y3));
	// 滚动距离 = 目前距离 / 速度, 因为距离原来越小, 速度是大于 1 的数, 所以滚动距离会越来越小
	var speed = 1 + acceleration;
	window.scrollTo(Math.floor(x / speed), Math.floor(y / speed));
	// 如果距离不为零, 继续调用迭代本函数
	if(x > 0 || y > 0) {
		var invokeFunction = 'goTop(' + acceleration + ', ' + time + ')';
		window.setTimeout(invokeFunction, time);
	}
}
	window.onload = function(){
		topShow();
		document.getElementById('toolBackTo').onmouseover = function(){ document.getElementById('back-tip').style.visibility='visible';};
		document.getElementById('toolBackTo').onmouseout = function(){ document.getElementById('back-tip').style.visibility='hidden';};
		document.getElementById('toolBackTo').onclick = function(){goTop();return false;};
		window.onscroll = topShow;
	};
	function topShow(){
	    	var bt = document.getElementById('toolBackTo'),st = document.body.scrollTop,show = (st>30);
			if( show ){
				bt.style.display='block';
			}else{
				bt.style.display='none';
			}
		}
</script>
	";
}
add_action ( 'wp_footer', 'gotopJsCss' );
?>