<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>



<!-- register form -->
<form method="post" action="register.php" name="registerform">

  <table>
	<tr>
		<td><label for="login_input_username">Usuario(alias)</label></td>
		<td><input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /></td>
	</tr>
	<tr>
		<td><label for="login_input_name">Nombre</label></td>
		<td><input id="login_input_name" class="login_input" type="text" name="name" required /></td>
	</tr>
	<tr>
		<td><label for="login_input_email">Email</label></td>
		<td><input id="login_input_email" class="login_input" type="email" name="user_email" required /></td>
	</tr>
	<tr>
		<td><label for="login_input_password_new">Password (min. 6 caracteres)</label></td>
		<td><input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /></td>
	</tr>
	<tr>
		<td><label for="login_input_password_repeat">Confirme el password</label></td>
		<td><input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /></td>
	</tr>
	<tr>
		<td><input type="submit"  name="register" value="Register" /></td><td></td>
	</tr>
</table>  
</form>

<!-- backlink -->
<a href="index.php">Back to Login Page</a>
