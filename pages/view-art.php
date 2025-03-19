<?php
$page_title = "Art Information";
$page_location = "/view-art";
$heading = "CatBun Art";
$nav_home = "active";

$art_id = ($_GET["art_id"] == "" ? NULL : (int)$_GET["art_id"]); // untrusted

if ($art_id) {
	$artwork = exec_sql_query(
		$db,
		"SELECT * FROM art WHERE id = :art_id;",
		array(
			":art_id" => $art_id
		)
	)->fetch();

	if (count($artwork) > 0) {
		$art = $artwork[0];
	}
} else {
	$art = NULL;
}

$file_path_str = "public/uploads/images/" . $artwork["file_path"];
?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
	<?php include "includes/nav.php" ?>

	<main class="view-art-main">
		<?php if ($art == NULL) { ?>
			<div class="invalid-msg">
				<p>Invalid Request <?php echo htmlspecialchars($art_id); ?>.</p>
				<p>Return <a href="/">Home</a>.
			</div>

		<?php } else { ?>
			<div class="view-art-left">
				<!-- information of image here -->
				<a class="art-back" href="/">
					<img class="arrow" src="public/uploads/images/arrow.png" alt="">
					Back
				</a>

				<div class="left-side-child">
					<div class="art-header">
						<p class="art-view-title"><?php echo htmlspecialchars($artwork["title"]) ?></p>
					</div>


					<div class="art-info">

						<dl class="art-view-info">
							<dt>Year Created</dt>
							<dd><?php echo htmlspecialchars($artwork["yr"]) ?></dd>

							<dt>Description</dt>
							<dd><?php echo htmlspecialchars($artwork["descr"]) ?></dd>
						</dl>
						<!-- <p class="tags-p">Tags</p> -->
						<?php include "includes/art-tags.php" ?>

					</div>


				</div>

			</div>
			<div class="view-art-right">

				<!-- close up image here -->
				<picture>
					<img class="view-image" src="<?php echo htmlspecialchars($file_path_str); ?>" alt="">
				</picture>

			</div>

			</div>
		<?php } ?>

	</main>




	<?php include "includes/footer.php" ?>

</body>

</html>
