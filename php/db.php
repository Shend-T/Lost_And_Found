<?php
// Lidhu per databaze( db shkurt)
// $conn = new mysqli(
//     "localhost", "root", "", "testdb"
//     );

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "[ubt]lost_and_found"
    ); // databazen e ndrrova pasi qe e kaluara ishte vetem per testim
    // Kodet e komentuara, edhe pse nuk duhen me po i le per hire te transparences :)

// Nese lidhja deshton
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>