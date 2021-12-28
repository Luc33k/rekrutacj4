<main class = "form-raport">
    <form action="./raportScript.php" method="GET">
        <label for="start">Od:</label>
        <input type="date" id="start" name="raport_start"
            value="2019-07-22"
            min="2019-01-01" max="2021-11-24">
        <label for="start">Do:</label>

        <input type="date" id="end" name="raport_end"
            value="2019-07-22"
            min="2019-01-01" max="2021-11-24">
        <button class="w-50 btn btn-md btn-primary" type="submit" id="button_submit" name="button_submit">Zaloguj</button>
    </form>
</main>


<?# require_once ('./raportScript.php')?>

