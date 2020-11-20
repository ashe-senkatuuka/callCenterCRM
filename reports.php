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


if (true) {
    // Prepare a select statement
    $sql = "SELECT * FROM calls";

    if ($stmt = $pdo->prepare($sql)) {


        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Retrieve and cache calls
            $reports = $stmt->fetchAll(PDO::FETCH_OBJ);
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
    <h2>Customer Care Reports</h2>

    <table class="table table-striped" id="reportsTable">
        <thead>
            <tr>
                <th scope="col">Call Status</th>
                <th scope="col">Preferred Station</th>
                <th scope="col">Reason</th>
                <th scope="col">Product</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($reports as $key => $ticket) {
                /* Populate table rows */
            ?>
                <tr>
                    <th><?= $ticket->ticket_success ?></th>
                    <th><?= $ticket->preferred_station ?></th>
                    <th><?= $ticket->preferred_station_reason ?></th>
                    <th><?= $ticket->preferred_station_product  ?></th>

                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>

</div>
<?php
// Include js scripts
include "scripts.php";
?>

<script>
    $(document).ready(function() {
        let printDate = (new Date().toDateString());
        var table = $('#reportsTable').DataTable({
            // scrollY: 400,
            paging: true,
            dom: 'lBfrtip',
            buttons: [

                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    title: 'CRM Report -- ' +printDate

                }
            ]


        });
    });
</script>

<?php
// Include footer
include "footer.php";
?>