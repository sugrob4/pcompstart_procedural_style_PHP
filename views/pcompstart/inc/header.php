<?php
defined('PCOMPSTART') or die('Access denied');
?>
<!DOCTYPE html>
<html lang="ru"<?if (!empty($meta_graph)) echo ' prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#"';?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="author" content="Aleksey Povar" />
<title><?=$meta['title'];?></title>
<meta name="keywords" content="<?=$meta['keywords'];?>" />
<meta name="description" content="<?=$meta['description'];?>" />
<?if (!empty($meta_graph)) { ?>
    <meta property="og:title" content="<?=$meta['title'];?>"/>
    <meta property="og:description" content="<?=$meta['description'];?>"/>
    <?if (count($meta_graph['og_image']) > 1) : ?>
        <?foreach ($meta_graph['og_image'] as $img_graph) { ?>
            <?$im = explode(':', $img_graph)[1];?>
            <meta property="og:image" content="<?='https:'.$im;?>">
            <meta property="og:image:secure_url" content="<?='https:'.$im;?>">
        <?}?>
    <?else : ?>
        <meta property="og:image" content="<?=$meta_graph['og_image'];?>">
        <meta property="og:image:secure_url" content="<?=$meta_graph['og_image'];?>">
    <?endif;?>
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <?if (!empty($meta_graph['published_time'])) {?>
        <meta property="og:type" content="article"/>
        <meta property="article:published_time" content="<?=$meta_graph['published_time'];?>"/>
    <?} else { ?>
        <meta property="og:type" content="website"/>
    <?}?>
    <meta property="og:url" content= "<?=$meta_graph['og_url'];?>" />
    <meta property="og:locale" content="ru_RU" />
    <meta property='og:site_name' content='<?=TITLE;?>' />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@pcompstart" />
    <meta name="twitter:creator" content="@leha_povar" />
<? } ?>
 <style type="text/css">
  html,body {margin:0;padding:0}
  .schemaorg{display:none;}
  body{background:url(<?=PATH.TEMPLATE;?>images/bg_test.png) repeat;}
  .main{background:#f9f9f9;margin:0 auto;max-width:1550px;vertical-align:top}
  .header{background:#617689;background:-moz-linear-gradient(top, #617689 0%, #839eb7 100%);background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#617689), color-stop(100%,#839eb7));background:-webkit-linear-gradient(top, #617689 0%,#839eb7 100%);background:-o-linear-gradient(top, #617689 0%,#839eb7 100%);background:-ms-linear-gradient(top, #617689 0%,#839eb7 100%);background:linear-gradient(to bottom, #617689 0%,#839eb7 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#617689', endColorstr='#839eb7',GradientType=0);overflow:hidden;text-align:center;}
  .logo_right{float:right;margin:15px 60px 0 0;height:13.4em}
  .logo_left{margin:13px 0 0 50px;float:left;height:13.5em}
  .slogan img{margin-top:6%;}
  .menu{background:url(<?=PATH.TEMPLATE;?>images/menu_bg.jpg) top repeat-x;border:1px solid #9d9d9d;border-radius:0 0 5px 5px;margin:0 0 20px 0;overflow:hidden;}
  .menu li{float:left;height:43px;border-left:1px solid #747e82;list-style:none;}
  .menu li a{float:left;font:19px Arial, Helvetica, Verdana, sans-serif;color:#f7f7f7;text-decoration:none;display:block;padding:10px 13px;}
  .menu li a:hover{color:#4a5f72;}
  .first_menu{border-left:none !important;margin-left:-40px !important;}
  .menu li:hover{background:url(<?=PATH.TEMPLATE;?>images/menu_bgHover.jpg)top repeat-x;}
  .nav_search{position:relative;-webkit-box-shadow:0 15px 11px -1px #e0e0e0;-moz-box-shadow:0 15px 11px -1px #e0e0e0;box-shadow:0 15px 11px -1px #e0e0e0;}
  .search-head{position:absolute;top:-0.6em;right:2.7em;/*margin:auto;padding:0;*/}
  .search-head li{list-style:none;float:left;margin-top: 0.15em;height:1.65em;}
  #quickquery{width: 11em;border-radius:0.4em;border:0.05em solid #7a8282;font-size:0.822em;padding-left:0.4em;height:88%;}
  #quickquery::placeholder{color:#838383;}
  .search-btn{position: relative;right: 0.5em;border-radius:0 0.4em 0.4em 0;border:0.05em solid #7a8282;background-color:#bfc8d2;color:#303135;font:normal 0.82em Verdana, Geneva, Trebuchet, sans-serif;padding:0 0.45em;height:100%;}
  .search-btn:hover{background-color:#8A949C;color:#fff;}
  #contentwraper{float:left;width:100%;background:#f9f9f9;border-radius:10px;}
  #content{margin:0 270px 0 270px;border-radius:10px;}
  @media only screen and (max-width:1025px){.slogan img{max-width:19em !important;height:auto;}}
  @media only screen and (max-width:961px){#contentwraper{float:none;width:100%;}
  .header{padding-top: 0.7em}
  #content{margin:auto auto 3% auto;}
  .flogo a{display:none;}
  .logo_left{display:none;}
  .logo_right{display:none;}
  .slogan img{margin-bottom:6%;}
   #quickquery{width:9em !important;height:86%;}
  .search-head{right:0 !important;}
  .search-btn{height:98%;}
  }
  @media only screen and (max-width:641px){.menu{background-repeat:repeat;padding-left:0;}
  .menu_button input[type="button"]{margin:-0.4em auto auto 6em !important;}
  .menu li{float:none;border-left:none;}
  .menu li a{float:none;font-size:18px;padding-top:3.5%;}
  .first_menu{margin-left:auto !important;}
  }
 </style>
<!-- Favicons для всех девайсов -->
<link rel="apple-touch-icon" sizes="180x180" href="<?=PATH.TEMPLATE;?>images/favicon_package/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=PATH.TEMPLATE;?>images/favicon_package/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=PATH.TEMPLATE;?>images/favicon_package/favicon-16x16.png">
<link rel="manifest" href="<?=PATH.TEMPLATE;?>images/favicon_package/site.webmanifest">
<link rel="mask-icon" href="<?=PATH.TEMPLATE;?>images/favicon_package/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#00aba9">
<meta name="theme-color" content="#ffffff">
<!-- Конец Favicons для всех девайсов -->
 <link rel="alternate" type="application/rss+xml" title="RSS" href="//feeds.feedburner.com/pcompstart"/>
</head>
<body>
<div class="main">
  <div class="header">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WPHeader",
  "image": "https:<?=PATH.TEMPLATE;?>images/slogan.png"
}
</script>
  	<a href="<?=PATH;?>" class="logo_left"><img src="<?=PATH.TEMPLATE;?>images/logo_left.png" alt="left logo pcompstart"/></a>
    <div class="menu_button" style="display:none;">
        <input type="button" value="Меню"/>
    </div>
  	<a href="<?=PATH;?>" class="slogan"><img src="<?=PATH.TEMPLATE;?>images/slogan.png" alt="slogan pcompstart"/></a>
    <div class="logo_right">
    	<img src="<?=PATH.TEMPLATE;?>images/logo_right.png" alt="right logo pcompstart"/>
    </div>
  </div>
  <div class="nav_search">
  	<ul class="menu">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SiteNavigationElement",
  "url": [
    "https:<?=PATH;?>",
    "https:<?=PATH;?>sitemap",
    "https:<?=PATH;?>contacts"],
  "name": [
    "Главная",
    "Карта сайта",
    "Контакты"]
}
</script>
    	<li class="first_menu"><a href="<?=PATH;?>">Главная</a></li>
        <li><a href="<?=PATH;?>sitemap">Карта сайта</a></li>
        <?php if($cheifinformers) :?>
			<?php for ($i = 1; $i <count($cheifinformers) ; $i ++) :?>
                    <li><a href="<?=PATH.$cheifinformers[$i]['link_browser']?>"><?=$cheifinformers[$i]['title'];?></a></li>
            <?php endfor;?>
        <?php endif;?>
    </ul>
    <form method="get" action="<?=PATH;?>">
    	<ul class="search-head">
            <input type="hidden" name="view" value="search"/>
            <li><input type="text" name="search" id="quickquery" placeholder="Поиск по сайту" autocomplete="on" onfocus="this.placeholder=''" onblur="this.placeholder='Поиск по сайту'"/></li>
            <li><input type="submit" class="search-btn" value="Найти"/></li>
        </ul>
    </form>
  </div>
