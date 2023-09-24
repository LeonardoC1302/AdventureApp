<h1 class='page-name'>Admin Panel</h1>

<?php 
    include_once __DIR__ . '/../templates/bar.php';
?>

<h2>Filter Reservations</h2>
<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>">
        </div>
    </form>
</div>

<?php 
    if(count($reservations) === 0){
        echo "<h2>No reservations for this date</h2>";
    }
?>

<div id="admin-reservations">
    <ul class="reservations">
        <?php
            $idReservation = 0;
            foreach($reservations as $key => $reservation) {
                if($idReservation != $reservation->id) {
                    $total = 0;
                    $idReservation = $reservation->id;
        ?>

        <li>
            <p>ID: <span><?php echo $reservation->id; ?></span></p>
            <p>Time: <span><?php echo $reservation->time; ?></span></p>
            <p>Client: <span><?php echo $reservation->client; ?></span></p>
            <p>Email: <span><?php echo $reservation->email; ?></span></p>
            <p>Phone: <span><?php echo $reservation->phone; ?></span></p>

            <h3>Activities</h3>

            <?php } ?> <!-- End if -->
            <p class="activity"><?php echo $reservation->activity . " " . $reservation->price; ?></p>

            <?php 
                $total += $reservation->price;
                $current = $reservation->id;
                $next = $reservations[$key + 1]->id ?? 0;
                if(isLast($current, $next)) { ?>
                    <p class="total">Total: <span>$<?php echo $total; ?></span></p>
                <?php }
            } ?>
    </ul>
</div>


<?php 
    $script = "<script src='build/js/search.js'></script>";
?>