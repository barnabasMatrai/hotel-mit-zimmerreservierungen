<div class="d-flex justify-content-center">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group col-auto">
            <label for="arrival">Anreise:</label>
            <input type="date" name="arrival" id="arrival" class="form-control" required>
            <label for="departure">Abreise:</label>
            <input type="date" name="departure" id="departure" class="form-control" required>
        </div>
        <div class="form-group col-auto float-left">
            <p>Mit/Ohne Frühstück:</p>
            <div class="float-left">
                <label for="withbreakfast">mit</label>
                <input type="radio" name="breakfast" id="withbreakfast" class="form-control">
            </div>
            <div class="float-right">
                <label for="withoutbreakfast">ohne</label>
                <input type="radio" name="breakfast" id="withoutbreakfast" class="form-control">
            </div>
        </div>
        <div class="form-group col-auto float-right">
            <p>Mit/Ohne Parkplatz:</p>
            <div class="float-left">
                <label for="withparking">mit</label>
                <input type="radio" name="parking" id="withparking" class="form-control">
            </div>
            <div class="float-right">
                <label for="withoutparking">ohne</label>
                <input type="radio" name="parking" id="withoutparking" class="form-control">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Reservieren</button>
        </div>
    </form>
</div>