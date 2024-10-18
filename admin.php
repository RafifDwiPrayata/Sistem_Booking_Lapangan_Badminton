<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghapus booking jika tombol delete ditekan
if (isset($_GET['delete'])) {
    $booking_id = intval($_GET['delete']);
    $sql_delete = "DELETE FROM bookings WHERE booking_id = $booking_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Booking berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Query untuk mendapatkan data booking
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            background-image: url('background/bg1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        h1 {
            text-align: center;
            color: #f0f0f0;
            margin-top: 40px;
            font-size: 2em;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f7f7f7;
            font-weight: 600;
            color: #333;
        }

        td {
            color: #555;
        }

        .edit-button,
        .delete-button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-button {
            background-color: #28a745;
            color: white;
            margin-right: 5px;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
        }

        .edit-button:hover {
            background-color: #218838;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <h1>Manage Bookings</h1>

    <table>
        <tr>
            <th>Nama</th>
            <th>Nomor Lapangan</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Mengubah format tanggal menjadi Tanggal Bulan Tahun
                $formatted_date = date("j F Y", strtotime($row["booking_date"]));

                echo "<tr>
                        <td>" . htmlspecialchars($row["name"]) . "</td>
                        <td>" . htmlspecialchars($row["court_number"]) . "</td>
                        <td>" . $formatted_date . "</td>
                        <td>" . htmlspecialchars($row["booking_time"]) . "</td>
                        <td>
                            <a href='admin_edit.php?id=" . $row["booking_id"] . "' class='edit-button'>Edit</a>
                            <a href='?delete=" . $row["booking_id"] . "' class='delete-button' onclick='return confirm(\"Apakah Anda yakin ingin menghapus booking ini?\");'>Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada booking saat ini.</td></tr>";
        }
        ?>
    </table>

    <?php $conn->close(); ?>
</body>

</html>
