<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование раздела</h3>
<?php 
if (isset($_SESSION['edit_type']['res'])) {
	echo $_SESSION['edit_type']['res'];
	unset($_SESSION['edit_type']);
}
?>
  <form action="" method="post">
      <table cellspacing="0" cellpadding="0"  class="add_edit_page">
        <tbody>
            <tr>
                <td class="add-edit-txt">Мета тег Title (70 символолв):</td>
                <td><input type="text" class="head-text" name="meta_title" value="<?=$krohi_types['title'];?>"></td>
            </tr>
            <tr>
                <td class="add-edit-txt">Ключевые слова:</td>
                <td><input type="text" class="head-text" name="keywords" value="<?=$krohi_types['keywords'];?>"></td>
            </tr>
            <tr>
                <td class="add-edit-txt">Мета описание:</td>
                <td><input type="text" class="head-text" name="description" value="<?=$krohi_types['description'];?>"></td>
            </tr>
          <tr>
            <td class="add-edit-txt">Название раздела:</td>
            <td><input class="head-text" type="text" name="type_name" value="<?=$krohi_types['type_name'];?>"/></td>
          </tr>
            <tr>
                <td class="add-edit-txt">Сссылка в строке браузера:</td>
                <td><input class="head-text" type="text" name="link_browser_type" value="<?=$krohi_types['link_browser_type'];?>"/></td>
            </tr>
          <tr>
            <td class="add-edit-txt">Описание раздела:</td>
            <td><textarea name="krohi_text" rows="3"><?=$krohi_types['krohi_text'];?></textarea></td>
          </tr>
        </tbody>
      </table>
      <input type="submit"  value="Сохранить" class="admsave"/>
  </form>
</div>
