<?php

function getDb() {
    $config = require('..\config\dbaccess.php');
    $db = new mysqli($config["host"], $config["user"], $config["password"], $config["database"]);

    if ($db->connect_error) {
        echo "Connection Error: " . $db->connect_error;
        exit();
    }
    return $db;
}

function changeDbUserToAdmin($db) {
    $config = require('..\config\dbaccess.php');
    $db -> change_user($config["adminUser"], $config["adminPassword"], $config["database"]);
}

function changeDbUserToRegular($db) {
    $config = require('..\config\dbaccess.php');
    $db -> change_user($config["user"], $config["password"], $config["database"]);
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
?>
