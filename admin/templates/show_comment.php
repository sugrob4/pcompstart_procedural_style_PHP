<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Просмотр коментария</h3>
<table class="tabl" cellspacing="1">
    <tr>
        <th class="number">product_id</th>
        <th class="str_name">Username</th>
        <th class="str_sort">Дата</th>
        <th class="str_action">Действие</th>
    </tr>
<?php if($comment) : ?>
    <tr >
      <td><?=$comment['product_id'];?></td>
        <td class="name_page"><?=htmlspecialchars($comment['name']);?></td>
        <td><?=$comment['date_comment'];?></td>
        <td><a href="?view=del_comment&amp;comment_id=<?=$comment['comment_id'];?>" class="del_comm">Удалить</a></td>
    </tr>
    <tr >
    	<td>Коментарий:</td>
        <td style="width:50%; height:100px;"><textarea rows="4" class="textarea_comm"><?=nl2br(htmlspecialchars($comment['comment']));?></textarea></td>
        <td></td>
        <td><a href="?view=mod_comment"  class="edit_comm">Назад к коментариям</a></td>
    </tr>
<?php endif; ?>
</table>
</div>