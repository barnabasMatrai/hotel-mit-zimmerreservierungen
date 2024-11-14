<div class="d-flex justify-content-center">
    <form method="post" action="../sites/index.php">
        <div class="form-group col-auto">
            <label for="username">Username:</label>
            <input name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group col-auto">
            <label for="passwort" id="password-label">Passwort:</label>
            <input name="passwort" type="password" id="passwort" class="form-control" required>
        </div>
        <div>
            <input type="hidden" name="form-type" value="login">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>