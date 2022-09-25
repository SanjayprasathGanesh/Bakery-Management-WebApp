<!DOCTYPE html>
<html lang="en">

<head>
	<script src="https://kit.fontawesome.com/5b61822651.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
</head>
<style>
    
    * {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
	font-family: "Montserrat", sans-serif;
}
.nav-list {
	background-color: rgb(0, 0, 0);
	margin: 0;
	padding: 1rem 0;
	display: flex;
	justify-content: flex-end;
	align-items: center;
}

.nav-items {
	list-style: none;
	margin-right: 2rem;
	color: beige;
}

.nav-items a {
	text-decoration: none;
	color: white;
}

.nav-items:first-child {
	margin-right: auto;
	margin-left: 2rem;
}

.nav-btn {
	font-size: 1rem;
	background: rgb(165, 117, 210);
	border: none;
	outline: none;
	padding: 0.5rem 1rem;
	cursor: pointer;
    
}

.nav-btn:hover {
	background-color: blueviolet;
	color: beige;
}

.nav-items a:hover {
	color: blueviolet;
}
nav{
    position:relative;
    width:100%;
}


</style>
<body>

	<nav>
		<ul class="nav-list">
			<li class="nav-items"><a href="/"><i class="fa-solid fa-terminal"></i></a></li>
			<li class="nav-items"><button class="nav-btn">Log Out</button></li>
		</ul>
	</nav>
</body>
</html>

<!DOCTYPE html>
<html>
    <title>Menu Page</title>
    <head>
    <body>
        <style>
            .sidenav{
                margin : 2px 900px 5px 10px;
                background-color : silver;
                padding : 15px 5px 15px 5px;
                position : fixed;
                font-size: 23px;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                height : 300%;
                width : 200px;
            }

            .sidenav a:hover{
                color : gold;
            }

            p{
                color : greenyellow;
                font-size: 20px;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
            }

            .body{
                position: relative;
                margin-left : 250px;
            }

            .logo{
                max-width: 100%;
                max-height: 100%;
            }

            h1{
                text-align : center;
                color : red;
            }

        </style>

        <div class = "sidenav">
            <a href = "">Home</a>
            <hr>
            <a href = "http://localhost/bakery/menuindex.php" class = "active">Daily Menu</a>
            <hr>
            <a href = "">Todays Orders</a>
            <hr>
            <a href = "">Delivery Executives</a>
            <hr>
            <a href = "http://localhost/bakery/empindex.php">Employees</a>
            <hr>
            <a href = "">Expenses</a>
            <hr>
        </div>
        <div class = "body">
            <hr>
            <!--<img class = "logo" src = "https://lh3.googleusercontent.com/p/AF1QipMXYrUrbpBVz1n89-fh-AUZWoQUKssCr0FJLqBf=s1280-p-no-v1" alt = "logo" width = 100px height = 100px>-->
            <h1>American Bakery</h1>
            <hr>
        </div>
    </body>
    </head>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Menu Details</h2>
                        <a href="menucreate.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Dish</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM dailymenu";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Product Id</th>";
                                        echo "<th>Product Name</th>";
                                        echo "<th>Category</th>";
                                        echo "<th>Description</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Total Quantity</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['category'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="menuread.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><button type = "button">View</button></a>';
                                            echo '<br>';
                                        echo "</td>";
                                        echo "<td>";
                                            echo '<a href="menuupdate.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><button type = "button">Update</button></a>';
                                        echo "</td>";
                                        echo "<td>";
                                            echo '<a href="menudelete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><button type = "button">Delete</button></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>