<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div id="right-bar">
  <div class="enter">
    <pre class="title_enter">Авторизация</pre>
    <div class="authform">
<?php if(!$_SESSION['auth']['user']) :?>
<form action="#" method="post">
	<label for="login">Логин: </label>
    <input type="text" name="login" class="login" id="login"/>
    <img src="<?=PATH.TEMPLATE;?>images/ImgLogin.png" class="imglog" alt="ImgLogin"/>
    <label for="pass">Пароль:</label>
    <img src="<?=PATH.TEMPLATE;?>images/ImgPass.png" class="imgpass" alt="ImgPass"/>
  <input type="password"  name="pass" class="pass" id="pass"/>
  <a href="<?=PATH;?>registration">Регистрация</a>
  <input type="submit"  name="auth" id="auth" value="Войти" class="auth"/>
</form>
<?php
if (isset($_SESSION['auth']['error'])) {
	echo '<div class="error">'. $_SESSION['auth']['error'].'</div>';
	unset($_SESSION['auth']);
}
?>
<?php else :?>
	<p class="welcome">Добро пожаловать <br /> <?=htmlspecialchars($_SESSION['auth']['user'])?></p>
    <a href="<?=PATH;?>?do=logout" class="logout">Выход</a>
<?php endif;?>
    </div>
  </div>
    <div class="go_to_playmark">
      <a href="https://play.google.com/store/apps/details?id=com.pcompstart.pcompmob&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1" target="_blank">
          <img src="<?=PATH.TEMPLATE;?>images/ru_badge_web_generic.svg" alt="Get it on Google Play">
      </a>
    </div>
    <noindex><!--googleoff: all--><div class="socialicons">
        <p>Понравилась статья?</p>
        <p>Поделись с друзьями в соц. сетях.</p>
        <div class="socialsdiv">
<script async src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script async src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus,twitter"></div>
        </div>
    </div><!--googleon: all--></noindex>
</div>
