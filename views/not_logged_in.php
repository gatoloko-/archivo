<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>


<!-- login form box -->
<form method="post" action="index.php" name="loginform">

    <table>
	<tr>
		<td><label for="login_input_username">Nombre de usuario</label></td>
		<td><input id="login_input_username" class="login_input" type="text" name="user_name" required /></td>
	</tr>
	<tr>
		<td><label for="login_input_password">Password</label></td>
		<td><input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required /></td>
	</tr>
	<tr>
		<td><input type="submit"  name="login" value="Log in" /></td>
	</tr>
</table>
   
</form>
