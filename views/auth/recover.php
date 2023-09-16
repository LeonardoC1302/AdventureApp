<h1 class='page-name'>Reset Your Password</h1>
<p class="page-description">Enter your new password</p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<?php if($error) return; ?>
<form class="form" method='POST'>
    <div class="field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Your New Password">
    </div>

    <input type="submit" class="button" value="Save Changes">
</form>

<div class="actions">
    <a href="/">Already have an account? Log In</a>
    <a href="/register">Don't have an account? Register</a>
</div>