<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Exotic Fruits - All Products</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">			<!-- Added by Roy for Search Bar -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default rounded borders and increase the bottom margin */
        .navbar {
            margin-bottom: 50px;
            border-radius: 0;
        }

        /* Remove the jumbotron's default bottom margin */
        .jumbotron {
            padding-top: 0;
            padding-bottom:0;
            margin-bottom: 0;
            background-color: #ffffff;
        }

        /* Add a gray background color and some padding to the footer */
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }

				/* Added by Roy for making search bar wider */
				#navBarSearchForm input[type=text]{width:430px !important;}

        /* Commented by Roy for Nav Search *
				/* Make search bar wider */
				/*	.navbar-right, .btn {
					width: 600px;
				}
				.input-group {
					width: 80%;
				}
				.navbar-right, .btn {
					width: 50px;
				}
				.form-control {width: 70%;}
				*/
    </style>
</head>
<body>
<div class="jumbotron">
    <div class="container text-center">
        <h1><img src = "view/images/1.png" width="350" height="193"></h1>
    </div>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="../index.php">Home</a></li>
                <li><a href="/view/aboutus.html">About Us</a></li>
                <li><a href="/view/faq.html">FAQ</a></li>
<?php
	if(!isset($_SESSION['custid']) || !isset($_SESSION['custname'])) {
?>                  
                <li><a href="/view/login.php">Login/Register</a></li>
<?php
    } else {        
?>                                  
                <li><a href="/view/logout.php">Logout</a></li>
<?php
	}
?>                                  
            </ul>
		        <form class="navbar-form navbar-left" role="search" id="navBarSearchForm">
		        <div class="input-group">
		            <input type="text" class="form-control" placeholder="Search" name="term" id="srch-term">
		            <div class="input-group-btn">
		                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>
		        </form>
            <ul class="nav navbar-nav navbar-right">
<?php
	if(isset($_SESSION['custid']) && isset($_SESSION['custname'])) {
?>             
                <li><a href="#"><span class="glyphicon"></span> Hello, <?php echo $_SESSION['custname'];  ?></a></li>
<?php
	}
?>                   
                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart </a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Added by Roy for Search Bar -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){
 $('#srch-term').autocomplete({
     source: "./view/search.php",
     minLength: 2,
     select: function(event, ui) {
         var prod_id = ui.item.id;
         if (prod_id != '#') {
             location.href = "allFruitInfo.php?prod_id="+prod_id;
         }
     },
     open: function(event, ui) {
         $(".ui-autocomplete").css("z-index", 1000)
     }
 })
});
</script>
