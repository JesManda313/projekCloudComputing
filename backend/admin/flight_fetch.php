<?php
require_once "../db.php";
date_default_timezone_set("Asia/Jakarta");

$filter_date = $_GET['date'] ?? null;

if ($filter_date) {
    $stmt = $conn->prepare("
        SELECT f.*, a.airline_name, 
               o.city AS origin_city, o.airport_code AS origin_code,
               d.city AS dest_city, d.airport_code AS dest_code
        FROM flights f
        JOIN airlines a ON f.airline_id = a.id_airline
        JOIN airports o ON f.origin_airport = o.id_airport
        JOIN airports d ON f.destination_airport = d.id_airport
        WHERE departure_date = ?
        ORDER BY departure_date, departure_time
    ");
    $stmt->bind_param("s", $filter_date);
} else {
    $stmt = $conn->prepare("
        SELECT f.*, a.airline_name, 
               o.city AS origin_city, o.airport_code AS origin_code,
               d.city AS dest_city, d.airport_code AS dest_code
        FROM flights f
        JOIN airlines a ON f.airline_id = a.id_airline
        JOIN airports o ON f.origin_airport = o.id_airport
        JOIN airports d ON f.destination_airport = d.id_airport
        ORDER BY departure_date, departure_time
    ");
}

$stmt->execute();
$result = $stmt->get_result();

$flights = [];

while ($row = $result->fetch_assoc()) {

    $now = new DateTime();
    $dep = new DateTime($row['departure_date'] . " " . $row['departure_time']);
    $arr = new DateTime($row['arrival_date']   . " " . $row['arrival_time']);

    if ($arr < $now) {
        $row['status'] = "Arrived";
        $row['status_color'] = "bg-gray-200 text-gray-700";
    } elseif ($dep <= $now && $arr >= $now) {
        $row['status'] = "Ongoing";
        $row['status_color'] = "bg-yellow-200 text-yellow-800";
    } else {
        $row['status'] = "Upcoming";
        $row['status_color'] = "bg-green-200 text-green-800";
    }

    $flights[] = $row;
}

echo json_encode($flights);
exit;
?>
