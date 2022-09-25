<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$empid = $empname = $empaddress = $emprole = $salary = $empphone = $empgender = "";
$empid_err = $empname_err = $empaddress_err = $emprole_err = $salary_err = $empphone_err = $empgender_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["empid"]) && !empty($_POST["empid"])){
    // Get hidden input value
    $empid = $_POST["empid"];
    
    // Validate name
    $input_empname = trim($_POST["empname"]);
    if(empty($input_empname)){
        $empname_err = "Please enter a name.";
    } elseif(!filter_var($input_empname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $empname_err = "Please enter a valid name.";
    } else{
        $empname = $input_empname;
    }
    
    // Validate Role
    $input_empaddress = trim($_POST["empaddress"]);
    if(empty($input_empaddress)){
        $empaddress_err = "Please enter an address.";     
    } else{
        $empaddress = $input_empaddress;
    }

    // Validate Role
    $input_emprole = trim($_POST["emprole"]);
    if(empty($input_emprole)){
        $emprole_err = "Please enter a Role";     
    } else{
        $emprole = $input_emprole;
    }
    
    // Validate salary
    $input_empsalary = trim($_POST["empsalary"]);
    if(empty($input_empsalary)){
        $empsalary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_empsalary)){
        $empsalary_err = "Please enter a positive integer value.";
    } else{
        $empsalary = $input_empsalary;
    }

    // Validate Phone Number
    $input_empphone = trim($_POST["empphone"]);
    if(empty($input_empphone)){
        $empphone_err = "Please enter a Phone Number";     
    } else{
        $empphone = $input_empphone;
    }
    
    // Validate Gender
    $input_empgender = trim($_POST["empgender"]);
    if(empty($input_empgender)){
        $empgender_err = "Please enter a Gender";     
    } else{
        $empgender = $input_empgender;
    }

    // Check input errors before inserting in database
    if(empty($empid_err) && empty($empname_err) && empty($empaddress_err) && empty($emprole_err) && empty($empsalary_err) empty($empphone_err) && empty($empgender_err)){
        // Prepare an update statement
        $sql = "UPDATE employees SET empname=?, empaddress=?, emprole=?, empsalary=?, empphone=?, empgender=? WHERE empid=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_empname, $param_empaddress, $param_emprole, $param_empsalary,$param_empphone , $param_empgender , $param_empid);
            
            // Set parameters
            $param_empname = $empname;
            $param_empaddress = $empaddress;
            $param_emprole = $emprole;
            $param_empsalary = $empsalary;
            $param_empphone = $empphone;
            $param_empgender = $empgender;
            $param_empid = $empid;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: empindex.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["empid"]) && !empty(trim($_GET["empid"]))){
        // Get URL parameter
        $id =  trim($_GET["empid"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM employees WHERE empid = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_empid);
            
            // Set parameters
            $param_empid = $empid;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $empname = $row["empname"];
                    $empaddress = $row["empaddress"];
                    $emprole = $row["emprole"];
                    $empsalary = $row["empsalary"];
                    $empphone = $row["empphone"];
                    $empgender = $row["empgender"];

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: emperror.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: emperror.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Employee ID</label>
                            <input type="text" name="empid" class="form-control <?php echo (!empty($empid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $empid; ?>">
                            <span class="invalid-feedback"><?php echo $empid_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Employee Name</label>
                            <input type="text" name="empname" class="form-control <?php echo (!empty($empname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $empname; ?>">
                            <span class="invalid-feedback"><?php echo $empname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="empaddress" class="form-control <?php echo (!empty($empaddress_err)) ? 'is-invalid' : ''; ?>"><?php echo $empaddress; ?></textarea>
                            <span class="invalid-feedback"><?php echo $empaddress_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" name="emprole" class="form-control <?php echo (!empty($emprole_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emprole; ?>">
                            <span class="invalid-feedback"><?php echo $emprole_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="empsalary" class="form-control <?php echo (!empty($empsalary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $empsalary; ?>">
                            <span class="invalid-feedback"><?php echo $empsalary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="empphone" class="form-control <?php echo (!empty($empphone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $empphone; ?>">
                            <span class="invalid-feedback"><?php echo $empphone_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="empgender" class="form-control <?php echo (!empty($empgender_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $empgender; ?>">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                            <span class="invalid-feedback"><?php echo $empgender_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save">
                        <a href="empindex.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>