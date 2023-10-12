<?php $title = "Recipe"; ?>

<?php ob_start() ?>

<link rel="stylesheet" href="views/css/recipe.css">
<style>
</style>

<?php $style = ob_get_clean() ?>




<?php ob_start() ?>
<?php
if ($_GET['action'] !== 'recipePage') { ?>
    <form class="search-form" action="?action=search" method="GET">
        <input type="hidden" name="action" value="search">
        <input type="text" placeholder="Search Here" id="search" name="search-item" autocomplete="off">
        <button type="submit">Search</button>
        <ul class="search-output"></ul>
    </form>
<?php } ?>
<main class="recipe-container">
    <h1>
        <?= $recipe->getName() ?>
    </h1>
    <div class="picAndButtons">
        <img src="https://spoonacular.com/recipeImages/<?= $recipe->getId() ?>-636x393.jpg" alt="">
        <div class="info-btn-container">
            <div class="likeRecipe">
                <svg class="like-recipe
                <?php if ($isRecipeLiked) { ?>
                                <?= 'favourite-recipe liked' ?> 
                                <?php } else { ?>
                                <?= 'favourite-recipe not-liked' ?> 
                                <?php } ?>
                                " recipe-id=<?= $recipe->getId() ?> width="50" height="43" viewBox="0 0 50 55"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M30 15.0005C25.5015 9.75792 17.9844 8.13775 12.3481 12.9384C6.7117 17.739 5.91817 25.7652 10.3444 31.443C14.0246 36.1635 25.162 46.1198 28.8122 49.3423C29.2205 49.7028 29.4247 49.883 29.663 49.9538C29.8707 50.0155 30.0982 50.0155 30.3062 49.9538C30.5445 49.883 30.7485 49.7028 31.157 49.3423C34.8072 46.1198 45.9445 36.1635 49.6247 31.443C54.051 25.7652 53.3543 17.6885 47.621 12.9384C41.8878 8.18825 34.4985 9.75792 30 15.0005Z"
                        stroke="#2D3142" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div class="time">
                <svg class="timeImg" width="50" height="35" viewBox="0 0 50 50" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6.28888 12.5C3.89568 16.0752 2.5 20.3747 2.5 25C2.5 37.4265 12.5736 47.5 25 47.5C37.4265 47.5 47.5 37.4265 47.5 25C47.5 12.5736 37.4265 2.5 25 2.5V10M25 25L15 15"
                        stroke="#2D3142" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>
                    <?= $recipe->getTimeToCook() ?> min.
                </span>
            </div>
        </div>
    </div>
    <div class="tags">
        <?php if ($recipe->getDiets() !== null) {
            foreach ($recipe->getDiets() as $diet) { ?>
                <button class="tag">
                    <?= $diet ?>
                </button>
            <?php }
        } ?>
    </div>
    <div class="rating">
        <div class="count-rating">
            <?php $recipeManager = new RecipeManager();
            $recipeRating = $recipeManager->fetchRecipeRating($recipe->getId()) ?>
            <?= '(' . $recipeRating["count_rating"] . ')' ?>
        </div>
        <label class="star half" for="<?= $recipe->getId() ?>-star4.5">
            <svg class="halfStar 
                            <?php if ($recipeRating['average_rating'] > 4) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 28 55" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                    stroke="#2D3142" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <label class="star full" for="<?= $recipe->getId() ?>-star5">
                <svg class="fullStar <?php if ($recipeRating['average_rating'] >= 5) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 56 55" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                        stroke="#2D3142" stroke-width="0" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </label>
            <input type="radio" class="radio-button" name="rating-<?= $recipe->getId() ?>"
                id="<?= $recipe->getId() ?>-star5" value="5" hidden>
        </label>
        <input type="radio" class="radio-button half" name="rating-<?= $recipe->getId() ?>"
            id="<?= $recipe->getId() ?>-star4.5" value="4.5" hidden>


        <label class="star half" for="<?= $recipe->getId() ?>-star3.5">
            <svg class="halfStar <?php if ($recipeRating['average_rating'] > 3) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 28 55" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                    stroke="#2D3142" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <label class="star full" for="<?= $recipe->getId() ?>-star4">
                <svg class="fullStar <?php if ($recipeRating['average_rating'] >= 4) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 56 55" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                        stroke="#2D3142" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </label>
            <input type="radio" class="radio-button" name="rating-<?= $recipe->getId() ?>"
                id="<?= $recipe->getId() ?>-star4" value="4" hidden>
        </label>
        <input type="radio" class="radio-button half" name="rating-<?= $recipe->getId() ?>"
            id="<?= $recipe->getId() ?>-star3.5" value="3.5" hidden>


        <label class="star half" for="<?= $recipe->getId() ?>-star2.5">
            <svg class="halfStar <?php if ($recipeRating['average_rating'] > 2) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 28 55" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                    stroke="#2D3142" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <label class="star full" for="<?= $recipe->getId() ?>-star3">
                <svg class="fullStar <?php if ($recipeRating['average_rating'] >= 3) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 56 55" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                        stroke="#2D3142" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </label>
            <input type="radio" class="radio-button" name="rating-<?= $recipe->getId() ?>"
                id="<?= $recipe->getId() ?>-star3" value="3" hidden>
        </label>
        <input type="radio" class="radio-button half" name="rating-<?= $recipe->getId() ?>"
            id="<?= $recipe->getId() ?>-star2.5" value="2.5" hidden>


        <label class="star half" for="<?= $recipe->getId() ?>-star1.5">
            <svg class="halfStar <?php if ($recipeRating['average_rating'] > 1) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 28 55" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                    stroke="#2D3142" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <label class="star full" for="<?= $recipe->getId() ?>-star2">
                <svg class="fullStar <?php if ($recipeRating['average_rating'] >= 2) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 56 55" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                        stroke="#2D3142" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </label>
            <input type="radio" class="radio-button" name="rating-<?= $recipe->getId() ?>"
                id="<?= $recipe->getId() ?>-star2" value="2" hidden>
        </label>
        <input type="radio" class="radio-button half" name="rating-<?= $recipe->getId() ?>"
            id="<?= $recipe->getId() ?>-star1.5" value="1.5" hidden>



        <label class="star half" for="<?= $recipe->getId() ?>-star.5">
            <svg class="halfStar <?php if ($recipeRating['average_rating'] > 0) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 28 55" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                    stroke="#2D3142" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <label class="star full" for="<?= $recipe->getId() ?>-star1">
                <svg class="fullStar <?php if ($recipeRating['average_rating'] >= 1) { ?>
                                <?= 'starFill' ?>
                           <?php } ?>" width="56" height="55" viewBox="0 0 56 55" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M26.245 5.94574C26.8995 4.40596 27.2269 3.63608 27.6826 3.39899C28.0784 3.19301 28.5432 3.19301 28.939 3.39899C29.3948 3.63608 29.7222 4.40596 30.3767 5.94574L35.5901 18.2103C35.7838 18.6654 35.8805 18.893 36.0303 19.0673C36.1626 19.2216 36.3246 19.3449 36.5053 19.4293C36.7097 19.5248 36.946 19.551 37.4188 19.6033L50.1535 21.0127C51.7523 21.1896 52.5515 21.2781 52.9075 21.6593C53.2165 21.9904 53.3601 22.4541 53.2957 22.9125C53.2216 23.4402 52.6245 24.0044 51.4302 25.1331L41.9175 34.1224C41.5646 34.456 41.3879 34.6229 41.2762 34.8259C41.1773 35.0059 41.1154 35.2054 41.0947 35.4118C41.0713 35.6451 41.1205 35.8888 41.2191 36.3765L43.8762 49.5119C44.2098 51.1611 44.3766 51.9856 44.1408 52.4582C43.9358 52.8691 43.5598 53.1554 43.1241 53.2328C42.6226 53.3218 41.9262 52.9008 40.5335 52.0585L29.4409 45.3495C29.0292 45.1005 28.8234 44.9763 28.6046 44.9274C28.4109 44.8844 28.2107 44.8844 28.0171 44.9274C27.7982 44.9763 27.5924 45.1005 27.1808 45.3495L16.0882 52.0585C14.6955 52.9008 13.9992 53.3218 13.4976 53.2328C13.0619 53.1554 12.6858 52.8691 12.481 52.4582C12.2452 51.9856 12.412 51.1611 12.7456 49.5119L15.4025 36.3765C15.5011 35.8888 15.5504 35.6451 15.527 35.4118C15.5063 35.2054 15.4445 35.0059 15.3455 34.8259C15.2337 34.6229 15.0572 34.456 14.7041 34.1224L5.19156 25.1331C3.99731 24.0044 3.40017 23.4402 3.32593 22.9125C3.26147 22.4541 3.40512 21.9904 3.71425 21.6593C4.07014 21.2781 4.86954 21.1896 6.46834 21.0127L19.203 19.6033C19.6757 19.551 19.912 19.5248 20.1163 19.4293C20.2971 19.3449 20.459 19.2216 20.5915 19.0673C20.7412 18.893 20.838 18.6654 21.0315 18.2103L26.245 5.94574Z"
                        stroke="#2D3142" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </label>
            <input type="radio" class="radio-button" name="rating-<?= $recipe->getId() ?>"
                id="<?= $recipe->getId() ?>-star1" value="1" hidden>
        </label>
        <input type="radio" class="radio-button half" name="rating-<?= $recipe->getId() ?>"
            id="<?= $recipe->getId() ?>-star.5" value=".5" hidden>


    </div>

    <div class="recipe-ingredients">
        <div class="in-kitchen-container">
            <h3>Appliances</h3>
            <div class="recipe-appliances">
                <?php
                /** @var EquipmentEntity $equipment */
                ?>
                <?php foreach ($recipeEquipmentsNames as $equipmentName) { ?>
                    <p class="equipments">
                        <span class="equipment">
                            <?= $equipmentName ?>
                        </span>
                    </p>
                <?php } ?>
            </div>
        </div>
        <div class="to-buy-container">
            <h3>Ingredients</h3>
            <div class="to-buy">
                <?php foreach ($ingredientsUserHave as $ingredient) { ?>
                    <p class="green">
                        <span class="ingredient-have-name">
                            <?= $ingredient->getName() ?>
                        </span>
                        <span class="units">
                            <?= $ingredient->getQuantityUs() ?>
                            <?= $ingredient->getUnitUs() ?>
                        </span>
                    </p>
                <?php } ?>
                <?php foreach ($ingredientsUserHaveNot as $ingredient) { ?>
                    <p class="">
                        <span class="ingredient-dont-have-name">
                            <?= $ingredient->getName() ?>
                        </span>
                        <span class="units">
                            <?= $ingredient->getQuantityUs() ?>
                            <?= $ingredient->getUnitUs() ?>
                        </span>
                    </p>

                <?php } ?>
            </div>
        </div>
    </div>
    <div class="directions">
        <h3>Directions</h3>
        <ol>
            <?php foreach ($recipe->getSteps() as $step) { ?>
                <li class="">
                    <p>
                        <?= $step->getDescription() ?>
                    </p>
                </li>
            <?php } ?>
        </ol>

    </div>
</main>

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>


<script src='views/javascript/recipe.js'>
</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php')
    ?>