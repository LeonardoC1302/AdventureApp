<h1 class='page-name'>Login</h1>
<p class="page-description"> Log in with your credentials</p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form action="/" class="form" method='POST'>
    <div class="field">
        <label for="email">Email</label>
        <input type="email" id='email' placeholder="Your Email" name='email' value="<?php echo s($auth->email) ?>">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" id='password' placeholder="'Your Password" name='password'>
    </div>

    <input type="submit" class='button' value='Log In '>

</form>

<div class="actions">
    <a href="/register">Don't have an account? Register</a>
    <a href="/forgot">Forgot your password?</a>
</div>