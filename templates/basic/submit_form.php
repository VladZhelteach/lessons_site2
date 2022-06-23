<?php
if (isset($_COOKIE['user_name']) && isset($_COOKIE['user_role'])) {
?>
<form method="post" action="<?php echo($_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/"); ?>?page=signin">
    <input type="hidden" name="sign_out_button" value="out">
    <button type="submit" class="btn btn-primary">Log out</button>
</form>
<?php
    } else {
?>
<h3>Log in:</h3>
<form method="post" action="<?php echo($_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/"); ?>?page=signin">
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">User:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="sign_in_login" placeholder="Login">
    </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password:</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="sign_in_password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-warning">Reset</button>
</form>
<?php
}
?>

