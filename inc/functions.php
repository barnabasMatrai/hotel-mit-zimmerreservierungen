<?php

function check_and_echo_error($data) {
    if ($data !== '')
    {
        echo '<div class="alert alert-danger mt-2"><p class="mb-0">' . $data . '</p></div>';
    }
}

function create_input_tag($type, $name, $value) {
    return '<input name="' . $name . '" type="' . $type . '" id="' . $name . '" class="form-control" value="' . $value . '" required>';
}

function test_capitalized($data) {
    return strlen($data) > 0 ? ctype_upper($data[0]) : true;
}

function test_username($username, $takenUsernames) {
    return in_array($username, $takenUsernames);
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

function arrival_and_departure_valid($arrival, $departure) {
    return $arrival > date('Y-m-d') and $arrival < $departure;
}

?>