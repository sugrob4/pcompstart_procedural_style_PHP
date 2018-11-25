<?php require_once('inc/header.php'); ?>
    <div id="contentwraper">
  	<div id="content">
        <style>
            .catalog-index{padding:27px 0 20px 0; border:1px solid #c1c1c1; border-radius:10px; background:#f1f1f1}
            .catalog-index h1{font:normal 1.2em Arial,Helvetica,Verdana,sans-serif; color:#f10202; margin:1em 0; text-align:center}
            .catalog-index p{color:#010a26; font:italic 15px Arial,Helvetica,Verdana,sans-serif; text-align:center; margin:0 80px}
            .catalog-index p span{line-height:25px}
            .view-detali{border:1px solid #c1c1c1; border-radius:10px; background-color:#F1F1F1; padding:20px 20px 40px 20px; margin:0 0 20px 0}
            .krohi a{text-decoration:none; font:14px Arial,Helvetica,Verdana,sans-serif; color:#0071D0; padding:0 3px 0 5px}
            .krohi a:hover{text-decoration:underline}
            .krohi{margin:0 0 2.2em 0.7em}
            .krohispan{font:13px Arial,Helvetica,Verdana,sans-serif; padding-left:5px}
            .view-text{padding:0 60px}
            .view-text h1{color:#010101; font:bold 20px Verdana,Geneva,Arial,sans-serif; text-align:center; margin-bottom:1.3em}
            .view-text p img{max-width:100%; height:auto; -ms-interpolation-mode:bicubic}
            .view-text p, .view-text h2, .view-text h3, .view-text ul, .view-text ol{font-family:Verdana,Geneva,Arial,sans-serif; text-indent:10px; line-height:21px; color:#000; text-shadow:1px 1px 0 rgba(255,255,255,0.2);}
            @media only screen and (max-width:1025px){.catalog-index h1{font-size:14px}
                .catalog-index p{font-size:12px;margin:auto 2%}
                .view-detali{padding:2%}
                .krohi{margin-bottom:5%}
                .krohi a, .krohispan{font-size:11px}
                .view-text{padding:0}
                .view-text h1{font-size:0.95em}
                .view-text p, .view-text ul li, .view-text ol li{font-size:0.8em !important;line-height:1.44em;}
                .view-text h2{font-size:0.85em !important;}
                .view-text h3{font-size:0.82em !important;}
                .view-text p img{max-width:95%;height:auto}
            }
        </style>
    <?php include $view.'.php'; ?>
    <link rel="stylesheet" type="text/css" href="<?=PATH.TEMPLATE;?>css/style.css"/>
    </div>
 </div>
<script>
    window.jQuery || document.write('<script src="<?=PATH.TEMPLATE;?>js/jquery-2.2.4.min.js"><\/script>');
</script>
<script async src="<?=PATH.TEMPLATE;?>js/scriptJS.js"></script>
<?php require_once('inc/rightbar.php'); ?>
<?php require_once('inc/leftbar.php'); ?>
  <div class="clr"></div>
<?php require_once('inc/footer.php'); ?>
</div>
<div id="but_top"></div>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "pcompstart",
  "url": "https://pcompstart",
  "sameAs": [
    "https://www.facebook.com/pcompstart",
    "https://twitter.com/pcompstart",
    "https://plus.google.com/109793291759248211188"
  ]
}
</script>
</body>
</html>
