<div class="field">
    <label for="name">Name</label>
    <input type="text" id="name" placeholder="Activity Name" 
    name="name" value="<?php echo $activity->name; ?>">
</div>

<div class="field">
    <label for="price">Price</label>
    <input type="text" id="price" placeholder="Activity Price" 
    name="price" value="<?php echo $activity->price; ?>">
</div>

<div class="field">
    <label for="description">Description</label>
    <textarea id="description" placeholder="Activity Description"
    name="description"><?php echo $activity->description ?></textarea>
</div>