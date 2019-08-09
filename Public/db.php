<?php
   $conn = mysqli_connect("127.0.0.1","root", "", "music0808");
   
 
    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
   
    echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;
 
    $sql = "SELECT * FROM tracks";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["album"]. "<br>";
        }
        echo "<hr>";
    } else {
        echo "0 results";
    }

    $mydata = $result->fetch_all(MYSQLI_ASSOC);
    mysqli_close($conn);


    