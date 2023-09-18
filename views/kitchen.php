<?php $title = "Profile"; ?>

<?php require_once('profileTemplate.php') ?>


<?php ob_start() ?>

<!--<link rel="stylesheet" href="path to the file">-->
<style>
    /* CSS for this page is here! */
    /*body {
        display: grid;
        grid-template-columns: 300px 1fr;
        grid-template-rows: 80px 1fr 1fr 1fr;
    }

    .logo {
        grid-row-start: 1;
        grid-row-end: 2;
        grid-column-start: 1;

    }

    .profilemenu {
        grid-row-start: 2;
        grid-row-end: 5;
        grid-column-start: 1;
        grid-column-end: 2;
        height: 90vh;
        background-color: var(--tertiary-bg-color);
    }

    .profilemenu ul {
        display: flex;
        flex-direction: column;
    }

    .search-container {
        grid-row-start: 1;
        grid-row-end: 2;
        grid-column-start: 2;
        grid-column-end: 3;
    }

    .liked-recommend-buttons {
        grid-row-start: 2;
        grid-row-end: 3;
        grid-column-start: 2;
    }

    .liked-recommend {
        display: flex;
        flex-direction: row;
    }

    .recommended-recipes,
    .liked-recipe {
        width: 90vw;
    }

    .recipe-links {
        display: inline-block;
        width: 30px;
    }

    .recipe-links img {
        height: 20px;
    }*/
</style>

<?php $style = ob_get_clean() ?>
<div class="kitchen">
    <h1>My Kitchen</h1>
    <div class="add-groceries">
        <h2>Edit Groceries</h2>
        <div class="add-groceries"></div>
    </div>
</div>


<?php ob_start() ?>


<?php $content = ob_get_clean() ?>


<?php ob_start() ?>
<?= $content2 ?>


<script src='path to the file'>
    /* JScript for this page is here! */
</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php') ?>