<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importer Registration</title>
    <!-- <link rel="stylesheet" href="importerreg.css"> -->
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
  text-align: center;
  margin-top: 16px;
}

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
<form action="importerreg.php" method="post">
        <div class="container">
          <h1>Register</h1>
          <p>Please fill in this form to create an account.</p>
          <hr>
            
          <input type="text" placeholder="Enter Name" name="name" id="name" required>
                
          <input type="email" placeholder="Enter your Email" name="email" id="email" required>
        
          <input type="text" placeholder="Enter your Phone" name="phone" id="phone" required>
        
        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
          <input type="submit" value="submit" name="submit">
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
        if(count($error)>0)
        {
            foreach($error as $error)
            {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }
        else{
          require "database.php";
          $stmt = $conn->prepare("INSERT INTO importerreg (name,email,phone) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name,$email,$phone);

            if ($stmt->execute()) {
            echo "<div class='alert alert-success'>You have been successfully registered!. Proceed to Login!</div>";
            }
            else {
            echo "<div class='alert alert-danger'>Data Already Present in database.</div>";
            }
        }
      }
      ?>
        </div>
         <div class="container signin">
          <p>Already have an account? <a href="/importexport/importerlogin.php">Sign in</a>.</p>
        </div>
      </form>
</body>
</html>