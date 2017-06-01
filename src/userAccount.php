<?php
session_start();

require 'view/header.php';
require_once 'model/db_connect.php';
require_once 'model/db_functions.php';

$user = getUserInfo($_SESSION['custid']);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="/userAccount_post.php" method="post">
                <h2>User Account</h2><br>
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" pattern="^[A-Z][a-z]+$" pattern="^[A-Z]'?[- a-zA-Z]+$" required class="form-control" id="firstname" placeholder="First Name" value="<?php print $user['first_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" pattern="^[A-Z]'?[- a-zA-Z]+$" required class="form-control" id="lastname" placeholder="Last Name" value="<?php print $user['last_name']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" name="email" required id="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email Address" value="<?php print $user['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Password" value="">
                </div><br>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div><br>
</div><br><br>

</body>
</html>