<?php $title = "Profile"; ?>

<?php /*require_once('profileTemplate.php')*/ ?>


<?php ob_start() ?>

<!--<link rel="stylesheet" href="path to the file">-->
<style>
    /* CSS for this page is here! */

    span {
        padding: 10px;
    }
</style>

<?php $style = ob_get_clean() ?>

<?php ob_start() ?>
<div class="kitchen-container">
    <h1>My Kitchen</h1>
    <!--<div class="edit-groceries-container">
        <h2>Edit Groceries</h2>
        <div class="groceries">
            <!<form class="edit-groceries-form" action="#" method="GET">-->
    <!--<input type="hidden" name="action" value="search">
            <input type="text" id="input-box" placeholder="Add Items Here" name="addItems">
            <button onclick="addGrocery()">+</button>
            <!</form>
        </div>
        <ul class="list-container">
            <li>Apple</li>
            <li>whole wheat bread</li>
            
        </ul>
    </div>
    <div class="edit-appliances-container">
        <h2>Edit Appliances</h2>
        <div class="appliances"></div>
        <input type="text" id="input-bo" placeholder="Add Items Here" name="addItems">
        <button onclick="addAppliances()">+</button>
    </div>-->
    <form class="groceries-form" autocomplete="off">
        <div>
            <input type="text" name="add-groceries-input" id="add-groceries-input" placeholder="Add groceries...">
        </div>
        <ul class="grocery-list"></ul>
        <button>+</button>

</div>
</div>


<?php $content = ob_get_clean() ?>


<?php ob_start() ?>

<script>
    //let ingredients = ['syrup', 'eggs', 'mushrooms', 'caramel', 'chicken', 'broth', 'orange', 'brown rice', 'white rice', 'white bread', 'whole wheat bread', 'oatmeal', 'corn', 'cornbread mix'];
    let searchedGrocery = document.getElementById('add-groceries-input');
    let button = document.querySelector('button');

    searchedGrocery.addEventListener("keyup", (e) => {
        console.log('hello')
        removeElements();
        let xhr = new XMLHttpRequest();

        // for (let r of ingredients) {
        if (searchedGrocery.value != "") {
            xhr.open(
                "GET",
                `?action=groceriesByLetter&add-groceries-input=${searchedGrocery.value}`
            )
            xhr.send();
            xhr.addEventListener("load", (e) => {
                let message = JSON.parse(xhr.responseText);
                message = message[0];

                console.log('yoyo', message)

                for (let m = 0; m < message.length; m++) {

                    console.log("hi", message[m]);
                    console.log(message);

                    let listItem = document.createElement("li");

                    listItem.classList.add('rec-items');
                    listItem.style.cursor = "pointer";
                    //listItem.setAttribute("onclick", "displayNames('" + i + "')");

                    listItem.innerHTML = message[m].ingredient_name;
                    document.querySelector('.grocery-list').appendChild(listItem);
                }
            })
            // let listItem = document.createElement("li");

            // listItem.classList.add('rec-items');
            // listItem.style.cursor = "pointer";
            // //listItem.setAttribute("onclick", "displayNames('" + i + "')");

            // // listItem.innerHTML = message;
            // document.querySelector('.grocery-list').appendChild(listItem);
            // }

        }
    })

    function removeElements() {
        let items = document.querySelectorAll('.rec-items');
        items.forEach((item) => {
            item.remove();
        });
    }
    /* JScript for this page is here! */

    // let inputBox = document.getElementById('input-box');
    // let listContainer = document.querySelector('.list-container')

    // function addGrocery() {
    //     if (inputBox.value === '') {
    //         alert('You must write something!');
    //     } else {
    //         let li = document.createElement('li');
    //         li.innerHTML = inputBox.value;
    //         listContainer.appendChild(li);
    //         let span = document.createElement("span");
    //         span.innerHTML = "\u00d7";
    //         li.appendChild(span);
    //     }
    //     inputBox.value = "";
    // }

    // listContainer.addEventListener("click", function(e) {
    //     if (e.target.tagName === "SPAN") {
    //         e.target.parentElement.remove();
    //     }
    // })
</script>

<?php $script = ob_get_clean() ?>

<?php require_once('template.php') ?>