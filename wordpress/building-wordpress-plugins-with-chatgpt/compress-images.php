<?php
/**
* Plugin Name: Compress Images
* Version: 1.0
* Description: A plugin to compress images with different quality options.
* Author: SmallTownDev
*/

// Add admin menu item
function compress_images_menu() {
	add_menu_page(
		'Compress Images',
		'Compress Images',
		'manage_options',
		'compress-images',
		'compress_images_page'
	);

	add_submenu_page(
		'compress-images', // Parent slug
		'Compressed Images List', // Page title
		'Compressed Images List', // Menu title
		'manage_options',
		'compressed-images-list', // Menu slug
		'compressed_images_list_page' // Callback function
	);
}

// Callback function to display admin page content
function compress_images_page() {
	echo '<div class="wrap">';
	echo '<h1>Compress Images Settings</h1>';
	echo '<form method="post" action="" enctype="multipart/form-data">';
	echo '<label for="image">Select an Image:</label>';
	echo '<input type="file" id="image" name="image" accept="image/*"><br>';
	echo '<label for="quality">Select Quality:</label>';
	echo '<select id="quality" name="quality">';
	echo '<option value="low">Low</option>';
	echo '<option value="mid">Mid</option>';
	echo '<option value="high">High</option>';
	echo '</select><br>';
	echo '<input type="submit" name="compress" value="Compress Image">';
	echo '</form>';
	echo '</div>';
}

function compressed_images_list_page() {
	include plugin_dir_path(__FILE__) . 'admin/compressed-images-list.php';
}

add_action('admin_menu', 'compress_images_menu');


if (isset($_POST['compress'])) {
	$image = $_FILES['image'];
	$quality = $_POST['quality'];

	// Additional validations and security checks can be done here

	// Directory to store compressed images
	$uploadDir = plugin_dir_path(__FILE__) . 'compressed-images/';

	// Create the directory if it doesn't exist
	if (!is_dir($uploadDir)) {
		mkdir($uploadDir);
	}

	// Generate a unique filename for the compressed image
	$compressedImageFilename = uniqid('compressed_') . '.jpg';
	$compressedImagePath = $uploadDir . $compressedImageFilename;

	// Load the uploaded image
	$originalImage = imagecreatefromjpeg($image['tmp_name']);

	// Calculate dimensions for the compressed image (e.g., reducing by a certain percentage)
	$newWidth = imagesx($originalImage) * 0.8;
	$newHeight = imagesy($originalImage) * 0.8;

	// Create a new image resource with desired quality
	$compressedImage = imagecreatetruecolor($newWidth, $newHeight);

	// Copy and resize the original image to the compressed image
	imagecopyresampled($compressedImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($originalImage), imagesy($originalImage));

	// Save the compressed image
	imagejpeg($compressedImage, $compressedImagePath, 80); // You can adjust the quality value (0-100) here

	// Clean up resources
	imagedestroy($originalImage);
	imagedestroy($compressedImage);

	// Provide feedback to the user
	echo '<p>Image compressed successfully! <a href="' . $compressedImagePath . '" target="_blank">Download compressed image</a></p>';
}
