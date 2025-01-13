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

function userExists($username) {
    $db = getDb();

    $sql = "SELECT * FROM user WHERE username=?";
    $statement = $db->prepare($sql);
    $statement->bind_param("s", $username);
    $statement->execute();
    return (bool) $statement->fetch();
}

function getUserSecure($username) {
    $db = getDb();

    $sql = "SELECT * FROM user WHERE UserName=?";
    $statement = $db->prepare($sql);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}

function insertUser($title, $firstname, $lastname, $email, $username, $password) {
    $db = getDb();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO user (Title, FirstName, LastName, Email, UserName, Password, IsAdmin) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $isAdmin = 0;
        $stmt->bind_param("ssssssi", $title, $firstname, $lastname, $email, $username, $hashedPassword, $isAdmin);

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

function insertReservation($userid, $arrival, $departure, $breakfast, $parking, $cat, $price, $bookingDate) {
    $db = getDb();

    $stmt = $db->prepare("INSERT INTO reservation (UserId, Arrival, Departure, Breakfast, Parking, Cat, Price, BookingDate) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("issiiiis", $userid, $arrival, $departure, $breakfast, $parking, $cat, $price, $bookingDate);

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

function getAllReservations() {
    $db = getDb();

    $stmt = $db->prepare("SELECT * FROM reservation");
    if ($stmt) {
        // $stmt->bind_param("i", $userid);

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

function getReservations($userid) {
    $db = getDb();

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

function getReservation($id) {
    $db = getDb();

    $stmt = $db->prepare("SELECT * FROM reservation WHERE Id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Reservation found successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $result = $stmt->get_result();
        $obj = $result->fetch_object();

        $stmt->close();

        return $obj;
    } else {
        echo "Error preparing the statement: " . $db->error;
    }

    return null;
}

function getUsers() {
    $db = getDb();

    $result = $db->query("SELECT * FROM user
                          ORDER BY Id");
    $array = [];
    while ($obj = $result->fetch_object()) {
        $array[] = $obj;
    }

    return $array;
}

function updatePassword($newPassword, $userId) {
    $db = getDb();

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $stmt = $db ->prepare("UPDATE user SET Password = ? WHERE Id = ?");
    if ($stmt) {
        $stmt->bind_param("si", $hashedPassword, $userId);

        if ($stmt->execute()) {
            echo "Password changed successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

function getPassword($userId) {
    $db = getDb();

    $stmt = $db ->prepare("SELECT Password FROM user WHERE Id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            echo "Found password successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $result = $stmt->get_result();
        $stmt->close();
        
        if ($result->num_rows > 0) {
            $obj = $result->fetch_object();
            return $obj -> Password;
        }  
    }
    return null;
}

function insertArticle($comment, $filename, $uploadDate) {
    $db = getDb();

    $stmt = $db ->prepare("INSERT article (Comment, Filename, UploadDate)
                           VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $comment, $filename, $uploadDate);

        if ($stmt->execute()) {
            echo "New record created successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

function getArticles() {
    $db = getDb();

    $result = $db->query("SELECT * FROM article
                          ORDER BY UploadDate DESC");
    $array = [];
    while ($obj = $result->fetch_object()) {
        $array[] = $obj;
    }

    return $array;
}

function updateUser($userId, $title, $firstName, $lastName, $email) {
    $db = getDb();

    $stmt = $db ->prepare("UPDATE user SET Title = ?, FirstName = ?, LastName = ?, Email = ? WHERE Id = ?");
    if ($stmt) {
        $stmt->bind_param("ssssi", $title, $firstName, $lastName, $email, $userId);

        if ($stmt->execute()) {
            echo "Profile data updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

function updateIsActive($isActive, $userId) {
    $db = getDb();

    $stmt = $db ->prepare("UPDATE user SET IsActive = ? WHERE Id = ?");
    if ($stmt) {
        $stmt->bind_param("ii", $isActive, $userId);

        if ($stmt->execute()) {
            echo "Active state changed successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

function updateStatus($status, $id) {
    $db = getDb();

    $stmt = $db ->prepare("UPDATE reservation SET Status = ? WHERE Id = ?");
    if ($stmt) {
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            echo "Status changed successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

function isReservationAvailable($arrival, $departure) {
    $db = getDb();
    
    $sql = "SELECT * FROM reservation
            WHERE Arrival BETWEEN ? AND ? OR Departure BETWEEN ? AND ?";
    $statement = $db->prepare($sql);
    $statement->bind_param("ssss", $arrival, $departure, $arrival, $departure);
    $statement->execute();
    return !(bool) $statement->fetch();
}

?>
