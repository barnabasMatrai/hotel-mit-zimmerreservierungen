<?php
$db = NULL;

function getDb() {
    $config = require('..\config\dbaccess.php');
    global $db;

    if (!isset($db)) {
        $db = new mysqli($config["host"], $config["user"], $config["password"], $config["database"]);
    
        if ($db->connect_error) {
            echo "Connection Error: " . $db->connect_error;
            exit();
        }
    }
    return $db;
}

function userExists($db, $username) {
    $sql = "SELECT * FROM user WHERE username=?";
    $statement = $db->prepare($sql);
    $statement->bind_param("s", $username);
    $statement->execute();
    return (bool) $statement->fetch();
}

function getUserSecure($db, $username, $password) {
    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    $statement = $db->prepare($sql);
    $statement->bind_param("ss", $username, $password);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}

function insertUser($db, $title, $firstname, $lastname, $email, $username, $password) {
    $stmt = $db->prepare("INSERT INTO user (Title, FirstName, LastName, Email, UserName, Password, IsAdmin) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $isAdmin = 0;
        $stmt->bind_param("ssssssi", $title, $firstname, $lastname, $email, $username, $password, $isAdmin);

        if ($stmt->execute()) {
            echo "New record created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $db->error;
    }
}

function insertReservation($db, $userid, $arrival, $departure, $breakfast, $parking, $cat) {
    $stmt = $db->prepare("INSERT INTO reservation (UserId, Arrival, Departure, Breakfast, Parking, Cat) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("issiii", $userid, $arrival, $departure, $breakfast, $parking, $cat);

        if ($stmt->execute()) {
            echo "New record created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $db->error;
    }
}

function getReservations($db, $userid) {
    $stmt = $db->prepare("SELECT * FROM reservation WHERE UserId = ?");
    if ($stmt) {
        $stmt->bind_param("i", $userid);

        if ($stmt->execute()) {
            echo "Reservations found successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $result = $stmt->get_result();

        $array = [];
        while ($obj = $result->fetch_object()) {
            $array[] = $obj;
        }

        $stmt->close();

        return $array;
    } else {
        echo "Error preparing the statement: " . $db->error;
    }

    return null;
}

function updatePassword($db, $newPassword, $userId) {
    $stmt = $db ->prepare("UPDATE user SET Password = ? WHERE Id = ?");
    if ($stmt) {
        $stmt->bind_param("si", $newPassword, $userId);

        if ($stmt->execute()) {
            echo "Password changed successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

?>
