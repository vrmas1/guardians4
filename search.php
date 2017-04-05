<!--
	Guardians4
-->
<?php
    $servername = "130.56.254.187";
    $username = "jzhu";
    $password = "Guardians4";
    $dbname = "db_guardians";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $suburb = $_POST['postcodeAjax'];
    $lang = $_POST['langAjax'];
    $gender = $_POST['genderAjax'];

    $sql = "SELECT * FROM doctor WHERE id in (SELECT doctor_id FROM doctor_language WHERE lang_id =(SELECT id FROM language WHERE lang = '$lang')) AND postcode = '$suburb' AND gender = '$gender'";
    $result = $conn->query($sql);
    $rows = array();

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        print  json_encode($rows);
    } else {
        echo "empty";
    }

    $conn->close();
?>