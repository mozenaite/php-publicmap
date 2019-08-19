<?php
    session_start();
    require_once("index.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = mysqli_connect("localhost", "root", "", "todolist");
        
   
        //TODO field validation from https://www.php.net/book.filter
        $username = $_POST["uname"] ;
        $lastname = "";
        if (isset($_POST["lastname"])) $lastname = $_POST["lastname"];
        
        //TODo same for email
        $email = $_POST["email"];
        $pwhash = "BadHash";
        if ($_POST["pw"] == $_POST["pw2"] ) {
            $pwhash = password_hash($_POST["pw"], PASSWORD_DEFAULT);
        } else {
            header("Location: index.php");
        }
        
        $stmt = $db->prepare("INSERT INTO users (username, lastname, email, pwhash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $lastname, $email, $pwhash); // "sss" means the values are 3 strings (another type is "d" or "f")
        // set parameters and execute
        $stmt->execute();
        $db->close();
        header("Location: index.php");
    }
?>
    <form action="index.php" method="POST">
        <div>Username <input name="uname" required placeholder="Enter Username"></div>
        <div>Lastname <input name="lastname" placeholder="Enter Lastname"></div>
        <div>Password <input name="pw" required></div>
        <div>Password <input name="pw2" required></div>
        <div>E-mail <input name="email" type="email" value="enter e-mail"></div>

        <button type="submit">SUBMIT</button>
    </form>