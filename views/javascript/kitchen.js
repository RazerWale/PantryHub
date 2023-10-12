let searchedGrocery = document.getElementById("add-groceries-input");
let groceryList = document.querySelector(".grocery-list");
let applianceList = document.querySelector(".appliance-list");
let grocerysBtn = document.querySelector(".groceries-btn");
let appliancesBtn = document.querySelector(".appliances-btn");
let submitBtn = document.querySelector(".submit-btn");
const groceriesSpan = document.querySelectorAll(".grocerys-list-li");
const appliancesSpan = document.querySelectorAll(".appliance-list-li");

grocerysBtn.addEventListener("click", (e) => {
  e.preventDefault();
  addGrocery();
  console.dir(groceryList);
});
appliancesBtn.addEventListener("click", (e) => {
  e.preventDefault();
  addAppliance();
});
submitBtn.addEventListener("click", (e) => {
  const arrayOfiItems = { ingredients: [], equipments: [] };
  e.preventDefault();
  let xhr = new XMLHttpRequest();
  xhr.open("POST", `?action=addGrocerysAndAppliances`);
  Array.from(groceryList.children).forEach((item) => {
    if (item.id !== "") {
      arrayOfiItems.ingredients.push(parseInt(item.id));
    }
  });
  Array.from(applianceList.children).forEach((item) => {
    if (item.id !== "") {
      arrayOfiItems.equipments.push(parseInt(item.id));
    }
  });

  console.log(arrayOfiItems);
  xhr.send(JSON.stringify(arrayOfiItems));
  xhr.addEventListener("load", (e) => {
    // Array.from(groceryList.children).forEach((item) => {
    //   item.remove();
    // });
    // Array.from(applianceList.children).forEach((item) => {
    //   item.remove();
    // });
    alert("items successfully added!");
  });
});

searchedGrocery.addEventListener("keyup", (e) => {
  removeElements();
  let xhr = new XMLHttpRequest();

  if (searchedGrocery.value != "") {
    if (searchedGrocery.value.length >= 3) {
      xhr.open(
        "GET",
        `?action=groceriesByLetter&add-groceries-input=${searchedGrocery.value}`
      );
      xhr.send();
      xhr.addEventListener("load", (e) => {
        let message = JSON.parse(xhr.responseText);
        message = message[0];

        for (let m = 0; m < message.length; m++) {
          console.log("hi", message[m]);
          console.log(message[m].id);

          let listItem = document.createElement("li");

          listItem.classList.add("rec-items");
          listItem.style.cursor = "pointer";
          listItem.setAttribute(
            "onclick",
            `displayGroceries('${message[m].ingredient_name}',${message[m].id})`
          );

          listItem.innerHTML = message[m].ingredient_name;
          listItem.setAttribute("id", message[m].id);
          document.querySelector(".grocery-options").appendChild(listItem);
        }
      });
    }
  }
});

function addGrocery() {
  if (searchedGrocery.value === "") {
    alert("You must write something!");
  } else {
    let li = document.createElement("li");
    li.classList.add("grocerys-list-li");
    li.innerHTML = searchedGrocery.value;
    li.id = searchedGrocery.id;
    groceryList.appendChild(li);
    console.log(li);
    let span = document.createElement("span");
    span.innerHTML = "\u00d7";
    li.appendChild(span);
  }
  searchedGrocery.value = "";
}

for (let li of groceriesSpan) {
  console.log(li.children[0]);
  li.children[0].addEventListener("click", (e) => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `?action=removeUserIngredient`);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`id=${li.id}`);
  });
}
for (let li of appliancesSpan) {
  console.log(li.children[0]);
  li.children[0].addEventListener("click", (e) => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", `?action=removeUserEquipment`);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`id=${li.id}`);
  });
}

groceryList.addEventListener("click", function (e) {
  if (e.target.tagName === "SPAN") {
    e.target.parentElement.remove();
  }
});

let searchedAppliance = document.getElementById("add-appliances-input");

searchedAppliance.addEventListener("keyup", (e) => {
  removeElements();
  let xhr = new XMLHttpRequest();

  if (searchedAppliance.value != "") {
    if (searchedAppliance.value.length >= 3) {
      xhr.open(
        "GET",
        `?action=appliancesByLetter&add-appliances-input=${searchedAppliance.value}`
      );
      xhr.send();
      xhr.addEventListener("load", (e) => {
        let message = JSON.parse(xhr.responseText);
        message = message[0];

        for (let m = 0; m < message.length; m++) {
          console.log("hi", message[m]);

          let listItem = document.createElement("li");

          listItem.classList.add("rec-items");
          listItem.style.cursor = "pointer";
          listItem.setAttribute(
            "onclick",
            `displayAppliances('${message[m].equipment_name}',  ${message[m].id})`
          );

          listItem.innerHTML = message[m].equipment_name;
          document.querySelector(".appliance-options").appendChild(listItem);
        }
      });
    }
  }
});

function addAppliance() {
  if (searchedAppliance.value === "") {
    alert("You must write something!");
  } else {
    let li = document.createElement("li");
    li.classList.add("appliance-list-li");
    li.innerHTML = searchedAppliance.value;
    li.id = searchedAppliance.id;
    applianceList.appendChild(li);
    console.log(li);
    let span = document.createElement("span");
    span.innerHTML = "\u00d7";
    li.appendChild(span);
  }
  searchedAppliance.value = "";
}

applianceList.addEventListener("click", function (e) {
  if (e.target.tagName === "SPAN") {
    e.target.parentElement.remove();
  }
});

function displayGroceries(value, id) {
  searchedGrocery.value = value;
  searchedGrocery.id = id;
  removeElements();
}

function displayAppliances(value, id) {
  searchedAppliance.value = value;
  searchedAppliance.id = id;
  removeElements();
}

function removeElements() {
  let items = document.querySelectorAll(".rec-items");
  items.forEach((item) => {
    item.remove();
  });
}

let editApplianceBtn = document.querySelector(".appliances-button");
let editGroceriesBtn = document.querySelector(".grocery-button");
let groceriesMain = document.querySelector(".groceries-list");
let apppliancesMain = document.querySelector(".appliances-list");

editApplianceBtn.addEventListener("click", function (event) {
  apppliancesMain.style.display = "block";
  groceriesMain.style.display = "none";
  editGroceriesBtn.style.backgroundColor = "#dba1a1";
  editApplianceBtn.style.backgroundColor = "var(--tertiary-bg-color)";
});

editGroceriesBtn.addEventListener("click", function (event) {
  apppliancesMain.style.display = "none";
  groceriesMain.style.display = "block";
  editApplianceBtn.style.backgroundColor = "#dba1a1";
  editGroceriesBtn.style.backgroundColor = "var(--tertiary-bg-color)";
});
