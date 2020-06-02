let buyBTN = document.querySelector("#buyBTN");
buyBTN.addEventListener("click", buy);

function buy(e) {
  const request = new XMLHttpRequest();
  e.preventDefault();
  let stock = document.querySelector("#stock");
  let date = document.querySelector("#date");
  let nos = document.querySelector("#nos");
  let cps = document.querySelector("#cps")
  let notes = document.querySelector("#buynotes");

  checkBuyFields(stock, date, nos, cps);

  let query =
    "/buy/?stock=" +
    stock.value +
    "&date=" +
    date.value +
    "&nos=" +
    nos.value +
    "&cps=" +
    cps.value +
    "&notes=" +
    notes.value;
  request.open("get", query, true);
  //console.log(query);
  request.onload = function () {
    console.log(request.responseText);
    if (request.responseText == "created") {
      addStock(stock, date, nos, cps, notes);
      stock.value = "";
      date.value = "";
      nos.value = "";
      cps.value = "";
      notes.value = "";
    }
  };
  request.send();
}

function addStock(stock, date, nos, cps, notes) {
  console.log("addStock");
  let tradeSection = document.querySelector("#trade-section");
  let card = document.createElement("div");
  card.innerHTML =
    '<div class="m-3"> <div class="card"> <div class="card-body"> <div class="row m-2"> <input type="disabled" class="m-1 col-1 form-control text-center" value="' +
    stock.value +
    '" readonly> <input type="date" class="m-1 col-2 form-control text-center" value="' +
    date.value +
    '" readonly> <input type="number" class="m-1 col-2 form-control text-center" value="' +
    nos.value +
    '" readonly> <input type="text" class="m-1 col-2 form-control text-right" value="' +
    cps.value +
    '" readonly><input type="text" class="m-1 col form-control" value="' +
    notes.value +
    '" readonly> </div><div class="row m-2"> <input type="number" class="m-1 col-1 form-control text-center" placeholder="Shares"><input type="number" class="m-1 col-1 form-control text-right" placeholder="Price"><input type="text" class="m-1 col form-control" placeholder="Why selling?"></div></div></div></div>';
  //let cardParsed = new DOMParser().parseFromString(card, "text/xml");
  //<a id="sellBTN" class="m-1 col-1 btn btn-danger align-middle" href="/">SELL<span class="material-icons align-middle">keyboard_arrow_down</span></a>
  let cardParsed = card.firstChild;
  tradeSection.insertBefore(cardParsed, tradeSection.firstChild);
}

function checkBuyFields(stock, date, nos, cps) {
  if (!stock.value)
    stock.className = "m-1 col-1 form-control is-invalid text-center";
  else
    stock.className = "m-1 col-1 form-control text-center";

  if (!date.value)
    date.className = "m-1 col-2 form-control is-invalid text-center";
  else
    date.className = "m-1 col-2 form-control text-center"
  if (!nos.value)
    nos.className = "m-1 col-2 form-control is-invalid text-center";
  else
    nos.className = "m-1 col-2 form-control text-center";
  if (!cps.value)
    cps.className = "m-1 col-2 form-control is-invalid text-right";
  else
    cps.className = "m-1 col-2 form-control text-right";

}

function sell(id, tradeID) {
  let sellCard = document.querySelector('#superb' + id);
  let nos = sellCard.childNodes[1];
  let pps = sellCard.childNodes[3];
  let notes = sellCard.childNodes[5];

  const request = new XMLHttpRequest();
  let query =
    "/sell/?id=" +
    tradeID +
    "&nos=" +
    nos.value +
    "&pps=" +
    pps.value +
    "&notes=" +
    notes.value;
  request.open("get", query, true);
  //console.log(query);
  request.onload = function () {
    console.log(request.responseText);
    if (request.responseText == "created") {
      location.reload();
    }
    else if (request.responseText == 'tooBig') {
      nos.className = "m-1 col-1 form-control is-invalid text-center";
    }
    else {
      nos.className = "m-1 col-1 form-control is-invalid text-center";
      pps.className = "m-1 col-1 form-control is-invalid text-center";
    }
  };
  request.send();
}