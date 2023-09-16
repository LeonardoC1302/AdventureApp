<h1 class='page-name'>Register</h1>
<p class="page-description"> Fill the following form to create an account</p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<form action="/register" class="form" method='POST'>

    <div class="field">
        <label for="name">Name</label>
        <input type="text" id='name' placeholder="Your name" name='name' value="<?php echo s($user->name) ?>">
    </div>
    
    <div class="field">
        <label for="lastName">Last Name</label>
        <input type="text" id='lastName' placeholder="Your last name" name='lastName' value="<?php echo s($user->lastName) ?>">
    </div>

    <div class="field">
        <label for="Phone">Phone</label>
        <input type="tel" id='phone' placeholder="Your phone" name='phone' value="<?php echo s($user->phone) ?>">
    </div>

    <div class="field">
        <label for="email">E-mail</label>
        <input type="email" id='email' placeholder="Your email" name='email' value="<?php echo s($user->email) ?>">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" id='password' placeholder="Your password" name='password'>
    </div>

    <input type="submit" class='button' value='Create Account'>

</form>

<div class="actions">
    <a href="/">Already have an account? Log In</a>
    <a href="/forgot">Forgot your password?</a>
</div>