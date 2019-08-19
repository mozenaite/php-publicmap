 <?php
   session_start();
    require_once("index.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['logout'])) {
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            echo "You are logged out";
            header("Location: index.php");
            //so the rest of the code should not execute here
        }
        $db = mysqli_connect("localhost", "root", "", "todolist");
        

        //TODO field validation from https://www.php.net/book.filter
        if (!isset($_POST["uname"])) header("Location: index.php");
        $username = $_POST["uname"];
        $pw = $_POST['pw'];
        $stmt = $db->prepare("SELECT id, username, pwhash FROM users WHERE username = ?");
        $stmt->bind_param("s", $username); // "sss" means the values are 3 strings (another type is "d" or "f")
        // set parameters and execute
        $stmt->execute();
        $res = $stmt->get_result();
        $db->close();
        
        if ($res->num_rows < 1) {
            echo "Bad Login";
        }
        $row = $res->fetch_assoc();
        // var_dump($row);
        // echo $row['username'];
        // echo $row['id'];
        // echo $row['pwhash'];
        if (password_verify ($pw , $row['pwhash'])) {
            echo "Logged in";
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $username;
            echo $username."is logged in<br>";
            if (isset($_POST['savelogin'])) {
                echo "Saving Loggin";
                //TODO think about safety!
                setcookie("TestCookie", $_SESSION['username'], time()+3600);
                //setcookie here
            }
        }
       
        // $_SESSION['uname'] = $_POST['uname'];
        // header("Location: login.php");
    }
?>

<form method="POST" action="index.php">
    Save Login<input type="checkbox" name="savelogin">
    Login<input name = "uname">
    Password
    <input name="pw">
    <button type="submit" name="login">LOGIN</button>
    <button type="submit" name="logout">LOGOUT</button>
    
</form>