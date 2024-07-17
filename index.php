<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import-Export</title>
    <link rel="stylesheet" href="/importexport/style.css">
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="/phone.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Bree+Serif&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <nav id="navbar">
        <div id="logo">
            <img src="/importexport/logo.png" alt="Import-Export">
        </div>
        <ul class="br">
            <li class="item"><a href="#home">Home</a></li>
            <li class="item"><a href="#services-container">Services</a></li>
            <li class="item"><a href="#client-section">Our Clients</a></li>
            <li class="item"><a href="#contact">Contact Us</a></li>
        </ul>
    </nav>

    <section id="home">
        <h1 class="h-primary">WELCOME TO</h1>
        <h1 class="h-primary">IMPORT-EXPORT MANAGEMENT SYSTEM</h1>
    </section>

    <section id="services-container">
        <h1 class="h-primary center">Management Login</h1>
        <div id="services">
            <div class="box">
                <img src="/importexport/farmer.jpg" alt="img load failed">
                <h2 class="h-secondary center">Farmer Login</h2>
                <div class="inline">
                    <div class="div1">
                        <a href="/importexport/farmerreg.php">

                            <button class="btn10">Register Here</button></a>
                    </div>
                    <div class="div2">
                        <a href="/importexport/farmerlogin.php" >
                            <button class="btn20">Login</button></a>
                    </div>
                </div>
                    <p class="center">
                    </p>
            </div>
            <div class="box">
                <img src="/importexport/importer.jpg" alt="img load failed">
                <h2 class="h-secondary center">Importer Login</h2>
                <div class="inline">
                    <div class="div1">
                        <a href="/importexport/importerreg.php" >
                            <button class="btn10">Register Here</button></a>
                    </div>
                    <div class="div2">
                        <a href="/importexport/importerlogin.php">
                            <button class="btn20">Login</button></a>
                        </div>
                    </div>
                        <p class="center"></p>
            </div>
            <div class="box">
                <img src="/importexport/exporters.jpg" alt="img load failed">
                <h2 class="h-secondary center">Exporter Login</h2>

                <div class="inline">
                    <div class="div1">
                        <a href="/importexport/exporterreg.php">
                            <button class="btn10">Register Here</button></a>
                    </div>
                    <div class="div2">
                        <a href="/importexport/exporterlogin.php">
                            <button class="btn20">Login</button></a>
                    </div>
                </div>
                <p class="center"></p>

            </div>
        </div>
    </section>


    <section id="contact">
        <h1 class="h-primary center">Contact Us</h1>
        <div id="contact-box">
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number: </label>
                    <input type="phone" name="phone" id="phone" placeholder="Enter your phone">
                </div>
                <div class="form-group">
                    <label for="message">Message: </label>
                    <textarea name="msg" id="message" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </section>

<?php 
if(isset($_POST["submit"]))
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $msg=$_POST["msg"];

    $error=array();

        if(empty($name) || empty($email) || empty($phone) || empty($msg))
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
        if(!strlen($msg)>2)
        {
            array_push($error,"Message must be greater than 2 character");
        }
        if(count($error)>0)
        {
            foreach($error as $error)
            {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }
        else 
        {
            require "database.php";
            // $sql = "create database importexport";
            // if($conn->query($sql)===True)
            // {
            //     echo "database has been created";
            // }
            // else{
            //     die("Failed to create database").$conn->error;
            // }

            // $sql="use importexport";
            // if($conn->query($sql)===True)
            // {
            //     echo "database has been Choosen";
            // }
            // else{
            //     die("Failed to choose database").$conn->error;
            // }

            // $sql="create table contact(name varchar(30),email varchar(30),phone varchar(10),msg varchar(100))";
            // if($conn->query($sql)===True)
            // {
            //     echo "Table has been created";
            // }
            // else{
            //     die("Failed to create table").$conn->error;
            // }

            // $sql="insert into contact(name,email,phone,msg) values (?,?,?,?)";
            // $stmt=mysqli_stmt_init($conn);
            // $prepare=mysqli_stmt_prepare($stmt,$sql);
            // if($prepare)
            // {
            //     mysqli_stmt_bind_param($stmt,"ssss",$name,$email,$phone,$msg);
            //     mysqli_stmt_execute($stmt);
            //     echo "<div class='alert alert-success'> Thank you for contacting us! </div>";
                
            // }

            $stmt = $conn->prepare("INSERT INTO contact (name, email, phone, msg) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $msg);

            if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Thank you for contacting us!</div>";
            }
            else {
            echo "<div class='alert alert-danger'>Something went wrong.Please Refresh the page.</div>";
            }
        }
} 

?>


    <footer>
        <div class="center">
            Copyright &copy; Shrinivas
        </div>
    </footer>

</body>

</html>