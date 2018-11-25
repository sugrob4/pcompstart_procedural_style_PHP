<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="page">
	<?php if($get_page) :?>
		<?php if($get_page['position'] == 4) : ?>
            <h3><?=$get_page['title'];?></h3>
                <?=$get_page['text'] = str_replace('http://', 'https://', $get_page['text']);?>
                <p style="text-align:center; margin-bottom:20px;"><span style="color:#FF0000;">Обратная связь</span></p>
                <form method="post" action="">
                    <table class="table_mail">
                        <tr>
                        	<td>* Имя:</td> 
                            <td><input type="text" name="name_mail" value="<?=htmlspecialchars($_SESSION['submit_mail']['name_mail']);?>"/></td>
                        </tr>
                        <tr>
                        	<td>* e-mail:</td> 
                            <td><input type="text" name="mail" value="<?=htmlspecialchars($_SESSION['submit_mail']['mail']);?>"/></td>
                        </tr>
                        <tr>
                          <td>Я робот: </td>
                          <td style="float:left; margin-right:10px;"><input name="aspam" type="checkbox" checked></td>
                          <td class="aspam">(для подтверждения того что вы являетесь человеком, уберите галочку)</td>
                       </tr>
                        <tr>
                        	<td>* Сообщение:</td> 
                            <td><textarea rows="3" name="text_mail"><?=htmlspecialchars($_SESSION['submit_mail']['text_mail']);?></textarea></td>
                        </tr>
                        <tr>
                        	<td colspan="2" class="mail_input"><input type="submit" name="submit_mail" class="submit_mail" value="Отправить" /></td>
                        </tr>
                    </table>
                </form>
                <?php 
					if (isset($_SESSION['submit_mail']['res'])) {
					  echo $_SESSION['submit_mail']['res'];
					  unset($_SESSION['submit_mail']);
					}
				?>
         <?php else : ?>
                <h3><?=$get_page['title'];?></h3>
                <?=$get_page['text'];?>
         <?php endif; ?>
    <?php else :?>
        <p>Такой страницы нет!</p>
    <?php endif;?>
    <div class="clr"></div>
</div>

