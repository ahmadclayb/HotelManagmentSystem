<?php
session_start();
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error){
    echo "ERROR CONNECTING TO DATABASE";
    die($conn->connect_error);
  }
  // If login, set session and cookie
	if (isset($_POST['room']) {
  	$room = get_post($conn, 'room');
    $roomString = 'Standard Room';
    if ($room == 'room1'){
      $roomString = 'Standard Room';
    } elseif ($room == 'room2'){
      $roomString = 'Junior Suite';
    } elseif ($room == 'room3'){
      $roomString = 'Superior Room';
    } elseif ($room == 'room4');
      $roomString = 'King Suite'
    }

    $checkindate = get_post($conn, 'checkindate');
    $checkoutdate = get_post($conn, 'checkoutdate');
    $adults = get_post($conn, 'adults');
    $children = get_post($conn, 'children');
    $id = rand(11111, 99999);
    $insert_query = "INSERT INTO bookings (room, checkindate, checkoutdate, adults, children, id) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sssssis", $roomString, $checkindate, $checkoutdate, $adults, $children, $id);
    if($stmt->execute()) {
      echo "Successfully booked appointment.";
      header('Location:booking.html?submitted=true');
    } else {
      echo "INSERT failed: $insert_query<br />" . $conn->error;
      //header('Location:dashboard_patient.php');
    }
  }
  $conn->close();
  function get_post($conn, $var){
    return mysql_fix_string($conn, $_POST[$var]);
  }
  function mysql_entities_fix_string($conn, $string){
    return htmlentities(mysql_fix_string($conn, $string));
  }
  function mysql_fix_string($conn, $string){
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $conn->real_escape_string($string);
  }
?>
