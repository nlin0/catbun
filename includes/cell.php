<?php
$tags = exec_sql_query(
  $db,
  "SELECT tags.name AS 'tags.name'
            FROM art_tags
            INNER JOIN tags ON art_tags.tags_id = tags.id
            WHERE art_tags.art_id = :art_id;",
  array(':art_id' => $art_id)
);

$file_path_str = "public/uploads/images/" . $file_path;

$str_path = http_build_query(array('art_id' => $art_id)); ?>

<li class="catalog-tile-li">
  <div class="tile">
    <div class="tile-art">
      <picture>
        <a href="/view-art?<?php echo $str_path ?>">
          <img class="art-image" src="<?php echo htmlspecialchars($file_path_str); ?>" alt="artwork">
        </a>
      </picture>
    </div>

    <div class="text-box">
      <div class="tile-heading">
        <h3><?php echo htmlspecialchars($title); ?></h3>
        <p class="date"><?php echo htmlspecialchars($yr); ?></p>
      </div>
      <p class="descr"><?php echo htmlspecialchars($descr); ?></p>
    </div>

  </div>
</li>
