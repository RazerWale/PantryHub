<?php $title = "TEST TEST"; ?>



<?php ob_start() ?>

<style>
    .clown {
        color: red;
    }
</style>

<?php $style = ob_get_clean() ?>


<?php ob_start() ?>

<div class="clown">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nisi ipsum aut nostrum nesciunt obcaecati.
    Iusto fugiat voluptate, facilis possimus animi rem recusandae reiciendis. Fuga dignissimos asperiores quisquam ipsam
    aspernatur numquam?</div>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>

<script src='path to the file'>
    /* JScript for this page is here! */
</script>

<?php $script = ob_get_clean() ?>


<?php require_once('template.php') ?>