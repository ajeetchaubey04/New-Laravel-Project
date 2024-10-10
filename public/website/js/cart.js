var headers = {
    Accept: 'application.json',
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
};
var csrf = document.querySelector('meta[name="csrf-token"]').content;
var myOffcanvas = document.getElementById('offcanvasRight');
var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);

const pathname = window.location.pathname;
// console.log(pathname);

//Add To Cart
async function addToCart(url, productId, quantity = 1, variationId = false) {
    let variationIdD = variationId ? variationId : displayRadioValue();
    let body = {
        "_token": csrf,
        "product_id": productId,
        "variation_id": variationIdD,
        "quantity": quantity,
    };
    let request = { method: 'post', body: JSON.stringify(body), headers: headers };
    let data = await Ajax(url, request, true);
    setCartData(data);
}

//Remove From Cart
async function removeFromCart(url, cartId) {
    let body = {
        "_token": csrf,
        "id": cartId,
    };
    let request = { method: 'post', body: JSON.stringify(body), headers: headers };
    let data = await Ajax(url, request);
    setCartData(data);
}

//Edit From Cart
async function editFromCart(url, cartId, productId) {
    let body = {
        "_token": csrf,
        "id": cartId,
        "product_id": productId,
    };
    let request = { method: 'post', body: JSON.stringify(body), headers: headers };
    let data = await Ajax(url, request);
    updateCartData(data);
}

//Plus To Cart
async function plus(url, cartId, isRoute) {
    let body = {
        "_token": csrf,
        "id": cartId,
        "isRoute" : isRoute
    };
    let request = { method: 'post', body: JSON.stringify(body), headers: headers };
    let data = await Ajax(url, request);
    setCartData(data);
}

//Minus To Cart
async function minus(url, cartId, isRoute) {
    let body = {
        "_token": csrf,
        "id": cartId,
        "isRoute" : isRoute
    };
    let request = { method: 'post', body: JSON.stringify(body), headers: headers };
    let data = await Ajax(url, request);
    setCartData(data);
}

//Request Ajax 
async function Ajax(url, request, canvas = false) {
    let data;
    if (canvas) {
        bsOffcanvas.hide();
    }

    showLoader();
    await fetch(url, request)
        .then(response => {
            //handle response
            data = response.json()
        })
        .catch(error => {
            //handle error
            console.log(error);
        });
    hideLoader();
    if (canvas) {
        bsOffcanvas.show();
    }
    return data;
}

async function setCartData(data) {
    toaster(data.message, 'success');
    setCartDataCount(data.data.cart_count);
    document.getElementById('cart').innerHTML = '';
    document.getElementById('cart').innerHTML = data.data.view;
    updateCheckout();
}

async function updateCheckout() {
    console.log(pathname);
    if (pathname == '/user/checkout' || pathname == '/our-best-seller/checkout') {
        let url = window.location.href + '?type=' + document.querySelector('input[name="type"]:checked').value;
        let request = { method: 'get', headers: headers };
        let data = await Ajax(url, request);
        setCheckoutData(data);
    }
}

function setCheckoutData(data) {
    document.getElementById('checkout').innerHTML = '';
    document.getElementById('checkout').innerHTML = data.data.view;
    setDateTime();
}


function updateCartData(data) {
    document.getElementById('ajax-cart-data').innerHTML = '';
    document.getElementById('ajax-cart-data').innerHTML = data.data.view;
    let modalElement = document.getElementById('edit-ajax-modal');
    let modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    modal.show();
}

function setCartDataCount(count) {
    var ele = document.querySelectorAll('.cart-count');
    for (i = 0; i < ele.length; i++) {
        ele[i].innerText = count;
    }
}

function displayRadioValue() {
    var ele = document.getElementsByName('variation');

    for (i = 0; i < ele.length; i++) {
        if (ele[i].checked)
            return ele[i].dataset.variationId;
    }
}

async function serachData(val) {
    let url = location.protocol + '//' + location.host + '/search-ajax?search=' + val;
    let request = { method: 'get', headers: headers };
    let data = await Ajax(url, request);
    setsearchData(data)
}

const processChange = debounce((val) => serachData(val));

function debounce(func, timeout = 1000) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

function setsearchData(data) {
    let search = document.getElementById('search-list');
    search.style.display = "block";
    search.innerHTML = '';
    search.innerHTML = data.data.view;
}

document.body.addEventListener("click", function (evt) {
    let search = document.getElementById('search-list');
    if(search)
        search.style.display = "none";
});


//Check Pincode

async function checkPincode(url) {

    let pincode = document.getElementById('pincode').value;
    let checkPincode = document.getElementById('check-pincode');

    let body = {
        "_token": csrf,
        "pincode": pincode,
    };
    let request = { method: 'post', body: JSON.stringify(body), headers: headers };
    let data = await Ajax(url, request);
    if (data.status) {
        if (checkPincode)
            checkPincode.innerText = 'Delivering';
        toaster(data.message, 'success');
    } else {
        if (checkPincode)
            checkPincode.innerText = 'Check';
        toaster(data.message, 'error');
    }
}

//Get Addresses
async function getaddresses(url) {
    let request = { method: 'get', headers: headers };
    let data = await Ajax(url, request);
    updateCartData(data);
}

//Select Address
async function selectAddress(url) {
    event.preventDefault();
    let modalElement = document.getElementById('edit-ajax-modal');
    let modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    modal.show();
    let inputs = document.querySelector('input[name="address_id"]:checked');
    let body = {
        "_token": csrf,
        'address_id': inputs.value,
    };
    let request = { method: 'post', body: JSON.stringify(body), headers: headers };
    let data = await Ajax(url, request);
    updateCheckout();
}