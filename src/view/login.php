<?php 
	session_start();

	require_once 'header.php'; 
?>	
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="login_post.php" method="post">
                <h2>Login</h2><br>
                <div class="form-group">
                    <label for="email">Email address:</label>
					<input type="email" name="email" required id="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="Email Address">	                                        
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" name="password" class="form-control" id="pwd" placeholder="Password">                    
                </div><br>
                <button type="submit" class="btn btn-default">Login</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div><br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" area-valuemax="100" style="width:20%">
                    Login
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <hr class="style1">
    <div class="text-center">
        <p>New to Exotic Fruits Website?</p>
        <a href="/view/signup.php" class="btn btn-info btn-lg" role="button">Create your account</a>
    </div>
</div>
<br><br>

</body>
</html>
