<?php


$tags = exec_sql_query(
  $db,
  "SELECT tags.name
    FROM art
    INNER JOIN art_tags ON art.id = art_tags.art_id
    INNER JOIN tags ON art_tags.tags_id = tags.id
    WHERE art.title = '$art_title';"
);

$art_tags = $tags->fetchAll();

// tile for each rec
foreach ($recs as $rec) {
  $tags = $rec["tags.name"];
  include "includes/admin-cell.php";
};
