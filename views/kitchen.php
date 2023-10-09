<?php $title = "Profile"; ?>


<?php ob_start() ?>

<link rel="stylesheet" href="views/css/kitchen.css">
<style>
    span {
        padding: 10px;
    }
</style>

<?php $style = ob_get_clean() ?>

<?php ob_start() ?>
<div class="kitchen-container">
    <h1>My Kitchen</h1>
    <div class="kitchen-buttons"><button class="grocery-button">Edit Groceries</button><button class="appliances-button">Edit Appliances</button></div>
    <form class="kitchen-form" autocomplete="off">
        <div class="groceries-list">
            <div>
                <input type="text" name="add-groceries-input" id="add-groceries-input" placeholder="Add groceries...">
                <button type="button" onclick="addGrocery()">+</button>
            </div>
            <ul class="grocery-options"></ul>
            <ul class="grocery-list"></ul>
        </div>
        <div class="appliances-list">
            <div>
                <input type="text" name="add-appliances-input" id="add-appliances-input" placeholder="Add appliances...">
                <button onclick="addAppliance()">+</button>
            </div>
            <ul class="appliance-options"></ul>
            <ul class="appliance-list"></ul>
        </div>
        <input type="submit">
    </form>

</div>
</div>


<?php $content = ob_get_clean() ?>


<?php ob_start() ?>

<script src='views/javascript/kitchen.js'>

</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php') ?>