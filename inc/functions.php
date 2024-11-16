<?php

function check_and_echo_error($data) {
    if ($data !== '')
    {
        echo '<div class="alert alert-danger mt-2"><p class="mb-0">' . $data . '</p></div>';
    }
}

function test_input($data) {
    $data = htmlspecialchars($data);
    return $data;
}

function create_input_tag($type, $name, $value) {
    return '<input name="' . $name . '" type="' . $type . '" id="' . $name . '" class="form-control" value="' . $value . '" required>';
}

function test_capitalized($name, $data) {
    return $data[0]=== strtolower($data[0]) ? $name . ' muss mit einem Grossbuchstaben beginnen!' : '';
}

function test_username($username, $takenUsernames) {
    return in_array($username, $takenUsernames) ? 'Username ist schon vergeben!' : '';
}

function is_password_same($password, $repeatPassword) {
    return $password === $repeatPassword;
}

function select_title($title)
{
    if (isset($_SESSION['title']) and $title === $_SESSION['title']) {
        echo 'selected';
    }
}

?>