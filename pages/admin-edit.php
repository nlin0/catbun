<?php
$heading = "CatBun Art";
if (is_user_logged_in()) {
	$page_title = "Admin Edit";
	$str_path = http_build_query(array('art_id' => $art_id));
	define("max_size", 1000000);

	//get each artwork
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

	//get tags
	$tags = exec_sql_query(
		$db,
		"SELECT tags.name AS 'tags.name'
            FROM art_tags
            INNER JOIN tags ON art_tags.tags_id = tags.id
            WHERE art_tags.art_id = :art_id;",

		array(':art_id' => $art_id)
	);
	$art_tags = $tags->fetchAll();

	$upload_feed = array(
		"error" => false,
		"large" => false
	);

	if (isset($_POST["upload"])) {
		$upload = $_FILES["drawing"];
		$form_valid = true;

		$upload_name = basename($upload["name"]);
		$upload_ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
		$old_file_path = $artwork["file_path"]; //replace with old name

		$title = $_POST["title"];
		$descr = $_POST["descr"];
		$yr = $_POST["yr"];

		if ($upload["error"] == UPLOAD_ERR_OK) {
			$file_path = basename($upload["name"]);
			$upload_ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
			$upload_storage_path = "public/uploads/images/" . $file_path;

			if (move_uploaded_file($upload["tmp_name"], $upload_storage_path) == false) {
				error_log("Failed to store the uploaded file on the server.");
				$form_valid = false;
			}
		} else if ($upload["error"] == UPLOAD_ERR_NO_FILE) {
			$file_path = $old_file_path;
		} else {
			$form_valid = false;
		}

		if ($form_valid) {
			$result = exec_sql_query(
				$db,
				"UPDATE art SET title = :title, descr = :descr, yr = :yr, file_path = :file_path WHERE id = :art_id",
				array(
					":title" => $title,
					":descr" => $descr,
					":yr" => $yr,
					":file_path" => $file_path,
					":art_id" => $art_id
				)
			);
			$artwork['title'] = $title;
			$artwork['descr'] = $descr;
			$artwork['yr'] = $yr;
		}
	}
	//if the user only uploads info, not images
	elseif (isset($_POST["update_info"])) {
		$title = $_POST["title"];
		$descr = $_POST["descr"];
		$yr = $_POST["yr"];
		$form_valid = true;

		$result = exec_sql_query(
			$db,
			"UPDATE art SET title = :title, descr = :descr, yr = :yr WHERE id = :art_id",
			array(
				":title" => $title,
				":descr" => $descr,
				":yr" => $yr,
				":art_id" => $art_id
			)
		);
		$artwork['title'] = $title;
		$artwork['descr'] = $descr;
		$artwork['yr'] = $yr;
	}

	$file_path_str = "public/uploads/images/" . $artwork["file_path"];
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
		<main class>
			<?php if ($art == NULL) { ?>
				<div class="error">
					<p>Invalid artwork number<?php echo htmlspecialchars($art_id); ?></p>
					<p>Click <a href="/admin" class="edit">here</a> to return to the admin page.</p>
				</div>
			<?php } else { ?>


				<div class="heading">
					<h1 style="margin-left:30px; text-transform:none;">Editing Artwork #<?php echo htmlspecialchars($art_id); ?> </h1>
				</div>

				<div class="button-style-back"><a href="/admin">Back</a></div>

				<div class="flex-center">
					<div>
						<div class="admin-tile-art">
							<picture>
								<img class="adjust-art" src="/<?php echo htmlspecialchars($file_path_str); ?>" alt="">
							</picture>
						</div>
					</div>

					<div>
						<div class="admin-form">
							<form method="post" enctype="multipart/form-data" action="">
								<input type="hidden" name="art_id" value="<?php echo htmlspecialchars($str_path); ?>">
								<?php if ($form_valid) { ?>
									<p class="feedback" style="margin-left:15px;">Success! Head to <a href="/admin" style="color: #48534f; text-decoration:underline; font-style:italic">admin </a> to see changes.</p>
								<?php } ?>
								<div class="flex-margin">
									<label style="font-size:larger; text-decoration:underline;"> Editing Artwork Form </label>
								</div>
								<div class="flex-margin-adjust2">
									<label for="drawing">Select Artwork: </label>
									<input id="drawing" type="file" name="drawing" accept="image/png,image/jpeg" required>
									<input type="hidden" name="max_size" value="<?php echo max_size; ?>">
								</div>

								<div class="flex-margin-adjust2">
									<label for="title">Title: </label>
									<input type="text" id="title" name="title" value="<?php echo htmlspecialchars($artwork['title']); ?>">


								</div>

								<div class="flex-margin-adjust2">
									<label for="descr">Description: </label>
									<textarea id="descr" name="descr"><?php echo htmlspecialchars($artwork['descr']); ?></textarea>
								</div>


								<div class="flex-margin-adjust2">
									<label for="yr">Year: </label>
									<input style ="max-width:70px;" type="number" min="1900" max="2100" step="1" id="yr" name="yr" value ="<?php echo htmlspecialchars($artwork['yr']); ?>">
								</div>

								<input type="hidden" name="art_id" value="<?php echo $art_id; ?>">
								<button type="submit" name="upload">Edit</button>

							</form>
						</div>
					</div>
				</div>
			<?php } ?>
		</main>
	<?php } ?>

	<?php include "includes/footer.php" ?>

</body>

</html>
