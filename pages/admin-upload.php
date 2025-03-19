<?php
$heading = "CatBun Art";
if (is_user_logged_in()) {
	$page_title = "Admin Upload";
	$tag = "";

	define("max_size", 1000000);

	// Initialize upload feedback array
	$upload_feedback = [
		"too_large" => false,
		"general_error" => false
	];

	if (isset($_POST["upload"])) {
		$upload = $_FILES["drawings"];
		$form_valid = true;

		$upload_name = basename($upload["name"]);
		$upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION));
		$title = $_POST["title"];
		$descr = $_POST["descr"];
		$yr = $_POST["yr"];

		// Check file size
		if ($upload["size"] > max_size) {
			$upload_feedback["too_large"] = true;
			$form_valid = false;
		}

		// Check file type
		$allowed_extensions = ["png", "jpg", "jpeg"];
		if (!in_array($upload_ext, $allowed_extensions)) {
			$upload_feedback["general_error"] = true;
			$form_valid = false;
		}

		if ($form_valid) {
			// Insert artwork details into database
			$sql = "INSERT INTO art (title, descr, yr, file_path) VALUES (:title, :descr, :yr, :file_path)";
			$params = [
				':title' => $title,
				':descr' => $descr,
				':yr' => $yr,
				':file_path' => '' // Placeholder for now, will be updated after insertion
			];

			$res = exec_sql_query($db, $sql, $params);

			if ($res) {
				// Get the last inserted ID (art_id)
				$art_id = $db->lastInsertId();

				// Generate file name based on art_id
				$file_name = $art_id . '.' . $upload_ext;
				$upload_storage_path = "public/uploads/images/" . $file_name;

				// Move uploaded file to storage with new file name
				if (move_uploaded_file($upload["tmp_name"], $upload_storage_path)) {
					// Update file_path in the database
					$update_sql = "UPDATE art SET file_path = :file_path WHERE id = :id";
					$update_params = [
						':file_path' => $file_name,
						':id' => $art_id
					];

					$update_res = exec_sql_query($db, $update_sql, $update_params);

					if ($update_res) {
						// Redirect to admin.php upon successful upload
						header("Location: /admin");
						exit;
					} else {
						// Handle database update error
						// Display error message or log error
					}
				} else {
					// Handle file move error
					// Display error message or log error
				}
			} else {
				// Handle database insertion error
				// Display error message or log error
			}
		}
	}
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
		<main class="upload-page">

			<div class="heading">
				<h1 style="margin-left:30px; text-transform:none;">Upload Artwork </h1>
			</div>

			<div class="button-style-back"><a href="/admin">Back</a></div>

			<div class="flex-center">
				<div class="admin-form">
					<form class="upload-form" method="post" enctype="multipart/form-data" action="/admin/upload">

						<input type="hidden" name="max_size" value="<?php echo max_size; ?>">

						<div class="flex-margin-adjust2">
							<label style="font-size:larger; text-decoration:underline;"> Uploading Artwork Form </label>
						</div>

						<div class="flex-margin-adjust2">
							<label for="upload-file">Select Art: </label>
							<input id="upload-file" type="file" name="drawings" accept="image/png,image/jpeg" required>
						</div>

						<div class="flex-margin-adjust2">
							<label for="title">Title: </label>
							<input type="text" id="title" name="title" required>
						</div>

						<div class="flex-margin-adjust2">
							<label for="descr">Description: </label>
							<textarea id="descr" name="descr" required></textarea>
						</div>

						<div class="flex-margin-adjust2">
							<label for="yr">Year: </label>
							<input style ="max-width:70px;" type="number" min="1900" max="2100" step="1" id="yr" name="yr" required>
						</div>

						<button type="submit" name="upload">Upload</button>

					</form>
				</div>
			</div>
		</main>
	<?php } ?>
	<?php include "includes/footer.php" ?>
</body>

</html>
