<!DOCTYPE html>
<html>
<head>
    <title>Electricity Rate Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Electricity Rate Calculator</h1>
        <form method="POST">
        <label for="voltage">Voltage (V): </label>
        <input type="number" id="voltage" name="voltage" step="any"><br>
        <label for="current">Current (A): </label>
        <input type="number" id="current" name="current" step="any"><br>
        <label for="current_rate">Current Rate: </label>
        <input type="number" id="current_rate" name="current_rate" step="any"><br>
        <input type="submit" value="Calculate">
</form>

    </div>
   

</form>

</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voltage = $_POST['voltage'];
    $current = $_POST['current'];
    $current_rate = $_POST['current_rate'];

    function calculatePower($voltage, $current) {
        return $voltage * $current; // Power in Wh
    }

    function calculateEnergy($voltage, $current, $hours) {
        $power = calculatePower($voltage, $current);
        return ($power * $hours) / 1000; // Energy in kWh
    }

    function calculateTotalCharge($voltage, $current, $current_rate, $hours) {
        $energy = calculateEnergy($voltage, $current, $hours);
        return $energy * ($current_rate / 100); // Total charge
    }

    echo "<table>";
    echo "<tr><th>Hour</th><th>Energy (kWh)</th><th>Total (RM)</th></tr>";
    for ($i = 1; $i <= 24; $i++) {
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . number_format(calculateEnergy($voltage, $current, $i), 5) . "</td>";
        echo "<td>" . number_format(calculateTotalCharge($voltage, $current, $current_rate, $i), 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<br>Power: " . number_format(calculatePower($voltage, $current), 5) . " kW";
    echo "<br>Rate: " . number_format($current_rate / 100, 3) . " RM";
}
?>

