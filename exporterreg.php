<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exporter Registration</title>
    <style>
      /* exporterreg.css */

/* Basic styling for the form container */
.container {
  width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-family: Arial, sans-serif;
}

/* Style for the form headings */
h1 {
  text-align: center;
  color: #333;
}

/* Style for the form labels */
label {
  display: block;
  margin-bottom: 8px;
  color: #666;
}

/* Style for the input fields */
input[type="text"],
input[type="email"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Style for the "Submit" button */
input[type="submit"] {
  width: 100%;
  padding: 12px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}

/* Style for the link within the paragraph */
p a {
  color: #007bff;
  text-decoration: none;
}

p a:hover {
  text-decoration: underline;
}

/* Style for the "Already have an account?" paragraph */
.container.signin {
  text-align: center;/* exporterreg.css */
}
/* ... (previous CSS styles) ... */

/* Style for the alert */
.alert {
  background-color: #f44336; /* Red background color */
  color: #fff; /* White text color */
  padding: 10px;
  border-radius: 4px;
  text-align: center;
  margin-bottom: 10px;
}

/* Additional styles for different types of alerts */
/* You can add more classes like .alert-success, .alert-info, .alert-warning if needed */
.alert-success {
  background-color: #4CAF50; /* Green background color for success alerts */
}

.alert-info {
  background-color: #007bff; /* Blue background color for info alerts */
}

.alert-warning {
  background-color: #ffc107; /* Yellow background color for warning alerts */
}

/* ... (rest of the previous CSS styles) ... */

.container.signin a {
  color: #007bff;
  text-decoration: none;
}

.container.signin a:hover {
  text-decoration: underline;
}


    </style>
</head>
<body>
    <form action="exporterreg.php" method="post">
        <div class="container">
          <h1>Register</h1>
          <p>Please fill in this form to create an account.</p>
          <hr>
      
          <label for="email"><b>Enter Your Name</b></label>
          <input type="text" placeholder="Enter Your Name:" name="name">
      
          <label for="psw"><b>Enter Your Email</b></label>
          <input type="email" placeholder="Enter Email:" name="email" >

          <label for="phone number"><b>Phone number</b></label>
          <input type="text" placeholder="Enter phone number" name="phone" >
      
          
          <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
          <input type="submit" value="Submit" name="submit">
        </div>

        <?php 
        if(isset($_POST["submit"]))
        {
          $name=$_POST["name"];
          $email=$_POST["email"];
          $phone=$_POST["phone"];

          $error=array();
          if(empty($name) || empty($email) || empty($phone))
          {
              array_push($error,"All fields are required");
          }
          if(!filter_var($email,FILTER_VALIDATE_EMAIL))
          {
            array_push($error,"Email is not valid");
          }
          if(strlen($phone)<10 || strlen($phone)>10)
          {
            array_push($error,"Phone must be of 10 digit long");
          }
          if(strlen($phone)<10 || strlen($phone)>10)
          {
            array_push($error,"Phone must be 10 digit long");
          }
          if(($phone>='a' && $phone<='z')  || ($phone>='A' && $phone<='Z'))
            {
                array_push($error,"Invalid Input");
            }
            if(count($error)>0)
            {
                foreach($error as $error)
                {
                    echo "<div class='alert'>$error</div>";
                }
            }
            else{
              require "database.php";
              $stmt = $conn->prepare("INSERT INTO exporterreg (name,email,phone) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name,$email,$phone);
    
                if ($stmt->execute()) {
                echo "<div class='alert-success'>You have been successfully registered!. Proceed to Login!</div>";
                }
                else {
                echo "<div class='alert-danger'>Data Already Present in database.</div>";
                }
            }
        }
        ?>
      
        <div class="container signin">
          <p>Already have an account? <a href="/importexport/exporterlogin.php">Sign in</a>.</p>
        </div>
      </form>
</body>
</html>