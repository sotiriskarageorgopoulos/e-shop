let checkedProduct = false;
let randomChoice = false;

const checkRandomProducts = () => {
    let checkboxes = document.getElementsByClassName("checkboxes");
    let quantities = document.getElementsByClassName("quantity-boxes");
    let prices = document.getElementsByClassName("price");
    const countOfProducts = Math.round(Math.random() * 5 + 1);
    let randomQuantities = [];
    let indexes = [];
    let amount = 0;
    let i = 0;
    checkedProduct = true;
    randomChoice = true;

    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = "";
    }

    for (let i = 0; i < quantities.length; i++) {
        quantities[i].value = "";
    }

    while (i < countOfProducts) {
        let randomIndex = Math.round(Math.random() * 5);
        let isExistIndex = false;
        for (let i = 0; i < indexes.length; i++) {
            if (indexes[i] === randomIndex) {
                isExistIndex = true;
                break;
            }
        }
        if (isExistIndex === false) {
            indexes.push(randomIndex);
            let randomQuantity = Math.round(Math.random() * 10 + 1);
            randomQuantities.push(randomQuantity);
            checkboxes[randomIndex].checked = "checked";
            quantities[randomIndex].value = randomQuantity;
            i += 1;
        }
    }
    console.log(indexes)

    deleteInfo();
    document.getElementsByClassName("shopping-cart")[0].style.display = "flex";
    insertInfo();
}

const checkProduct = () => {
    deleteInfo();
    document.getElementsByClassName("shopping-cart")[0].style.display = "flex";
    insertInfo();
}

const deleteInfo = () => {
    let lst = document.getElementById("sc-list1");
    lst.innerHTML = "";
    document.getElementById("amount").innerHTML = "Ποσό: 0 €"
}

const insertInfo = () => {
    let checkboxes = document.getElementsByClassName("checkboxes");
    let quantities = document.getElementsByClassName("quantity-boxes");
    let prices = document.getElementsByClassName("price");
    let lst = document.getElementById("sc-list1");
    let amount = 0;
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked === true) {
            let quantity = quantities[i].value;
            console.log("quantity: " + quantity);
            let price = parseInt(prices[i].textContent);
            console.log("price: " + price);
            amount += quantity * price;
            console.log("amount: " + amount);
            document.getElementById("amount").innerHTML = "Ποσό: " + amount + " €"

            let p = document.createElement("p");
            p.style.color = "aliceblue";
            let info = quantities[i].value + " Τεμάχια " + " - " + checkboxes[i].value + " - " + "Τιμή " + prices[i].textContent + " €";
            let txt = document.createTextNode(info);
            p.appendChild(txt);
            lst.appendChild(p);
        }
    }
    let down = document.getElementById("sc-list1");
    down.scrollIntoView();
}

const nextButton = () => {
    console.log(randomChoice);
    if (randomChoice === false) {
        let checkboxes = document.getElementsByClassName("checkboxes");
        let quantities = document.getElementsByClassName("quantity-boxes");
        let prices = document.getElementsByClassName("price");
        let amount = 0;
        for (let i in checkboxes) {
            if (checkboxes[i].checked === true) {
                checkedProduct = true;
                let quantity = quantities[i].value;
                console.log("quantity: " + quantity);
                let price = parseInt(prices[i].textContent);
                console.log("price: " + price);
                amount += quantity * price;
                console.log("amount: " + amount)
            }
        }

        if (amount !== 0) document.getElementById("amount").innerHTML = 'Ποσό: ' + amount + '&euro;';
    }

    if (checkedProduct) {
        let shoppingCartDisplay = document.getElementsByClassName("shopping-cart")[0];
        shoppingCartDisplay.style.display = "none";

        let shoppingCart = document.getElementById("amount");
        let prices = document.getElementsByClassName("price");
        let newShoppingCart = document.getElementsByClassName("sc-icon")[1];
        let amountPattern = /\d+/g;
        let amountStr = shoppingCart.textContent.match(amountPattern).toLocaleString();
        let amount = parseInt(amountStr);

        if (amount <= 30) {
            amount += 2;
            newShoppingCart.innerHTML = "Ποσό: " + amount + " € " + "- Έξοδα Αποστολής: 2 €";
        } else {
            newShoppingCart.innerHTML = "Ποσό: " + amount + " € " + "- Χωρίς Έξοδα Αποστολής";
        }

        let hiddenBoxes = document.getElementsByClassName("display");
        for (let index = 0; index < hiddenBoxes.length; index++) {
            hiddenBoxes[index].style.display = "flex";
        }

        let checkboxes = document.getElementsByClassName("checkboxes");
        let quantities = document.getElementsByClassName("quantity-boxes");
        for (let index in checkboxes) {
            checkboxes[index].disabled = "disabled";
            quantities[index].disabled = "disabled";
        }

        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked === true) {
                let p = document.createElement("p");
                p.style.color = "aliceblue";
                let info = quantities[i].value + " Τεμάχια " + " - " + checkboxes[i].value + " - " + "Τιμή " + prices[i].textContent + " €";
                let txt = document.createTextNode(info);
                p.appendChild(txt);
                let lst = document.getElementById("sc-list");
                lst.appendChild(p);
            }
        }

        let down = document.getElementById("form1");
        document.getElementById("check-button").disabled = true;
        down.scrollIntoView();
    } else {
        alert("Δεν επιλέξατε προϊόν!");
    }
}

