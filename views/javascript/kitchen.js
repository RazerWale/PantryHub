let searchedGrocery = document.getElementById('add-groceries-input');
let groceryList = document.querySelector(".grocery-list")

searchedGrocery.addEventListener("keyup", (e) => {
    removeElements();
    let xhr = new XMLHttpRequest();

    if (searchedGrocery.value != "") {
        xhr.open(
            "GET",
            `?action=groceriesByLetter&add-groceries-input=${searchedGrocery.value}`
        )
        xhr.send();
        xhr.addEventListener("load", (e) => {
            let message = JSON.parse(xhr.responseText);
            message = message[0];


            for (let m = 0; m < message.length; m++) {

                console.log("hi", message[m]);

                let listItem = document.createElement("li");

                listItem.classList.add('rec-items');
                listItem.style.cursor = "pointer";
                listItem.setAttribute("onclick", "displayGroceries('" + message[m].ingredient_name + "')");

                listItem.innerHTML = message[m].ingredient_name;
                document.querySelector('.grocery-options').appendChild(listItem);
            }
        })

    }
});

function addGrocery() {

    if (searchedGrocery.value === '') {
        alert('You must write something!');
    } else {
        let li = document.createElement('li');
        li.innerHTML = searchedGrocery.value;
        groceryList.appendChild(li);
        console.log(li)
        let span = document.createElement("span");
        span.innerHTML = "\u00d7";
        li.appendChild(span);
    }
    searchedGrocery.value = "";
}

groceryList.addEventListener("click", function(e) {
    if (e.target.tagName === "SPAN") {
        e.target.parentElement.remove();
    }
})










let searchedAppliance = document.getElementById('add-appliances-input');
let applianceList = document.querySelector(".appliance-list")

searchedAppliance.addEventListener("keyup", (e) => {
    removeElements();
    let xhr = new XMLHttpRequest();

    if (searchedAppliance.value != "") {
        xhr.open(
            "GET",
            `?action=appliancesByLetter&add-appliances-input=${searchedAppliance.value}`
        )
        xhr.send();
        xhr.addEventListener("load", (e) => {
            let message = JSON.parse(xhr.responseText);
            message = message[0];


            for (let m = 0; m < message.length; m++) {

                console.log("hi", message[m]);

                let listItem = document.createElement("li");

                listItem.classList.add('rec-items');
                listItem.style.cursor = "pointer";
                listItem.setAttribute("onclick", "displayAppliances('" + message[m].equipment_name + "')");

                listItem.innerHTML = message[m].equipment_name;
                document.querySelector('.appliance-options').appendChild(listItem);
            }
        })

    }
});


function addAppliance() {

    if (searchedAppliance.value === '') {
        alert('You must write something!');
    } else {
        let li = document.createElement('li');
        li.innerHTML = searchedAppliance.value;
        applianceList.appendChild(li);
        console.log(li)
        let span = document.createElement("span");
        span.innerHTML = "\u00d7";
        li.appendChild(span);
    }
    searchedAppliance.value = "";
}

applianceList.addEventListener("click", function(e) {
    if (e.target.tagName === "SPAN") {
        e.target.parentElement.remove();
    }
})

function displayGroceries(value) {
    searchedGrocery.value = value;
    removeElements();
}

function displayAppliances(value) {
    searchedAppliance.value = value;
    removeElements();
}

function removeElements() {
    let items = document.querySelectorAll('.rec-items');
    items.forEach((item) => {
        item.remove();
    });
}




let editApplianceBtn = document.querySelector(".appliances-button");
let editGroceriesBtn = document.querySelector(".grocery-button");
let groceriesMain = document.querySelector(".groceries-list");
let apppliancesMain = document.querySelector(".appliances-list");

editApplianceBtn.addEventListener("click", function(event) {
    apppliancesMain.style.display = "block";
    groceriesMain.style.display = "none";
    editGroceriesBtn.style.backgroundColor = "#dba1a1";
    editApplianceBtn.style.backgroundColor = "var(--tertiary-bg-color)";
});

editGroceriesBtn.addEventListener("click", function(event) {
    apppliancesMain.style.display = "none";
    groceriesMain.style.display = "block";
    editApplianceBtn.style.backgroundColor = "#dba1a1";
    editGroceriesBtn.style.backgroundColor = "var(--tertiary-bg-color)";
});