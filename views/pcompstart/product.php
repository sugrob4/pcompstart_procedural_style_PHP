<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="view-detali" align="justify">
<?php if($product) :?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?=PATH;?>"
  },
  "articleSection": "<?=$brand_name[0]['type_name']?>",
  "headline": "<?=$product['title'];?>",
  "url": "<?=PATH.$brand_name[0]['link_browser_type'];?>/<?=$product['product_id'];?>-<?=$product['link_browser'];?>",
  "datePublished": "<?=date('Y-m-d', strtotime($product['date']));?>",
  "dateModified": "<?=date('Y-m-d', strtotime($product['date']));?>",
  "author": {
    "@type": "Person",
    "name": "Mordechai Aleksey Povar"
  },
   "publisher": {
    "@type": "Organization",
    "name": "pcompstart",
    "telephone": "+972546252817",
    "address": "Israel",
    "logo": {
      "@type": "ImageObject",
      "url": "https://pcompstart/userfiles/upload/images/img_icon/loginkontakts.png",
      "width": 141,
      "height": 50
    }
  },
  <?get_prod_data($product['content']);?>
}
</script>
<style>
  .raising{cursor:zoom-in;cursor:-moz-zoom-in;cursor:-webkit-zoom-in;}
  #magnify{display:none;position:fixed;max-width:100em;height:auto;z-index:9999}
  #magnify img{width:100%;-ms-interpolation-mode:bicubic}
  #overlay{display:none;position:fixed;top:0;left:0;height:100%;width:100%;z-index:9990}
  #overlay:hover{cursor:zoom-out;cursor:-moz-zoom-out;cursor:-webkit-zoom-out}
  #close-popup{width:1.9em;height:1.9em;background:#fff;border:1px solid #afafaf;border-radius:15px;cursor:pointer;position:absolute;top:15px;right:15px}
  #close-popup i{width:1.9em;height:1.9em;background:url(<?=PATH.TEMPLATE;?>images/cross.png) no-repeat center center;background-size:1.1em;display:block}
  #close-popup:hover{background:#7B2206}
  #close-popup i{height:1.9em;background:url(<?=PATH.TEMPLATE;?>images/cross.png) no-repeat center center;display:block;}
  #close-popup i:hover{background:url(<?=PATH.TEMPLATE;?>images/cross_active.png) no-repeat center center;}
  @media only screen and (max-width:1367px){#magnify{max-width:59em}}
  @media only screen and (max-width:961px){.#magnify{max-width:50em !important}}
</style>
      <div class="krohi">
          <a href="<?=PATH;?>">Главная&nbsp;</a>&raquo;
          <a href="<?=PATH.$brand_name[0]['link_browser_type'];?>">
		  <?=$brand_name[0]['type_name']?></a>
          &raquo;<span class="krohispan"><?=$product['title'];?></span>
      </div>
      <div class="view-text">
      <h1><?=$product['title'];?></h1>
      <?if (strpos($product['content'], 'class="raising"') == true):?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script async src="<?=PATH.TEMPLATE;?>js/jquery-ui.min.js"></script>
        <script async src="<?=PATH.TEMPLATE;?>js/raising.js"></script>
      <?endif;?>
      <?=get_seo_content($product['content'], $product['title']);?>
      <p align="right" class="prod_date"><?=$product['date'];?></p>
	  <p style="text-indent: 0;">Ещё статьи, которые могут заинтересовать:<br />
      <?php for ($i = 0; $i < count($select_p); $i++) : ?>
        <a href="<?=PATH.$select_p[$i]['products_typeid'];?>/<?=$select_p[$i]['product_id'];?>-<?=$select_p[$i]['link_browser'];?>" target="_blank"><?=$select_p[$i]['title']?></a><br />
      <?php endfor; ?>
      </p>
      </div>
    </div>
<div id="comments">
    <?php if($comments) : ?>
  		<h2>Коментарии(<?=count($comments);?>)</h2>
        <div class="form_comm">
        	<form method="post">
				<table>
                  <tbody>
                    <tr>
                      <td>Имя: </td>
                      <td><input type="text" name="name_comm" maxlength="35" value="<?=htmlspecialchars($_SESSION['name_comm']);?>"></td>
                    </tr>
                    <tr>
                      <td>Коомментарий: </td>
                      <td style="padding-bottom:0 !important;">
                      	<textarea class="comment_textarea" id="text" name="comment" rows="3"><?=nl2br(htmlspecialchars($_SESSION['comment']));?></textarea>
                      </td>
                    </tr>
                    <tr>
                    <td></td>
                      <td>
                      	<div class="smiles">
							<?php foreach ($smiles As $smile) : ?>
                                <span>
                                    <img class="smile" src="<?=PATH.TEMPLATE;?>images/<?=$smile['smile_name'];?>" alt="<?=$smile['smile_val'];?>"/>
                                </span>
                            <?php endforeach; ?>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Я робот: </td>
                      <td style="float:left; margin-right:10px;"><input name="aspam" type="checkbox" checked></td>
                      <td class="aspam">(для подтверждения того что вы являетесь человеком, уберите галочку)</td>
                    </tr>
                    <tr>
                      <td colspan="2"><input type="submit" name="submit_comm" value="Добавить комментарий"></td>
                    </tr>
                  </tbody>
                </table>
            </form>
            <a name="res"></a>
        <?php
			echo $_SESSION['res'];
			unset($_SESSION['res']);
			unset($_SESSION['name_comm']);
			unset($_SESSION['comment']);
		?>
  		</div>
			<?php foreach ($comments as $key => $val) : ?>
                 <div class="comment">
               	   <img class="comment_img" src="<?=PRODUCTIMG;?><?=$val['comment_img'];?>" alt=""/>
                    <p class="comment_meta"><?=$val['date_comment'];?>&nbsp;&nbsp;<?=$val['name'];?></p>
                    <p class="comment_text"><?=nl2br(bbTags(smile(htmlspecialchars($val['comment']))));?></p>
  				</div>
            <?php endforeach; ?>
			  <?php else : ?>
               <p align="center" class="else_comments"><em>К этой статье нет коментариев. Вы можете быть первым</em></p>
                       <div class="form_comm">
                    <form method="post">
                        <table>
                          <tbody>
                            <tr>
                              <td>Имя: </td>
                              <td><input type="text" name="name_comm" maxlength="35" value="<?=htmlspecialchars($_SESSION['name_comm']);?>"></td>
                            </tr>
                            <tr>
                              <td>Коомментарий: </td>
                              <td style="padding-bottom:0 !important;">
                              	<textarea name="comment" class="comment_textarea" id="text" rows="3"><?=htmlspecialchars($_SESSION['comment']);?></textarea>
                             </td>
                            </tr>
                            <tr>
                            <td></td>
                              <td>
                                <div class="smiles">
									<?php foreach ($smiles As $smile) : ?>
                                        <span>
                                            <img class="smile" src="<?=PATH.TEMPLATE;?>images/<?=$smile['smile_name'];?>" alt="<?=$smile['smile_val'];?>"/>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>Я робот: </td>
                              <td style="float:left; margin-right:10px;"><input name="aspam" type="checkbox" checked></td>
                              <td class="aspam">(для подтверждения того что вы являетесь человеком, уберите галочку)</td>
                            </tr>
                            <tr>
                              <td colspan="2"><input type="submit" name="submit_comm" value="Добавить комментарий"></td>
                            </tr>
                          </tbody>
                        </table>
                    </form>
                    <a name="res"></a>
                <?php
                    echo $_SESSION['res'];
                    unset($_SESSION['res']);
					unset($_SESSION['name_comm']);
					unset($_SESSION['comment']);
                ?>
                </div>
	<?php endif; ?>  <!--Коментарии-->
 <?php else :?>
 	<div class="error">Такого продукта нет</div>
 <?php endif;?>
 </div>
 <div class="clr"></div>
