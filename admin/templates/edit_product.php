<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование продукта</h3>
<?php 
if (isset($_SESSION['edit_product']['res'])) {
	echo $_SESSION['edit_product']['res'];
	unset($_SESSION['edit_product']);
}
?>
<div id="product_id" style="display: none;"><?=$get_product['product_id']?></div>
<form action="" method="post" enctype="multipart/form-data">
    <table cellspacing="0" cellpadding="0" class="add_edit_page">
        <tbody>
            <tr>
              <td class="add-edit-txt">Название продукта:</td>
              <td><input type="text" class="head-text" name="name" value="<?=htmlspecialchars($get_product['title']);?>"></td>
            </tr>
            <tr>
                <td class="add-edit-txt">Сссылка в строке браузера:</td>
                <td><input type="text" class="head-text" name="link_browser" value="<?=htmlspecialchars($get_product['link_browser']);?>"></td>
            </tr>
            <tr>
                <td class="add-edit-txt">Мета тег Title (70 символолв):</td>
                <td><input type="text" class="head-text" name="meta_title" value="<?=htmlspecialchars($get_product['meta_title']);?>"></td>
            </tr>
            <tr>
              <td class="add-edit-txt">Ключевые слова:</td>
              <td><input type="text" class="head-text" name="keywords" value="<?=htmlspecialchars($get_product['keywords']);?>"></td>
            </tr>
            <tr>
              <td class="add-edit-txt">Мета описание:</td>
              <td><input type="text" class="head-text" name="description" value="<?=htmlspecialchars($get_product['description']);?>"></td>
            </tr>
            <tr>
              <td>Раздел:</td>
              <td>
                <select class="select-inf" name="category" multiple="multiple"  size="10" style="height:auto;">
                    <?php foreach ($cat As $key => $item) : ?>
                        <option <?php if($item['link_browser_type'] == $type_id) echo "selected" ?> value="<?=$item['link_browser_type'];?>"><?=$item['type_name'];?></option>
                    <?php endforeach; ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Иконка продукта: <br />
                <span class="small">Для удаления картинки кликните по ней</span></td>
              <td class="baseimg"><?=$baseimg;?></td>
            </tr>
            <tr>
              <td>Краткое описание (anons):</td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2">
                <textarea id="editor1" class="anons-text" name="anons"><?=htmlspecialchars($get_product['anons']);?></textarea>
            <script type="text/javascript">
            CKEDITOR.replace( 'editor1' );
            </script>
              </td>
            </tr>
            <tr>
              <td>Подробное описание:</td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2">
                <textarea id="editor2" class="anons-text" name="content"><?=htmlspecialchars($get_product['content']);?></textarea>
            <script type="text/javascript">
            CKEDITOR.replace( 'editor2' );
            </script>
              </td>
            </tr>
            <tr>
                <td class="add-edit-txt">Дата:</td>
                <td><input type="date" class="head-text" name="date" value="<?=htmlspecialchars($get_product['date']);?>" style="width:25%;"></td>
            </tr>
            <tr>
              <td>Показывать:</td>
              <td><input type="radio" value="1" name="visible" <?php if($get_product['visible']) echo 'checked';?> >Да<br />
                    <input type="radio" value="0" name="visible" <?php if(!$get_product['visible']) echo 'checked';?>>Нет</td>
            </tr>
        </tbody>
    </table>
   <input type="submit"  value="Сохранить" class="admsave"/>
</form>
</div>
