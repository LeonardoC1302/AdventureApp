<h1 class='page-name'>Password Reset</h1>
<p class="page-description"> Enter your email address below, and we will send you a link to reset your password</p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form action="/forgot" class="form" method='POST'>

    <div class="field">
        <label for="email">E-mail</label>
        <input type="email" id='email' placeholder="Your email" name='email'>
    </div>

    <input type="submit" class='button' value='Send Link'>
</form>

<div class="actions">
    <a href="/">Already have an account? Log In</a>
    <a href="/register">Don't have an account? Register</a>
</div>