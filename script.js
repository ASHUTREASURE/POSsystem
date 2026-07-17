let cart = [];

function addTocard(id, name, price) {
    let item = cart.find(p => p.id === id);
    if(item) {
        item.qty++;
    }else{
        cart.push({id, name, price, qty: 1});
    }
    rendercart();
    }

function rendercart() {
    let cartdiv = document.getElementById('cart-items');
    let total = 0;
    cartdiv.innerHTML ='';

    cart.forEach(item => {
        let itemtotal = item.price + item.qty;
        total += itemtotal;
        cartdiv.innerHTML += '<p>${item.name} * ${item.qty} = $${itemtotal.tofixed(2)}</p>';
    });
    document.getElementById('total').innerText = total.toFixed(2);
}

function checkout() {
    if(cart.length === 0) {
        alert("cart is empty!");
        return;
    }
    fetch('checkout.php', {
        method: 'POST',
        headers: {'content-type': 'application/json'},
        body: JSON.stringify({cart: cart})
    })
    .then(res => res.text())
    .then(data => {
        alert(data);
        cart = [];
        rendercart();
        Location.reload();
    });
}