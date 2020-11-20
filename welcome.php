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

// Require helper class
require "functions.php";


if (isset($_POST['callDetails'])) {
    // Sanitize and cache user input
    $success = test_input($_POST['rigthPerson']);
    $fuelStation = test_input($_POST['fuelStation']);
    $reason = test_input($_POST['reason']);
    $procuct = test_input($_POST['product']);


    // Prepare a select statement
    $sql = "INSERT INTO calls(ticket_success, preferred_station, preferred_station_reason, preferred_station_product)
    VALUES (:success,:fuelStation,:reason,:product)";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":success", $param_success, PDO::PARAM_STR);
        $stmt->bindParam(":fuelStation", $param_fuelStation, PDO::PARAM_STR);
        $stmt->bindParam(":reason", $param_reason, PDO::PARAM_STR);
        $stmt->bindParam(":product", $param_product, PDO::PARAM_STR);

        // Set parameters
        $param_success = $success;
        $param_fuelStation = $fuelStation;
        $param_reason = $reason;
        $param_product = $procuct;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            echo "success";
        }
    }
}

?>

<?php
// Include header
include "header.php";
// Include navigation bar
include "navbar.php";
?>
<div class="container">
    <h2>Enter call details</h2>
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="form-group">
            <h4>Am I speaking to the right person?</h4>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="rigthPerson" id="rightPerson1" value="Right person" required>
                <label class="form-check-label" for="rightPerson1">Yes</label>
            </div>
            <!-- When user selects No Javascript must disable all other fields -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="rigthPerson" id="rightPerson2" value="Wrong person" required>
                <label class="form-check-label" for="rightPerson2">No</label>
            </div>
        </div>
        <div class="form-group">
            <h4>What is your preferred fuel station?</h4>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="fuelStation" id="fuelStation1" value="Total" required>
                <label class="form-check-label" for="fuelStation1">Total</label>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="fuelStation" id="fuelStation2" value="Shell" required>
                <label class="form-check-label" for="fuelStation2">Shell</label>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="fuelStation" id="fuelStation3" value="Stabex" required>
                <label class="form-check-label" for="fuelStation3">Stabex</label>
            </div>
        </div>

        <div class="form-group">
            <label for="reason">
                <h4>Why do you like fueling at (fuel station)?</h4>
            </label>
            <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="product">
                <h4>What product do you like using for (fuel station)?</h4>
            </label>
            <textarea class="form-control" id="product" name="product" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <h5>We have come to the end. Thank you for your time and cooperation, your input is
                valued. Good bye...</h5>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="callDetails">Submit</button>
        </div>

    </form>
</div>



<?php
// Include footer
include "footer.php";
?>