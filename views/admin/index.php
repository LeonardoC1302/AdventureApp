<h1 class='page-name'>Admin Panel</h1>

<?php 
    include_once __DIR__ . '/../templates/bar.php';
?>

<h2>Filter Reservations</h2>
<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Date</label>
            <input type="date" id="date" name="date">
        </div>
    </form>
</div>
<div class="admin-reservations"></div>