const previousFormButton = (formNum) => {
    if (formNum === 1) {
        let checkboxes = document.getElementsByClassName("checkboxes");
        let quantities = document.getElementsByClassName("quantity-boxes");
        document.getElementById("check-button").disabled = false;
        for (var index in checkboxes) {
            checkboxes[index].disabled = false;
            checkboxes[index].checked = false;
            quantities[index].disabled = false;
            quantities[index].value = "";
        }
        let shoppingCart = document.getElementsByClassName("shopping-cart")[0];
        shoppingCart.style.display = "none";
        deleteInfo();
        document.getElementById("amount").innerHTML = "Ποσό: 0&euro;";
        document.getElementsByClassName("display")[0].style.display = "none";
        let up = document.getElementById("logout-layout");
        up.scrollIntoView();
    } else if (formNum === 2) {
        document.getElementById("road").disabled = false;
        document.getElementById("region").disabled = false;
        document.getElementById("road number").disabled = false;
        document.getElementById("postcode").disabled = false;
        document.getElementsByClassName("next-form-button")[0].disabled = false;
        document.getElementsByClassName("previous-form-button")[0].disabled = false;
        document.getElementById("form2").style.display = "none";
        document.getElementById("form1").style.display = "flex";
    }
}

const nextFormButton = () => {
    let roadElement = document.getElementById("road");
    let regionElement = document.getElementById("region");
    let roadNumElement = document.getElementById("road number");
    let postcodeElement = document.getElementById("postcode");

    let road = roadElement.value;
    let region = regionElement.value;
    let roadNum = parseInt(roadNumElement.value);
    let strPostcode = postcodeElement.value;
    let postcode = parseInt(strPostcode);

    let roadRegionPattern = /^[Α-Ωα-ω]+$/;
    let roadNumPostcodePattern = /^[0-9]*$/;

    let isStringRoad = roadRegionPattern.test(road);
    let isStringRegion = roadRegionPattern.test(region);
    let isNumberRoadNum = roadNumPostcodePattern.test(roadNum);
    let isNumberPostcode = roadNumPostcodePattern.test(postcode);

    console.log("is string road? " + isStringRoad);
    console.log("is string region? " + isStringRegion);
    console.log("is number road number? " + isNumberRoadNum);
    console.log("is number postcode? " + isNumberPostcode);

    if (isStringRoad === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο οδός!");
    if (isNumberRoadNum === false) alert("Εισάγεται μόνο ακεραίους αριθμούς!");
    if (isStringRegion === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο περιοχή!");
    if (isNumberPostcode === false) alert("Εισάγεται μόνο ψηφία!");
    if (strPostcode.length !== 5) alert("Ο Ταχυδρομικός κωδικός είναι 5 ψηφία!");

    if (isStringRoad === true && isNumberRoadNum === true && isStringRegion === true &&
        isNumberPostcode === true && strPostcode.length === 5) {
        roadElement.disabled = true;
        regionElement.disabled = true;
        roadNumElement.disabled = true;
        postcodeElement.disabled = true;
        document.getElementsByClassName("next-form-button")[0].disabled = true;
        document.getElementsByClassName("previous-form-button")[0].disabled = true;
        document.getElementById("form2").style.display = "flex";
        let down = document.getElementById("form2");
        down.scrollIntoView();
        document.getElementsByClassName("confirm-form-button")[0].disabled = true;
    }
}

const formCheckBox = () => {
    let checkbox = document.getElementsByClassName("form-checkbox")[0];
    let amountText = document.getElementsByClassName("sc-icon")[1].innerHTML;
    let amountPattern = /\d+/g;
    let amountStr = amountText.match(amountPattern).toLocaleString();
    let amount = parseInt(amountStr);

    if (amount >= 30) {
        document.getElementsByClassName("sc-icon")[1].innerText = "Ποσό: " + amount + " € " + "+ Χωρίς Έξοδα Αποστολής";
    } else if (checkbox.checked === true) {
        let expressDelivery = 6;
        amount += expressDelivery - 2;
        document.getElementsByClassName("sc-icon")[1].innerText = "Ποσό: " + amount + " €" + " - " + "Έξοδα Αποστολής: " + expressDelivery + " €";
    } else if (checkbox.checked === false) {
        let delivery = 2;
        amount -= 6;
        amount += delivery;
        document.getElementsByClassName("sc-icon")[1].innerText = "Ποσό: " + amount + " €" + " - " + "Έξοδα Αποστολής: " + delivery + " €";
    }
}

const paymentChoice = () => {
    let sel = document.getElementById("payment");
    let clientInfo = document.getElementsByClassName("display3");
    let creditCardInfo = document.getElementsByClassName("display4");
    if (sel.value === "cod") {
        for (let i = 0; i < clientInfo.length; i++) {
            clientInfo[i].style.display = "flex";
        }
        for (let i = 0; i < creditCardInfo.length; i++) {
            creditCardInfo[i].style.display = "none";
        }
        document.getElementsByClassName("confirm-form-button")[0].disabled = false;
    } else if (sel.value === "credit_card") {
        for (let i = 0; i < clientInfo.length; i++) {
            clientInfo[i].style.display = "flex";
        }
        for (let i = 0; i < creditCardInfo.length; i++) {
            creditCardInfo[i].style.display = "flex";
        }
        document.getElementsByClassName("confirm-form-button")[0].disabled = false;
    }
}

const confirmFormButton = () => {
    let nameElement = document.getElementById("name");
    let surnameElement = document.getElementById("surname");
    let sel = document.getElementById("payment");

    let name = nameElement.value;
    let surname = surnameElement.value;

    let personalInfoPattern = /^[Α-Ωα-ω]+$/;
    let creditCardNumPattern = /^[0-9]*$/;

    let isStringName = personalInfoPattern.test(name);
    let isStringSurname = personalInfoPattern.test(surname);

    console.log("is string name? " + isStringName);
    console.log("is string surname? " + isStringSurname);

    if (sel.value === 'cod') {
        if (isStringName === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο όνομα!");
        if (isStringSurname === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο επώνυμο!");

        if (isStringName && isStringSurname) {
            alert("Η παραγγελίας σας ολοκληρώθηκε επιτυχώς!");
            window.location.href = "./index.html";
        }
    } else if (sel.value === "credit_card") {
        let creditCardNumElement = document.getElementById("credit_card_num");
        let creditCardNumStr = creditCardNumElement.value;
        let creditCardNumber = parseInt(creditCardNumStr);
        let isNumberCreditCardNum = creditCardNumPattern.test(creditCardNumber);

        console.log("is number credit card number? " + isNumberCreditCardNum);

        if (isStringName === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο όνομα!");
        if (isStringSurname === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο επώνυμο!");
        if (isNumberCreditCardNum === false) alert("Εισάγεται μόνο ψηφία στο πεδίο αριθμός πιστωτικής κάρτας!");
        if (creditCardNumStr.length !== 16) alert("Ο Αριθμός Πιστωτικής Κάρτας είναι 16 ψηφία!");

        if (isStringName && isStringSurname && isNumberCreditCardNum && creditCardNumStr.length === 16) {
            alert("Η παραγγελίας σας ολοκληρώθηκε επιτυχώς!");
            window.location.href = "./index.html";
        }
    }
}

const validRegister = () => {
    let nameElement = document.getElementById("name");
    let surnameElement = document.getElementById("surname");
    let addressElement = document.getElementById("address");
    let regionElement = document.getElementById("region");
    let cityElement = document.getElementById("city");
    let postcodeElement = document.getElementById("postcode");
    let phoneNumElement = document.getElementById("phonenumber");
    let emailElement = document.getElementById("e-mail");

    let stringPattern = /^[Α-Ωα-ω]+$/;
    let numberPattern = /^[0-9]*$/;
    let emailPattern = /\w+@\w+(.com|.gr)/gi;

    let name = nameElement.value;
    let surname = surnameElement.value;
    let address = addressElement.value;
    let region = regionElement.value;
    let city = cityElement.value;
    let postcode = postcodeElement.value;
    let phonenumber = phoneNumElement.value;
    let email = emailElement.value;

    let isStringName = stringPattern.test(name);
    let isStringSurname = stringPattern.test(surname);
    let isStringAddress = stringPattern.test(address);
    let isStringRegion = stringPattern.test(region);
    let isStringCity = stringPattern.test(city);
    let isNumberPhoneNum = numberPattern.test(phonenumber);
    let isCorrectEmail = emailPattern.test(email);

    if (isStringName === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο όνομα!");
    if (isStringSurname === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο επίθετο!");
    if (isStringAddress === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο διεύθυνση!");
    if (isStringRegion === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο περιοχή!");
    if (isStringCity === false) alert("Εισάγεται μόνο χαρακτήρες στο πεδίο πόλη!");
    if (isNumberPhoneNum === false) alert("Εισάγεται μόνο ψηφία στο πεδίο τηλέφωνο!");
    if (isCorrectEmail === false) alert("Εισάγεται με ορθό τρόπο το email σας!");
    if (postcode.length !== 5) alert("Ο ταχυδρομικός κωδικός περιέχει μόνο 5 ψηφία!");

}

const delPopUp = () => {
    document.getElementById("pop").style.display = "none";
}

const registerPopUp = () => {
    let emailElement = document.getElementById("e-mail-popup");
    let emailPattern = /\w+@\w+(.com|.gr)/gi;
    let email = emailElement.value;
    let isCorrectEmail = emailPattern.test(email);
    if (isCorrectEmail === false) alert("Εισάγεται με ορθό τρόπο το email σας!");
    if (isCorrectEmail) document.getElementById("pop").style.display = "none";

}