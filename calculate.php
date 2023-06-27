<!DOCTYPE html>
<html>
<head>
    <title>Electricity Rate Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Electricity Rate Calculator</h1>
        <form method="POST" action="calculate.php">
            <div class="form-group">
                <label for="voltage">Voltage (V)</label>
                <input type="number" class="form-control" id="voltage" name="voltage">
            </div>
            <div class="form-group">
                <label for="current">Current (A)</label>
                <input type="number" class="form-control" id="current" name="current">
            </div>
            <div class="form-group">
                <label for="current_rate">Current Rate</label>
                <input type="number" class="form-control" id="current_rate" name="current_rate">
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>
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

    echo "Power: " . calculatePower($voltage, $current) . " Wh<br>";
    echo "Energy for 1 hour: " . calculateEnergy($voltage, $current, 1) . " kWh<br>";
    echo "Total charge per hour: MYR" . calculateTotalCharge($voltage, $current, $current_rate, 1) . "<br>";
    echo "Total charge for a day :  MYR" . calculateTotalCharge($voltage, $current, $current_rate, 24) . "<br>";
}
