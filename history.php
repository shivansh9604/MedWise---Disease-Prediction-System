<?php
session_start();
include 'config.php';

// Fetch data from the database
$search = isset($_GET['search']) ? $_GET['search'] : '';
$from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
$to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';

$query = "SELECT * FROM predictions WHERE 1";

// Apply filters
if (!empty($search)) {
    $query .= " AND (glucose LIKE '%$search%' OR blood_pressure LIKE '%$search%' OR age LIKE '%$search%' OR prediction LIKE '%$search%')";
}
if (!empty($from_date) && !empty($to_date)) {
    $query .= " AND DATE(created_at) BETWEEN '$from_date' AND '$to_date'";
}
$query .= " ORDER BY created_at DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #f8f9fa, #dfe4ea);
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 40px auto;
            text-align: center;
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
            cursor: pointer;
        }
        th:hover {
            background: #0056b3;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .btn-delete, .btn-clear {
            background: red;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-delete:hover, .btn-clear:hover {
            background: darkred;
        }
        .btn-back {
            background: #007bff;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-back:hover {
            background: #0056b3;
        }
        .search-bar {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }
        .pagination {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }
        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            text-decoration: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
        }
        .pagination a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📜 Prediction History</h2>

    <div class="search-bar">
        <input type="text" id="search" class="form-control" placeholder="🔍 Search by glucose, blood pressure, age..." onkeyup="filterResults()">
        <input type="date" id="from_date" class="form-control" onchange="filterResults()">
        <input type="date" id="to_date" class="form-control" onchange="filterResults()">
        <button class="btn-clear" onclick="clearFilters()">❌ Clear</button>
    </div>

    <div class="card">
        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table id="historyTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">Pregnancies</th>
                        <th onclick="sortTable(1)">Glucose</th>
                        <th onclick="sortTable(2)">Blood Pressure</th>
                        <th onclick="sortTable(3)">BMI</th>
                        <th onclick="sortTable(4)">Age</th>
                        <th onclick="sortTable(5)">Prediction</th>
                        <th onclick="sortTable(6)">Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['pregnancies'] ?></td>
                        <td><?= $row['glucose'] ?></td>
                        <td><?= $row['blood_pressure'] ?></td>
                        <td><?= $row['bmi'] ?></td>
                        <td><?= $row['age'] ?></td>
                        <td><strong><?= $row['prediction'] ?></strong></td>
                        <td><?= date("d M Y, h:i A", strtotime($row['created_at'])) ?></td>
                        <td><button class="btn-delete" onclick="deletePrediction(<?= $row['id'] ?>)">🗑 Delete</button></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No prediction history found.</p>
        <?php } ?>

        <a href="predict.php" class="btn-back">🔙 Back to Prediction</a>
    </div>
</div>

<script>
function deletePrediction(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        fetch("delete_prediction.php?id=" + id)
        .then(response => response.text())
        .then(data => {
            if (data === "success") {
                alert("Record deleted successfully!");
                location.reload();
            } else {
                alert("Error deleting record.");
            }
        });
    }
}

function filterResults() {
    let search = document.getElementById('search').value;
    let fromDate = document.getElementById('from_date').value;
    let toDate = document.getElementById('to_date').value;
    window.location.href = `history.php?search=${search}&from_date=${fromDate}&to_date=${toDate}`;
}

function clearFilters() {
    window.location.href = "history.php";
}

function sortTable(n) {
    let table = document.getElementById("historyTable");
    let rows = Array.from(table.rows).slice(1);
    rows.sort((a, b) => a.cells[n].innerText.localeCompare(b.cells[n].innerText));
    table.append(...rows);
}
</script>

</body>
</html>
