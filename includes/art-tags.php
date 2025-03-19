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

<div class="tags-view">

	<?php
	foreach ($art_tags as $art_tag) { ?>
		<div class="art-tag">
		<?php echo htmlspecialchars($art_tag['tags.name']);?>
		</div>
		<?php }; ?>

</div>
