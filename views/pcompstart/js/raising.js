$(document).ready(function(){function is_cached(src){var image=new Image();image.src=src;return image.complete;}var e=$('.raising');e.each(function(){var cur_img=$(this).attr('src');var a=cur_img.substr(-4);var cur_path=cur_img.replace(a,'_big'+a);$(new Image()).attr("src",cur_path).on('load',function(ev){console.log(ev);});});$(function(){$('.raising').click(function(){var enh=$(this).attr('src');var a=enh.substr(-4);var i_path=enh.replace(a,'_big'+a);if(is_cached(i_path)==true){$('body').append('<div id="overlay"></div><div id="magnify"><img src="'+i_path+'"><div id="close-popup"><i></i></div></div>');if($('#magnify').height()>$(window).height()){$('#magnify').css({width:'59em'});}$('#magnify').css({left:($(document).width()-$('#magnify').outerWidth())/2,top:($(window).height()-$('#magnify').outerHeight())/2});$('#overlay,#magnify').toggle("scale",300);}else{return false;}});$('body').on('click','#close-popup,#overlay',function(event){event.defaultPrevented;$('#close-popup').remove();$('#overlay,#magnify').toggle("explode",300,function(){$(this).remove();});});});});