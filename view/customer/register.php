<?php require_once "view/base/customer/header.php"?>

<form action="create-customer" method="post">
    first name: <input type="text" name="first_name"><br>
    last name: <input type="text" name="last_name"><br>
    email: <input type="email" name="email"><br>
    phone: <input type="text" name="phone"><br>
    mobile: <input type="text" name="mobile"><br>
    flat house no: <input type="text" name="flat_house_no"><br>
    street: <input type="text" name="street"><br>
    city town: <input type="text" name="city_town"><br>
    postcode: <input type="text" name="postcode"><br>
    password: <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>

<?php require_once "view/base/customer/footer.php"?>