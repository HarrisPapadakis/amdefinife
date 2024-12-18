<fieldset name="error_message">
	<legend>Error Phone Book:</legend>
	<label for="error">
		<?php
			echo $_SESSION['error'];
			unset($_SESSION['error']);
		?>
	</label>
</fieldset>