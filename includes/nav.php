<header>
  <nav>
    <h1 style="opacity:99%"><?php echo $heading ?></h1>

    <ul class="nav-list">
      <li class="<?php echo $nav_home; ?>"><a href="/">Home</a></li>
    </ul>

    <?php if (is_user_logged_in()) { ?>
      <ul class="nav-list">
        <li class="<?php echo $ad_home; ?>"><a href="/admin">Admin</a></li>
      </ul>

      <a class="signinout-but" href="<?php echo logout_url(); ?>">Sign Out</a>
  </nav>

<?php } else { ?>
<?php } ?>
</header>
