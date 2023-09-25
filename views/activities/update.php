<h1 class='page-name'>Update Activity</h1>
<p class="page-description"> Modify the information of the activity</p>

<?php
    include __DIR__ . '/../templates/bar.php';
    include __DIR__ . '/../templates/alerts.php';
?>

<form method="POST" class="form">
    <?php include_once __DIR__ . '/form.php'; ?>
    <input type="submit" class="update-button" value="Update">
</form>