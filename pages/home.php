<?php
$page_title = "Home";
$page_location = "/";
$heading = "CatBun Art";
$nav_home = "active";


// opening database
$db = init_sqlite_db("db/site.sqlite", "db/init.sql");

// check qeuery param
$tag_param = $_GET["tag"] ?? NULL;

// Build SQL query to fetch filtered art
$sql = "SELECT art.id AS 'art.id',
        art.file_path AS 'art.file_path',
        art.title AS 'art.title',
        art.descr AS 'art.descr',
        art.yr AS 'art.yr'
        FROM art";

if ($tag_param) {
  $sql .= " INNER JOIN
        art_tags ON art.id = art_tags.art_id
        INNER JOIN tags ON art_tags.tags_id = tags.id
        WHERE tags.name = :tag";

  $params = array(':tag' => $tag_param);
} else {
  $params = array();
}
$sql .= " ORDER BY art.title ASC";

// Execute the SQL query
$res = exec_sql_query($db, $sql, $params);
$recs = $res->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
  <?php include "includes/nav.php" ?>
  <?php include "includes/sign-in.php" ?>
  <div class="main">
    <div class="left-sidebar">

      <ul class="tag-list">
        <li class="view-all-button"><a class="<?php echo empty($tag_param) ? 'active-tag' : ''; ?>" href="/">All Works</a></li>
      </ul>

      <ul class="tag-list">
        <?php
        // Fetch all available tags
        $tags = exec_sql_query($db, "SELECT * FROM tags")->fetchAll();
        foreach ($tags as $tag) {
          $tag_name = $tag['name'];
          $active_class = ($tag_param === $tag_name) ? "active-tag" : "";
          echo "<li><a class='$active_class' href='/?tag=$tag_name'>$tag_name</a></li>";
        }
        ?>
      </ul>

    </div>

    <main class="right-main">
      <!-- DISPLAYING ART -->

      <ul class="tile-list">
        <?php
        // grabbing data
        foreach ($recs as $rec) {
          $art_id = $rec["art.id"];
          $file_path = "public/uploads/images/" . $rec["art.file_path"];
          $title = htmlspecialchars($rec["art.title"]);
          $descr = htmlspecialchars($rec["art.descr"]);
          $yr = htmlspecialchars($rec["art.yr"]);
        }

        // tile for each rec
        foreach ($recs as $rec) {
          $art_id = $rec["art.id"];
          $file_path = $rec["art.file_path"];
          $title = $rec["art.title"];
          $descr = $rec["art.descr"];
          $yr = $rec["art.yr"];

          include "includes/cell.php";
        }; ?>

        <!-- Digital Art Source: (original work) Nicole Lin, Shihan Gao -->
      </ul>

    </main>
  </div>

  <?php include "includes/footer.php" ?>

</body>

</html>
