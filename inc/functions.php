<?php

function check_and_echo_error($data) {
    if ($data !== '')
    {
        echo '<div class="alert alert-danger mt-2"><p class="mb-0">' . $data . '</p></div>';
    }
}

function create_input_tag($type, $name, $id, $value) {
    return '<input name="' . $name . '" type="' . $type . '" id="' . $id . '" class="form-control" value="' . $value . '" required>';
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

function select_choice($choice1, $choice2)
{
    if (isset($choice1) and $choice2 === $choice1) {
        echo 'selected';
    }
}

function select_isActive($isActive1, $isActive2)
{
    if (isset($isActive1) and $isActive2 == $isActive1) {
        echo 'checked';
    }
}

function arrival_and_departure_valid($arrival, $departure) {
    return $arrival > date('Y-m-d') and $arrival < $departure;
}

function findUser($users, $userId) {
    foreach ($users as $user) {
        if ($user -> Id == $userId) {
            return $user;
        }
    }

    return NULL;
}

?>