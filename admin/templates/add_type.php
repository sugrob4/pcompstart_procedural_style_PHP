<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Добавление раздела</h3>
<?php 
if (isset($_SESSION['add_type']['res'])) {
	echo $_SESSION['add_type']['res'];
	unset($_SESSION['add_type']);
}
?>
  <form action="" method="post">
      <table cellspacing="0" cellpadding="0"  class="add_edit_page">
        <tbody>
            <tr>
                <td class="add-edit-txt">Мета тег Title (70 символолв):</td>
                <td><input type="text" class="head-text" name="meta_title"></td>
            </tr>
            <tr>
                <td class="add-edit-txt">Ключевые слова:</td>
                <td><input type="text" class="head-text" name="keywords"></td>
            </tr>
            <tr>
                <td class="add-edit-txt">Мета описание:</td>
                <td><input type="text" class="head-text" name="description"></td>
            </tr>
          <tr>
            <td class="add-edit-txt">Название раздела:</td>
            <td><input class="head-text" type="text" name="type_name"/></td>
          </tr>
            <tr>
                <td class="add-edit-txt">Сссылка в строке браузера:</td>
                <td><input class="head-text" type="text" name="link_browser_type"/></td>
            </tr>
          <tr>
            <td class="add-edit-txt">Добавить описание раздела:</td>
            <td><textarea rows="3" name="krohi_text"></textarea></td>
          </tr>
        </tbody>
      </table>
      <input type="submit"  value="Сохранить" class="admsave"/>
  </form>
</div>
