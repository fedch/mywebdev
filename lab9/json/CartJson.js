var xHRObject = false;
if (window.XMLHttpRequest)
{
xHRObject = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
xHRObject = new ActiveXObject("Microsoft.XMLHTTP");
}


function getData()
{
    if ((xHRObject.readyState == 4) &&(xHRObject.status == 200))
    {
		
		var spantag = document.getElementById("cart");
		
		var serverResponse;
		if (xHRObject.responseText!="") serverResponse= JSON.parse(xHRObject.responseText);
		else serverResponse=null;

		if (serverResponse != null){
			
			var keys = Object.keys(serverResponse);
			spantag.innerHTML = "";
            
			
            if (window.ActiveXObject)
            {
                spantag.innerHTML += " " +keys[0];
                spantag.innerHTML += " " + serverResponse[keys[0]] + " " + "<a href='#' onclick='AddRemoveItem(\"Remove\");'>Remove Item</a>";
            }
            else
            {
                spantag.innerHTML += " " +keys[0];
                spantag.innerHTML += " " + serverResponse[keys[0]] + " " + "<a href='#' onclick='AddRemoveItem(\"Remove\");'>Remove Item</a>";
            }
        
        }
        else{  spantag.innerHTML = ""; }
		
    }
}

var cart = {};

function AddRemoveItem(action) {
    var book = document.getElementById("book").innerText;
    var isbn = document.getElementById("ISBN").innerText;
    var price = parseFloat(document.getElementById("price").innerText.replace('$', ''));

    if (action === 'Add') {
        if (!cart[isbn]) {
            cart[isbn] = {
                title: book,
                isbn: isbn,
                price: price,
                quantity: 0
            };
        }
        cart[isbn].quantity += 1;
    } else if (action === 'Remove') {
        if (cart[isbn] && cart[isbn].quantity > 0) {
            cart[isbn].quantity -= 1;
            if (cart[isbn].quantity === 0) {
                delete cart[isbn];
            }
        }
    }

    displayCart();
}

function displayCart() {
    var cartDisplay = document.getElementById("cart");
    cartDisplay.innerHTML = "";
    var totalCost = 0;

    for (var isbn in cart) {
        var book = cart[isbn];
        var bookTotal = book.price * book.quantity;
        totalCost += bookTotal;

        cartDisplay.innerHTML += "<b>Title:</b> " + book.title + 
                                 "<br /><b>ISBN:</b> " + book.isbn + 
                                 "<br /><b>Price:</b> $" + book.price.toFixed(2) + 
                                 "<br /><b>Quantity:</b> " + book.quantity + 
                                 "<br /><b>Total:</b> $" + bookTotal.toFixed(2) + 
                                 "<br /><br />";
    }

    cartDisplay.innerHTML += "<b>Total Cost: $" + totalCost.toFixed(2) + "</b>";
}
