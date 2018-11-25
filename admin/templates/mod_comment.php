<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
    <h3>Редактирование коментариев</h3>
    <?php 
    if (isset($_SESSION['answer'])) {
        echo $_SESSION['answer'];
        unset($_SESSION['answer']);
    }
    ?>
    <table class="tabl" cellspacing="1">
        <tr>
            <th class="number">product_id</th>
            <th class="str_name">Username</th>
            <th class="str_sort">Дата</th>
            <th class="str_action">Просмотр</th>
        </tr>
    <?php if($count_comments) : ?>
    <?php foreach ($count_comments As $key => $item) : ?>
        <tr >
          <td><?=$item['product_id'];?></td>
            <td class="name_page"><?=htmlspecialchars($item['name']);?></td>
            <td><?=$item['date_comment'];?></td>
            <td><a href="?view=show_comment&amp;comment_id=<?=$item['comment_id'];?>" class="edit_comm">Просмотреть</a></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php if($pages_count > 1) pagination($page, $pages_count, $modrew = 0); ?>
    <?php else : ?>
        <p><em>Коментариев для модерации нет</em></p>
    <?php endif; ?>
</div>
