<?php /* Smarty version 2.6.26, created on 2014-11-24 21:45:28
         compiled from login.tpl */ ?>
<div>
  <form method="POST" action="index.php?controllerAction=Login">

    <div>
      <input type="text" name="username" placeholder="username">
      <input type="password" name="password" placeholder="password">
      <input type="submit" value="Login">
    </div>

    <div>
      <input type="checkbox" name="keepLogged"/> Ricordami
    </div>

  </form>
</div>

<div>
  <form method="POST" action="recoverPass">
    <a href=""> Password dimenticata ? </a>
  </form>
</div>