<?php
session_start();

// Check if the request is a POST request and process the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    // Add or remove the book from the cart
    if ($action === 'Add') {
        if (!isset($_SESSION['cart'][$isbn])) {
            $_SESSION['cart'][$isbn] = [
                'title' => $title,
                'isbn' => $isbn,
                'price' => $price,
                'quantity' => 0
            ];
        }
        // Increment the quantity of the book in the cart
        $_SESSION['cart'][$isbn]['quantity'] += 1;
    } else if ($action === 'Remove') {
        if (isset($_SESSION['cart'][$isbn]) && $_SESSION['cart'][$isbn]['quantity'] > 0) {
            $_SESSION['cart'][$isbn]['quantity'] -= 1;
            if ($_SESSION['cart'][$isbn]['quantity'] === 0) {
                unset($_SESSION['cart'][$isbn]);
            }
        }
    }

    displayCart();
    exit;
}

// Display the cart
function displayCart() {
    $totalCost = 0;
    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>";
        foreach ($_SESSION['cart'] as $isbn => $book) {
            $bookTotal = $book['price'] * $book['quantity'];
            $totalCost += $bookTotal;
            echo "<tr>
                    <td>{$book['title']}</td>
                    <td>{$book['isbn']}</td>
                    <td>\${$book['price']}</td>
                    <td>{$book['quantity']}</td>
                    <td>\${$bookTotal}</td>
                  </tr>";
        }
        echo "<tr>
                <td colspan='4'>Total Cost</td>
                <td>\${$totalCost}</td>
              </tr>";
        echo "</table>";
    } else {
        echo "Your cart is empty.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        function AddRemoveItem(action, isbn) {
            var book = $(`#book-${isbn}`).text();
            var price = $(`#price-${isbn}`).text().replace('$', '');

            $.post('test.php', {
                action: action,
                isbn: isbn,
                title: book,
                price: price
            }, function(data) {
                $('#cart').html(data);
            });
        }

        $(document).ready(function() {
            var books = [
                {
                    cover: 'begaspnet.jpg',
                    title: 'Beginning ASP.NET with C#',
                    authors: 'Hart, Kauffman, Sussman, Ullman',
                    isbn: '0764588508',
                    price: '$39.99'
                },
                {
                    cover: 'cprog.jpg',
                    title: 'C Programming Language',
                    authors: 'Brian W. Kernighan, Dennis M. Ritchie',
                    isbn: '3249587245',
                    price: '$60.59'
                },
                {
                    cover: 'algos.png',
                    title: 'Designing Data-Intensive Applications',
                    authors: 'Martin Kleppmann',
                    isbn: '823491423',
                    price: '$50.00'
                }
            ];

            var bookContainer = $('#books');
            books.forEach(function(book) {
                var bookHtml = `
                    <div class="book">
                        <br/>
                        <img src="${book.cover}" />
                        <br /><br />
                        <b>Book:</b> <span id="book-${book.isbn}">${book.title}</span><br />
                        <b>Authors: </b> <span id="authors-${book.isbn}">${book.authors}</span><br />
                        <b>ISBN: </b> <span id="ISBN-${book.isbn}">${book.isbn}</span><br />
                        <b>Price: </b> <span id="price-${book.isbn}">${book.price}</span><br /><br />
                        <a href="#" onclick="AddRemoveItem('Add', '${book.isbn}');">Add to Shopping Cart</a><br /><br />
                        <a href="#" onclick="AddRemoveItem('Remove', '${book.isbn}');">Remove from Shopping Cart</a><br /><br />
                    </div>
                `;
                bookContainer.append(bookHtml);
            });
        });
    </script>
</head>
<body>
    <div id="books"></div>
    <span id="cart"><?php displayCart(); ?></span>
</body>
</html>
