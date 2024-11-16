<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="username">Username:</label>
            <input name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <label for="password">Passwort:</label>
            <input name="password" type="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>