<?php
$tags = exec_sql_query(
    $db,
    "SELECT tags.name AS 'tags.name'
    FROM art_tags
    INNER JOIN tags ON art_tags.tags_id = tags.id
    WHERE art_tags.art_id = :art_id;",
    array(':art_id' => $art_id)
);

$art_tags = $tags->fetchAll();

?>
