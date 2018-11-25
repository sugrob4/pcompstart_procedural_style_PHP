<div class="catalog-reg">
  <div class="registration">
      <h3>Создать аккаунт</h3>
      <form action="<?=PATH;?>" method="post">
          <table border="0" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="regname">* Имя...</td>
                <td class="regimg"><img src="<?=TEMPLATE;?>images/nameIcon.png" alt=""/></td>
                <td class="reginput"><input type="text" name="name" value="<?=htmlspecialchars($_SESSION['reg']['name']);?>"/></td>
              </tr>
              <tr>
                <td class="regname">* Логин...</td>
                <td class="regimg"><img src="<?=TEMPLATE;?>images/loginIcon.png" alt=""/></td>
                <td class="reginput"><input type="text" name="login" value="<?=htmlspecialchars($_SESSION['reg']['login']);?>"/></td>
              </tr>
              <tr>
                <td class="regname">* Email...</td>
                <td class="regimg"><img src="<?=TEMPLATE;?>images/emailIcon.png" alt=""/></td>
                <td class="reginput"><input type="text" name="email" value="<?=htmlspecialchars($_SESSION['reg']['email']);?>"/></td>
              </tr>
              <tr>
                <td class="regname">* Пароль...</td>
                <td class="regimg"><img src="<?=TEMPLATE;?>images/passIcon.png" alt=""/></td>
                <td class="reginput"><input type="password" name="pass"/></td>
              </tr>
              <tr>
                <td class="regname">* Повторите пароль...</td>
                <td class="regimg"><img src="<?=TEMPLATE;?>images/retryPassIcon.png" alt=""/></td>
                <td class="reginput"><input type="password" name="retrypass"/></td>
              </tr>
            </tbody>
          </table>
           <input name="reg" type="submit" class="inpreg" value="Зарегистрироваться"/>
      </form>
<?php
if (isset($_SESSION['reg']['res'])) {
  echo $_SESSION['reg']['res'];
  unset($_SESSION['reg']);
}
?>
  </div>
</div>
