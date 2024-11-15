<?php

     // start a session
    // https://www.php.net/manual/en/function.session-start.php

    session_start();

    // if we have a get parameter called logout
    // and if it equals to true we want to logout the user
    // use the global variable $_GET to access the parameters send with the get request
    // e.g. login.php?logout=true ->
    //      $_GET -> Array (
    //          [logout] => true,
    //      );
    // https://www.php.net/manual/en/reserved.variables.get

    if ($_GET["logout"]) {

        // if we logout a user we want to unset the session variable for the user
        // use the global variable $_SESSION
        // https://www.php.net/manual/en/reserved.variables.session.php

        session_unset();

        // setting a header which will force the browser to
        // redirect to the defined location
        // https://www.php.net/manual/en/function.header

        header("Location: ../sites/index.php");

        // output a message and terminate the current script
        // https://www.php.net/manual/en/function.die

        exit("redirect to index");
    }

    // if we post to /login.php
    // the request from our form
    // use the global variable $_SERVER ->
    // Array (
    //      [REQUEST_METHOD] => "POST",
    //      ...,
    //      ...,
    //      ...,
    // )
    // https://www.php.net/manual/en/reserved.variables.server
    // check if the post parameter
    // username and password is set
    // and equals to "admin"
    // https://www.php.net/manual/en/reserved.variables.post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = $_POST["username"];
        $password = $_POST["password"];
        if (isset($username) and isset($password)) {
            // create a session variable user
            // use the global variable $_SESSION
            // https://www.php.net/manual/en/reserved.variables.session.php
            // be sure that you have started a sesusesion
            // https://www.php.net/manual/en/function.session-start.php
            
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"]; 
        }
    }
        ?>

<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="username">Username:</label>
            <input name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <label for="password" id="password-label">Passwort:</label>
            <input name="password" type="password" id="password" class="form-control" required>
        </div>
        <div>
            <input type="hidden" name="form-type" value="login">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
