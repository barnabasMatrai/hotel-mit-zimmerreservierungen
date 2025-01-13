<?php

/* This function is used to show an error message for a given form input if it receives an error message as the argument.
If $errorMessage is an empty string, no error is shown. */
function check_and_echo_error($errorMessage) {
    if ($errorMessage !== '')
    {
        echo '<div class="alert alert-danger mt-2"><p class="mb-0">' . $errorMessage . '</p></div>';
    }
}

/* Creates an input tag with the given type, name, id, and default value */
function create_input_tag($type, $name, $id, $value) {
    return '<input name="' . $name . '" type="' . $type . '" id="' . $id . '" class="form-control" value="' . $value . '" required>';
}

/* Creates an input tag with the given type, name, id, default value, whether it is required and whether it is checked by default
for input types with bool (true/false) values */
function create_bool_input_tag($type, $name, $id, $value, $requiredText, $checkedText) {
    return '<input name="' . $name . '" type="' . $type . '" id="' . $id . '" value="' . $value . '" ' . $requiredText . ' ' . $checkedText . '>';
}

// Returns true if the first letter of a string is capitalized or false if not
function test_capitalized($data) {
    return strlen($data) > 0 ? ctype_upper($data[0]) : true;
}

// Returns true if $password and $repeatedPassword are the same, else returns false
function is_password_same($password, $repeatPassword) {
    return $password === $repeatPassword;
}

// Echoes the 'selected' string if $choice1 is the same as $choice2. Used for selecting from a dropdown list by default
function select_choice($choice1, $choice2)
{
    if (isset($choice1) and $choice2 === $choice1) {
        echo 'selected';
    }
}

// Echoes the 'checked' string if $isActive1 is the same as $isActive2. Used for selecting the isActive radio input by default
function select_isActive($isActive1, $isActive2)
{
    if (isset($isActive1) and $isActive2 == $isActive1) {
        echo 'checked';
    }
}

// Returns true if the arrival date is after the current day, and the arrival date is earlier than the departure date
function arrival_and_departure_valid($arrival, $departure) {
    return $arrival > date('Y-m-d') and $arrival < $departure;
}

// Returns the user if they exist
function findUser($users, $userId) {
    foreach ($users as $user) {
        if ($user -> Id == $userId) {
            return $user;
        }
    }

    return NULL;
}

?>