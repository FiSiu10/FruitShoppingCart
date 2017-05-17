<?php
	require_once 'header.php';
?>	
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="./signup_post.php" method="post">
                <h2>Create Account</h2><br>
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" pattern="^[A-Z][a-z]+$" pattern="^[A-Z]'?[- a-zA-Z]+$" required class="form-control" id="firstname" placeholder="First Name">
                </div>                
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" pattern="^[A-Z]'?[- a-zA-Z]+$" required class="form-control" id="lastname" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="email">Email Address:</label>
					<input type="email" name="email" required id="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email Address">	                    
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Password">
                </div><br>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div><br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" area-valuemax="100" style="width:20%">
                    Create Account
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div><br><br>

</body>
</html>