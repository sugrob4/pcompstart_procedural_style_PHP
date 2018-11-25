<?php
defined('PCOMPSTART') or die('Access denied');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>pcompstart/Admin</title>
<link href="<?=ADMIN_TEMPLATE;?>css/normalize.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=ADMIN_TEMPLATE;?>css/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?=ADMIN_TEMPLATE;?>js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?=ADMIN_TEMPLATE;?>js/script_adm.js"></script>
<script type="text/javascript" src="<?=ADMIN_TEMPLATE;?>js/ckeditor/ckeditor.js"></script>
</head>
<body>
<div class="main">
    <div class="header">
        <a href="<?=PATH;?>admin/"><img src="<?=ADMIN_TEMPLATE;?>images/logo_left.png" class="logo"/></a>
        <a href="<?=PATH;?>admin/"><img src="<?=ADMIN_TEMPLATE;?>images/nazvanie.png" class="nazvanie"/></a>
        <img src="<?=ADMIN_TEMPLATE;?>images/logo_right.png" class="logo_right"/>
    </div>
  <div class="razdelitel">
      <div class="In_Out_Buttons">
      	<a href="?view=edit_user&amp;user_id=<?=$_SESSION['auth']['user_id'];?>"><?=$_SESSION['auth']['admin'];?></a>
        <a href="<?=PATH;?>" target="_blank">На сайт</a>
        <a href="?do=logout">Выйти</a>
      </div>
</div>
