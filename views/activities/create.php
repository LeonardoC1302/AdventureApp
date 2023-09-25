<h1 class='page-name'>New Activity</h1>
<p class="page-description"> Fill the form to create a new activity</p>

<?php
    include __DIR__ . '/../templates/bar.php';
    include __DIR__ . '/../templates/alerts.php';
?>

<form action="/activities/create" method="POST" class="form">
    <?php include_once __DIR__ . '/form.php'; ?>
    <input type="submit" class="button" value="Save">
</form>