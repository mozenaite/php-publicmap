
<?php
$errors = "";

// connect to the database
$db = mysqli_connect("localhost", "root", "", "todolist");


if (isset($_POST["submit"])){
    $task = $_POST["task"];
    if (empty($task)){
        $errors = "You must fill in the task";
    }else {
   mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
    header("location: index.php");
    }
}
//delete task
if (isset($_GET["del_task"])){
    $id = $_GET["del_task"];
    mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
    header("location: index.php");
}

$tasks = mysqli_query($db, "SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To do list</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main>
<div class="heading">
<h2>To Do List</h2>
</div>

<form method="POST" action="index.php">
    <?php if (isset($errors)){ ?>
        <p><?php echo $errors; ?></p>

    <?php } ?>
<input type="text" name="task" class="task_input">
<button type="submit" class="add_btn" name="submit">Add Task</button>
</form> 

<table>
    <thead>
        <tr>
            <th>N</th>
            <th>Task</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_array($tasks)){ ?>
        <tr>
            <td class="n"><?php echo $i; ?></td>
            <td class="task"><?php echo $row["task"]; ?></td>
            <td class="delete">
                <a href="index.php?del_task=<?php echo $row["id"]; ?>">x</a>
            </td>
        </tr>
    <?php $i++; } ?>
    </tbody>
</table>
</main>
<footer>
<div class="footer-div">      
        <div class="footer-social-icons">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <ul>
                    <li><a href="#" target="blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" target="blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#" target="blank"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#" target="blank"><i class="fa fa-youtube"></i></a></li>
                </ul>
        </div>

                        <div class="footer-menu-one">
                            <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Products</a></li>
                            <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>

                        <div class="footer-menu-two">
                                <ul>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">News</a></li>
                                <li><a href="#">Gallery</a></li>
                                <li><a href="#">Media</a></li> 
                                </ul>
                            </div>    
</div>
</footer>                   
</body>
</html>