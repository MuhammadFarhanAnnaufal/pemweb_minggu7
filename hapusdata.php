<?php
include("koneksi.php");

if (isset($_GET['del'])) {
    $delete_kode = $_GET['del'];
    $delete_query = "DELETE FROM data_mahasiswa WHERE nim = '$delete_kode'";

    if (mysqli_query($conn, $delete_query)) {
        echo '<script>alert("Data berhasil dihapus.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit();
    } else {
        echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
    }
}
?>
