<?php require_once "view/base/admin/header.php"?>

<form action="create-admin" method="post">
    first name: <input type="text" name="first_name"><br>
    last name: <input type="text" name="last_name"><br>
    email: <input type="email" name="email"><br>
    phone: <input type="text" name="phone"><br>
    mobile: <input type="text" name="mobile"><br>
    password: <input type="password" name="password"><br>
    <input type="submit" value="Submit">
</form>

<?php require_once "view/base/admin/footer.php"?>
