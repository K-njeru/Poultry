<?php
require_once 'vendor/autoload.php';

// Include Twilio PHP library
use Twilio\Rest\Client;

include('includes/checklogin.php');
check_login();

$id =  $_SESSION['odmsaid'];
$FirstName = $_SESSION['names'];

$query = "SELECT MobileNumber FROM tbladmin WHERE ID = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if a row is returned
if ($result->num_rows > 0) {
    // Fetch the mobile number from the result set
    $row = $result->fetch_assoc();
    $mobileNumber = $row['MobileNumber'];
    // Add "254" at the beginning of the mobile number
    $mobileNumber = '+254' . $mobileNumber;


} else {
    echo "No user found with the provided ID.";
}
//echo $mobileNumber .'<br>'; 
//echo $FirstName;


// Twilio credentials
$account_sid = 'AC4e478d2c35f755380c52f699db29e0d0';
$auth_token = 'c64dd27639f569df61598575834a11f0';
$twilio_number = '+12564148039';
//$client = new Twilio\Rest\Client($account_sid, $auth_token);
$twilio = new Client($account_sid, $auth_token);

    // Fetch today's date
    $currentDate = date('Y-m-d');
    //echo $currentDate .'<br>';

// Query to fetch vaccination date, arrival date, and poultry name
$query = "SELECT CategoryName, NextVaccination, ArrivalDate, PoultryName FROM tblpoultry";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $category = $row['CategoryName'];
        $vaccination_date = $row['NextVaccination'];
        $arrival_date = $row['ArrivalDate'];
        $poultry_name = $row['PoultryName'];

        // Calculate the age of the poultry in days
        $interval = date_diff(date_create($arrival_date), date_create($currentDate));
        $daysInterval = $interval->days;
     

// Check if the vaccination date is today
if ($vaccination_date == $currentDate) {
    // Check if the notification has already been sent for this poultry
    $checkQuery = "SELECT notification FROM tblpoultry WHERE PoultryName = ?";
    $checkStmt = $con->prepare($checkQuery);
    $checkStmt->bind_param("s", $poultry_name);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $row = $checkResult->fetch_assoc();
        $notificationStatus = $row['notification'];

        if ($notificationStatus == 1) {
            // Notification already sent, do not send again
            echo "Notification already sent for $poultry_name. Skipping...\n";
        } else {
            // Prepare and send SMS using Twilio
            $message = "Hello $FirstName. It is vaccination date for: $poultry_name registered in your PMS under category: $category. The poultry are now $daysInterval days old and require urgent attention. Please comply!";

            try {
                $message = $twilio->messages
                    ->create(" $mobileNumber", // to
                        array(
                            "from" => "+12564148039",
                            "body" => "$message"
                        )
                    );

                echo "SMS sent successfully to $mobileNumber: $message\n";

                // Update the notification column to 1 for this poultry
                $updateQuery = "UPDATE tblpoultry SET notification = 1 WHERE PoultryName = ?";
                $updateStmt = $con->prepare($updateQuery);
                $updateStmt->bind_param("s", $poultry_name);
                $updateStmt->execute();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage() . "\n";
            }
        }
    } else {
        echo "No notification record found for $poultry_name.\n";
    }
} else {
    echo "Not a vaccination date for $poultry_name.\n";
}
}
} else {
    echo "No poultry found in the database.\n";
}
?>
