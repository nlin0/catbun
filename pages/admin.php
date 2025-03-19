<?php
$heading = "CatBun Art";
if (is_user_logged_in()) {
  $page_title = "Admin";
  $page_location = "/admin";
  $tag_active = "";
  $ad_home = "active";

  $sql = "SELECT art.id AS 'art.id',
        art.file_path AS 'art.file_path',
        art.title AS 'art.title',
        art.descr AS 'art.descr',
        art.yr AS 'art.yr'
        FROM art";

  $tag_param = $_GET["tag"] ?? NULL;

  if ($tag_param) {
    $sql .= " INNER JOIN
        art_tags ON art.id = art_tags.art_id
        INNER JOIN tags ON art_tags.tags_id = tags.id
        WHERE tags.name = :tag";

    $params = array(':tag' => $tag_param);
  }
  $sql .= "";
  $res = exec_sql_query($db, $sql, $params);
  $recs = $res->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
  <?php include "includes/nav.php" ?>
  <?php if (!is_user_logged_in()) { ?>
    <div class="error">
      <p class="lock-message">Only admins may access this page.</p>
      <p><a class="signinout-but" href="/" class="edit">Take me back home!</a></p>
      <div class="sign-in">
				<a class="signinout-but" href="/sign-in">Sign In</a>
			</div>
    </div>
  <?php } ?>

  <?php if (is_user_logged_in()) { ?>
    <div class="main">
      <div class="left-sidebar">

        <ul class="tag-list">
          <li class="view-all-button"><a class="<?php echo empty($tag_param) ? 'active-tag' : ''; ?>" href="/admin">All Works</a></li>
        </ul>

        <ul class="tag-list">
          <?php
          // Fetch all available tags
          $tags = exec_sql_query($db, "SELECT * FROM tags")->fetchAll();
          foreach ($tags as $tag) {
            $tag_name = $tag['name'];
            $active_class = ($tag_param === $tag_name) ? "active-tag" : "";
            echo "<li><a class='$active_class' href='/admin?tag=$tag_name'>$tag_name</a></li>";
          }
          ?>
        </ul>
      </div>

      <main class="right-main">
        <!-- DISPLAYING ART -->

        <div class="flex">
          <h1 style="text-transform: none;"> Admin Dashboard </h1>
          <div class="button-style"><a href="/admin/upload">Add entry</a></div>
        </div>


        <table>

          <tr class="table-heading">
            <th>Art</th>
            <th>Title</th>
            <th>Description</th>
            <th>Year</th>
            <th>Tags</th>
          </tr>

          <?php

          // tile for each rec
          foreach ($recs as $rec) {
            $art_id = $rec["art.id"];
            $file_path = "public/uploads/images/" . $rec["art.file_path"];
            $title = $rec["art.title"];
            $descr = $rec["art.descr"];
            $yr = $rec["art.yr"];
            include "includes/admin-cell.php";
          }; ?>

        </table>

        <!-- Digital Art Source: (original work) Nicole Lin, Shihan Gao -->
      </main>
    </div>
  <?php } ?>
  <?php include "includes/footer.php" ?>
</body>

</html>
