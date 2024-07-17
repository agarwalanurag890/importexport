<!DOCTYPE html>
<html lang="en">
<head>
  
    <title>Farmer Login</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 520px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
.btn{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}


    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form  action="farmerlogin.php" method="post">
        
        <h3>Farmer Login</h3>

        <label for="username">Name</label>
        <input type="text" placeholder="Enter Your Username" id="username" name="name">

        <label for="Name">Phone</label>
        <input type="text" placeholder="Enter Your Name" id="password" name="phone">

        <input type="submit" value="Submit" class="btn" name="submit">
        
    </form>

    <?php 
    if(isset($_POST["submit"]))
    {
        $name=$_POST["name"];
        $phone=$_POST["phone"];

        $error=array();

        if(empty($name) || empty($phone))
        {
            array_push($error,"All fields are required!");
        }
        if(strlen($phone)<10 || strlen($phone)>10)
        {
            array_push($error,"Phone Must be of 10 digits");
        }
        if(count($error)>0){
            foreach($error as $error)
            {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }
        else{
            require "database.php";

            $stmt = $conn->prepare("SELECT * FROM farmerreg WHERE name = ? AND phone = ?");
            $stmt->bind_param("ss", $name, $phone);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                // Successful login, redirect to welcome.html
                header("Location: welcome.html");
                exit;
            } else {
                // Invalid login credentials, display an error message
                echo "<div class='alert alert-danger'>Login failed. Invalid name and phone combination.</div>";
            }
        }

    }
    ?>
</body>
</html>