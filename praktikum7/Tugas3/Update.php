<?php
// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$name = $email = $address = $salary = $status = "";
$name_err = $email_err = $address_err = $salary_err = $status_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["Id_Emp"]) && !empty($_POST["Id_Emp"])){
    // Get hidden input value
    $id = $_POST["Id_Emp"];
    
    // Validate name
    $input_name = trim($_POST["Name_Emp"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate email
    $input_email = trim($_POST["Email_emp"]);
    if(empty($input_email)){
        $email_err = "Please enter an Email.";     
    } else{
        $email = $input_email;
    }

    // Validate address address
    $input_address = trim($_POST["Address_Emp"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }

    
    
    // Validate salary
    $input_salary = trim($_POST["salary_emp"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }

    // Validate Status
    $input_status = trim($_POST["stat"]);
    if(empty($input_status)){
        $status_err = "Please enter an Employee Status.";     
    } else{
        $status = $input_status;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($address_err) && empty($salary_err) && empty($status_err)){
        // Prepare an update statement
        $sql = "UPDATE employees SET Name_Emp_=?, Email_emp = ? , Address_Emp =?, salary=? , stat = ? , WHERE id=?  ";
         //$sql = "INSERT INTO employee (Name_Emp , Email_emp , Address_Emp , salary_emp , stat ) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_name , $param_email, $param_address, $param_salary, $param_status, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_address = $address;
            $param_salary = $salary;
            $param_status = $status;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: Apps.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["Id_Emp"]) && !empty(trim($_GET["Id_Emp"]))){
        // Get URL parameter
        $id =  trim($_GET["Id_Emp"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM employee WHERE Id_Emp = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["Name_Emp"];
                $email = $row["Email_emp"];
                $address = $row["Address_Emp"];
                $salary = $row["salary_emp"];
                $status = $row["stat"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
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
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                            <span class="help-block"><?php echo $salary_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="<?php echo $status; ?>">
                            <span class="help-block"><?php echo $status_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>