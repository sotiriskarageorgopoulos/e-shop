const checkRandomProducts = () => {
    let checkboxes = document.getElementsByClassName("checkboxes");
    let quantities = document.getElementsByClassName("quantity-boxes");
    let prices = document.getElementsByClassName("price");
    const countOfProducts = Math.round(Math.random() * 5 + 1);
    let randomQuantities = [];
    let indexes = [];
    let amount = 0;
    let i = 0;

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

    for (let i = 0; i < countOfProducts; i++) {
        console.log("index: " + indexes[i])
        let price = parseInt(prices[indexes[i]].textContent);
        console.log("price: " + price)
        let quantity = randomQuantities[i];
        console.log("quantity: " + quantity)
        amount += price * quantity;
        console.log("amount: " + amount)
    }

    if (amount !== 0) document.getElementById("amount").innerHTML = 'Ποσό: ' + amount + '&euro;';

}
