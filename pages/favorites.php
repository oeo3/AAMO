Pseudocode: 
    start session after login
    if user is logged on, allow favorites button in nav to be clicked
    if add to cart is clicked, fetch assoc items from products table in database and print image_path and name in favorites table
        -fetch all rows in favorites table that corresponds to the user and print onto site
    if delete button is clicked, remove content of row in the database from showing on page 
