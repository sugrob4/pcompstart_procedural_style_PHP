<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование страницы</h3>
<?php 
if (isset($_SESSION['edit_page']['res'])) {
	echo $_SESSION['edit_page']['res'];
	unset($_SESSION['edit_page']['res']);
}
?>
	<form action="" method="post">
    	<table class="add_edit_page" cellspacing="0" cellpadding="0">
          <tbody>
              <tr>
                  <td class="add-edit-txt">Сссылка в строке браузера:</td>
                  <td><input class="head-text" type="text" name="link_browser" value="<?=htmlspecialchars($get_page['link_browser']);?>"/></td>
              </tr>
            <tr>
              <td class="add-edit-txt">Название страницы:</td>
              <td><input class="head-text" type="text" name="title" value="<?=htmlspecialchars($get_page['title']);?>"/></td>
            </tr>
              <tr>
                  <td>Мета тег Title (70 символолв):</td>
                  <td><input class="head-text" type="text" name="meta_title" value="<?=htmlspecialchars($get_page['meta_title']);?>"/></td>
              </tr>
              <tr>
                  <td>Ключевые слова:</td>
                  <td><input class="head-text" type="text" name="keywords" value="<?=htmlspecialchars($get_page['keywords']);?>"/></td>
              </tr>
              <tr>
                  <td>Мета описание:</td>
                  <td><input class="head-text" type="text" name="description" value="<?=htmlspecialchars($get_page['description']);?>"/></td>
              </tr>
            <tr>
            <tr>
              <td>Позиция страницы:</td>
              <td><input class="num-text" type="text" name="position" value="<?=$get_page['position'];?>"/></td>
            </tr>
            <tr>
              <td>Содержание страницы:</td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2">
              	<textarea id="editor1" class="full-text" name="text"><?=$get_page['text'];?></textarea>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
</script>
             </td>
            </tr>
          </tbody>
        </table>
        <input type="submit"  value="Сохранить" class="admsave"/>
    </form>  
</div>
