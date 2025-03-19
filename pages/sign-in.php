<?php
$heading = "CatBun Art";

?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/meta.php" ?>

<body class="sign-in-body">
  <header>
    <nav>
      <h1 style="opacity:99%"><?php echo $heading ?></h1>

      <ul class="nav-list">
        <li class="<?php echo $nav_home; ?>"><a href="/">Home</a></li>
      </ul>
  </header>


  <div class="signin-form">
    <h2>Log In</h2>

    <div class="login-box">
      <?php echo login_form('/admin', $session_messages); ?>
    </div>


  </div>

  <?php include "includes/footer.php" ?>
</body>
