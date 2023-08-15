<div class="wrap">
	<h1>Compressed Images List</h1>
	<table class="widefat">
		<thead>
		<tr>
			<th>Image</th>
			<th>Download</th>
		</tr>
		</thead>
		<tbody>
		<?php
		// Directory path for compressed images
		$uploadDir = plugin_dir_path(__FILE__) . '../compressed-images/';
		$uploadDirURL = plugin_dir_url( __FILE__) . '../compressed-images/';

		// Get all compressed image files
		$compressedImages = glob($uploadDir . '*.jpg');

		foreach ($compressedImages as $imagePath) {
			$imageName = basename($imagePath);
			echo '<tr>';
			echo '<td><img src="' . esc_attr($uploadDirURL) . esc_attr($imageName) . '" width="100"></td>';
			echo '<td><a href="' . esc_attr($imagePath) . '" download="' . esc_attr($imageName) . '">Download</a></td>';
			echo '</tr>';
		}
		?>
		</tbody>
	</table>
</div>