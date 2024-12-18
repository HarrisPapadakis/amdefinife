<form method="post" action="../../classes/register_user_fns.php">
	<table>
		<tr>
			<td colspan="2">Please fill in this form to create an account.</td>
		</tr>
		<tr>
			<td>Type:</td>
			<td>
				<select name="type">
  					<option value="1">Secretary</option>
  					<option value="2">Teacher</option>
  					<option value="3">Student</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Surname:</td>
			<td><input type="text" name="surname" /></td>
		</tr>
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name" /></td>
		</tr>
		<tr>
			<td>Phone:</td>
			<td><input type="text" name="phone" /></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="user" /></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="Password" name="password" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" value="Submit"></td>
		</tr>
	</table>
</form>