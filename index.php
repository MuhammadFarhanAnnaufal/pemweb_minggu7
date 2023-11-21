<?php
include ('koneksi.php');

function getMahasiswa($conn, $program_studi = null)
{
    $sql = "SELECT * FROM data_mahasiswa";
    if ($program_studi) {
        $sql .= " WHERE program_studi = '$program_studi'";
    }

    $result = mysqli_query($conn, $sql);

    $data_mahasiswa = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data_mahasiswa[] = $row;
    }

    return $data_mahasiswa;
}

function tambahMahasiswa($conn, $nama, $nim, $program_studi)
{
    $sql = "INSERT INTO data_mahasiswa (nama, nim, program_studi) VALUES ('$nama', '$nim', '$program_studi')";
    return mysqli_query($conn, $sql);
}

function hapusMahasiswa($conn, $id)
{
    $sql = "DELETE FROM data_mahasiswa WHERE id = $id";
    return mysqli_query($conn, $sql);
}

function editMahasiswa($conn, $id, $nama, $nim, $program_studi)
{
    $sql = "UPDATE data_mahasiswa SET nama = '$nama', nim = '$nim', program_studi = '$program_studi' WHERE id = $id";
    return mysqli_query($conn, $sql);
}

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
$program_studi = isset($_GET['program_studi']) ? $_GET['program_studi'] : '';

if ($aksi == 'tambah' && isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $program_studi = $_POST['program_studi'];

    tambahMahasiswa($conn, $nama, $nim, $program_studi);
    header("Location: index.php");
}

if ($aksi == 'edit' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $program_studi = $_POST['program_studi'];

    editMahasiswa($conn, $id, $nama, $nim, $program_studi);
    header("Location: index.php");
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    hapusMahasiswa($conn, $id);
    header("Location: index.php");
}

$data_mahasiswa = getMahasiswa($conn, $program_studi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum Pemweb Minggu 7</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Data Mahasiswa Institut Teknologi Sumatera</h1>

        <form action="index.php" method="get">
            <label for="program_studi">Sortir berdasarkan Program Studi:</label>
            <select name="program_studi" id="program_studi" onchange="this.form.submit()">
                <option value="">Semua Program Studi</option>
                <option value="Teknik Informatika" <?php echo ($program_studi == 'Teknik Informatika') ? 'selected' : ''; ?>> Teknik Informatika</option>
                <option value="Teknik Industri" <?php echo ($program_studi == 'Teknik Industri') ? 'selected' : ''; ?>>Teknik Industri</option>
                <option value="Rekayasa Kehutanan" <?php echo ($program_studi == 'Rekayasa Kehutanan') ? 'selected' : ''; ?>>Rekayasa Kehutanan</option>
                <option value="Teknik Sipil" <?php echo ($program_studi == 'Teknik Sipil') ? 'selected' : ''; ?>>Teknik Sipil</option>
            </select>
        </form>

        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th></th>
            </tr>
            <?php foreach ($data_mahasiswa as $mhs) : ?>
                <tr>
                <td><?php echo $mhs['nama']; ?></td>
                <td><?php echo $mhs['nim']; ?></td>
                <td><?php echo $mhs['program_studi']; ?></td>
                <td>
                    <form action="hapusdata.php" method="get">
                        <input type="hidden" name="del" value="<?php echo $mhs['nim']; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                    <form action="editdata.php" method="get">
                        <input type="hidden" name="edit" value="<?php echo $mhs['nim']; ?>">
                        <button type="submit">Edit</button>
                    </form>
                    </td>
                 </tr>
            <?php endforeach; ?>
        </table>
    </form>
    <form action="tambahdata.php" method="post">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required>
    <label for="nim">NIM:</label>
    <input type="text" name="nim" required>
    <label for="program_studi">Program Studi:</label>
    <input type="text" name="program_studi" required>
    <input type="submit" value="Tambahkan">
    </form>
    </div>
</body>

</html>
