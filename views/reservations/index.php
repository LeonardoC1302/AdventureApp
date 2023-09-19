<h1 class='page-name'>Make a Reservation</h1>
<p class="page-description"> Choose your activities and fill up your information </p>

<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>


<div class="app">
    <nav class="tabs">
        <button class="active" type="button" data-step="1">Activities</button>
        <button type="button" data-step="2">Reservation</button>
        <button type="button" data-step="3">Summary</button>
    </nav>

    <!-- Activities -->
    <div id="step1" class="section">
        <h2>Activities</h2>
        <p class="text-center">Choose the activities you want to do</p>
        <div id="activities" class="activities-list"></div>
    </div>

    
    <!-- Reservation -->
    <div id="step2" class="section">
        <h2>Your Reservation</h2>
        <p class="text-center">Fulfill the form to complete your reservation</p>
        <form class="form">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" placeholder="Your name" 
                value="<?php echo $name ?>" disabled>
            </div>

            <div class="field">
                <label for="date">Date</label>
                <input type="date" id="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
            </div>

            <div class="field">
                <label for="time">Time</label>
                <input type="time" id="time">
            </div>
        </form>
    </div>


    <!-- Summary -->
    <div id="step3" class="section summary-content">
        <h2>Reservation Summary</h2>
        <p class="text-center">Check your reservation details</p>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <button id="prev" class="button">&laquo; Anterior</button>
        <button id="next" class="button">Siguiente &raquo;</button>
    </div>


</div>

<?php 
    $script = "<script src='build/js/app.js'></script>";
?>