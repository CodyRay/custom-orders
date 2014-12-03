<?php
function openconnection() {
    $connection = new mysqli($db_host, $db_user, $db_pass, $db_data);

    if($connection->connect_error) {
        $error = array("Connect Error (" . mysql_connect_errno() . ") " . mysqli_connect_error());
        render_errors($error, "There was a mysterious database error...");
        return false;
    }
    return $connection;
}

function sanitizeinput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function example($getid) {
    if($con = openconnection()) {
        if($query = $con->prepare("SELECT * FROM mytable WHERE getid=?")) {
            $query->bind_param("i", $getid); 
            $query->execute();
            if($query->error) {
                $error = array($query->error);
                render_errors($error, "MySQL Reported an Error Executing a Query");
                $con->close();
                return NULL;
            }
            $response = $query->get_result();
            while($row = $response->fetch_assoc()) {
                $result[] = $row;
            }
            if(isset($result)) {
                return $result[0]; //Only one item in array
            }
            else {
                return NULL;
            }
        }
        $con->close();
    }
}

?>
