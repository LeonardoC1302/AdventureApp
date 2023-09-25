<div class="bar">
    <p>Hi <span><?php echo $name ?? '' ?></span>!</p>
    <a class="button" href="/logout">Log Out</a>
</div>


<?php  if(isset($_SESSION['admin'])) { ?>

    <div class="activities-bar">
        <a href="/admin" class="button">Reservations</a>
        <a href="/activities" class="button">Activities</a>
        <a href="/activities/create" class="button">New Activity</a>
    </div>

<?php } ?>