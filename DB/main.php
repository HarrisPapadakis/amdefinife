<!DOCTYPE html>
<html>
	<body>
		<h1>
		<?php
			include "create_db.php";
			if (isset($_SESSION['error'])) {
				include "form_view_error.php";
			}
			include "form_modify_phone_book.php";

			try {
				$mysqli = createDB("my_db");
				mysqli_close($mysqli);
			} catch (Exception $e) {
				echo $e->getMessage(). "<br>";
				mysqli_close($mysqli);
			}
			include "form_view_phone_book.php";
		?>
		</h1>
	</body>
</html>