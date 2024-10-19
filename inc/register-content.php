<div class="bg-light d-flex justify-content-center">
    <form method="post">
            <div class="form-group col-auto">
                <label for="anrede">Anrede:</label>
                <select name="anrede" id="anrede" class="form-control">
                    <option value="herr">Herr</option>
                    <option value="frau">Frau</option>
                    <option value="divers">Divers</option>
                </select>
            </div>
            <div class="form-group col-auto">
                <label for="vorname">Vorname:</label>
                <input name="vorname" id="vorname" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="nachname">Nachname:</label>
                <input name="nachname" id="nachname" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="email">Email-Adresse:</label>
                <input name="email" type="email" id="email" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="username">Username:</label>
                <input name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="passwort">Passwort:</label>
                <input name="passwort" type="password" id="passwort" class="form-control" required>
            </div>
            <div class="form-group col-auto">
                <label for="passwortWiederholen">Passwort wiederholen:</label>
                <input name="passwortWiederholen" type="password" id="passwortWiederholen" class="form-control" required>
            </div>
        <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>
</div>
