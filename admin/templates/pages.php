<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование страниц</h3>
<?php 
if (isset($_SESSION['answer'])) {
	echo $_SESSION['answer'];
	unset($_SESSION['answer']);
}
?>
<p><a href="?view=add_page">Добавить страницу</a></p>   
    <div class="content_list">
        <ul>
         <?php foreach ($cheifinformers as $key) :?>
          <li>
              <a href="#"><?=$key['title'];?></a><span>position: (<?=$key['position'];?>)</span>
              <a class="edit" href="?view=edit_page&amp;page_id=<?=$key['page_id'];?>">Изменить</a>
              <a class="delete" href="?view=del_page&amp;page_id=<?=$key['page_id'];?>">Удалить</a>
          </li>
          <?php endforeach; ?>
        </ul>
    </div>
<p><a href="?view=add_page">Добавить страницу</a></p> 
</div>