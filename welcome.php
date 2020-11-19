<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION['id'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['id']);
    header("location:index.php");
}

// Include config file
require_once "config.php";

// Include header
include "header.php";

?>
<div class="container">
    <h2>Enter call details</h2>
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <div class="form-group">
            <h4>Am I speaking to the right person?</h4>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="rigthPerson" id="rightPerson1" value="true">
                <label class="form-check-label" for="rightPerson1">Yes</label>
            </div>
            <!-- When user selects No Javascript must disable all other fields -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="rigthPerson" id="rightPerson2" value="false">
                <label class="form-check-label" for="rightPerson2">No</label>
            </div>
        </div>
        <div class="form-group">
            <h4>What is your preferred fuel station?</h4>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="fuelStation" id="fuelStation1" value="total">
                <label class="form-check-label" for="fuelStation1">Total</label>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="fuelStation" id="fuelStation2" value="shell">
                <label class="form-check-label" for="fuelStation2">Shell</label>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="fuelStation" id="fuelStation3" value="stabex">
                <label class="form-check-label" for="fuelStation3">Stabex</label>
            </div>
        </div>

        <div class="form-group">
            <label for="reason">
                <h4>Why do you like fueling at (fuel station)?</h4>
            </label>
            <textarea class="form-control" id="reason" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="reason">
                <h4>What product do you like using for (fuel station)?</h4>
            </label>
            <textarea class="form-control" id="reason" rows="3"></textarea>
        </div>

        <div class="form-group">
            <h5>We have come to the end. Thank you for your time and cooperation, your input is
                valued. Good bye...</h5>
        </div>

        <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
</div>



<?php
// Include footer
include "footer.php";
?>