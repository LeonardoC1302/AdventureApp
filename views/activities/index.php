<h1 class='page-name'>Activities</h1>
<p class="page-description"> Activity Administration</p>

<?php
    include __DIR__ . '/../templates/bar.php';
?>

<ul class="activities">
    <?php foreach($activities as $activity) { ?>
        <li>
            <p>Name: <span><?php echo $activity->name; ?></span></p>
            <p>Description: <span><?php echo $activity->description; ?></span></p>
            <p>Price: $<span><?php echo $activity->price; ?></span></p>

            <div class="actions">
                <a class="update-button" href="/activities/update?id=<?php echo $activity->id; ?>">Update</a>
                <form action="/activities/delete" method="POST">
                    <input type="hidden" name="id" value="<?php echo $activity->id; ?>">
                    <input type="submit" class="delete-button" value="Delete">
                </form>
            </div>
        </li>
    <?php } ?>
</ul>