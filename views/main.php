<?php $title = "Main page TEST"; ?>



<?php ob_start() ?>

<link rel="stylesheet" href="path to the file">
<style>
    /* CSS for this page is here! */
</style>

<?php $style = ob_get_clean() ?>



<?php ob_start() ?>
<div class="recipe">
    <!-- html for this page is here!(you can use PHP variables here from the controller) -->
    hello
</div>

<?php $content = ob_get_clean() ?>



<?php ob_start() ?>

<script src='path to the file'>
    /* JScript for this page is here! */
</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>