<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование каталога</h3>
<?php 
if (isset($_SESSION['answer'])) {
	echo $_SESSION['answer'];
	unset($_SESSION['answer']);
}
?>
<p align="right" class="add_forum"><a href="?view=add_type">Добавить раздел</a></p> 
<p align="right"><a class="edit-cat" href="?view=edit_type&amp;type_link=<?=$category;?>">Изменить раздел</a>&nbsp;&nbsp;|&nbsp;&nbsp;
<a class="delete-cat" href="?view=del_type&amp;type_link=<?=$category;?>">Удалить раздел</a></p>
<p class="add_product"><a href="?view=add_product&amp;type_link=<?=$category;?>">Добавить продукт</a></p>
<?php if($products) :?>
<?php 
$col = 3; // кол-во ячеек в строке
$row = ceil((count($products) / $col)); //кол-во рядов
$start = 0;
?>
<table cellspacing="1" class="tabl-cat">
  <tbody>
<?php for ($i = 0; $i < $row; $i ++) ://цикл вывода рядов ?>
    <tr>
    <?php for ($k = 0; $k < $col; $k ++) : //цикл вывода ячеек ?>
      <td>
      <?php if($products[$start]) :?>
      	<h2><?=$products[$start]['title'];?></h2>
        <div class="product-table-img">
        	<img src="<?=PRODUCTIMG.$products[$start]['img_icon'];?>" alt="<?=$products[$start]['img_icon']?>"/>
        </div>
		<p><a class="edit-cat" href="?view=edit_product&amp;product_id=<?=$products[$start]['product_id'];?>">Изменить</a>&nbsp; | &nbsp;
        <a class="delete-cat" href="?view=del_product&amp;product_id=<?=$products[$start]['product_id'];?>">Удалить</a></p>
        <?php else : ?>
        &nbsp;
     <?php endif; ?>
      <?php $start++; ?>
   </td>
   <?php endfor; ?> 
    </tr>
<?php endfor; ?>
  </tbody>
</table>
<?php else :?>
	<p align="center"><em>Здесь статей пока не</em>т</p>
<?php endif;?>
<p  class="add_product"><a href="?view=add_product&amp;type_id=<?=$category;?>">Добавить продукт</a></p>
<?php if($pages_count > 1) pagination($page, $pages_count, $modrew = 0); ?>
</div>
