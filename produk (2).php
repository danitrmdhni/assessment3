<?php 
header('Content-Type: application/json');

$koneksi = mysqli_connect("localhost", "root", "", "website");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM produk";
    $query = mysqli_query($koneksi, $sql);
    $array_data = array();
    while ($data = mysqli_fetch_assoc($query)) {
        $array_data[] = $data;
    }
    echo json_encode($array_data);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $stok = $_POST['stok'];
    $sql = "INSERT INTO produk (nama_produk, harga_produk, stok) VALUES('$nama_produk', '$harga_produk', '$stok')";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_produk = $_GET['id_produk'];
    $sql = "DELETE FROM produk WHERE id_produk='$id_produk'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => "berhasil"
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => "gagal"
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id_produk = $data['id_produk'];
    $nama_produk = $data['nama_produk'];
    $harga_produk = $data['harga_produk'];
    $stok = $data['stok'];

    $sql = "UPDATE produk SET nama_produk='$nama_produk', harga_produk='$harga_produk', stok='$stok' WHERE id_produk='$id_produk'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    parse_str(file_get_contents("php://input"), $data);
    $id_produk = $data['id_produk'];
    $nama_produk = $data['nama_produk'];
    $harga_produk = $data['harga_produk'];
    $stok = $data['stok'];

    $sql = "UPDATE produk SET ";
    $fields = array();

    if (!empty($nama_produk)) {
        $fields[] = "nama_produk='$nama_produk'";
    }

    if (!empty($harga_produk)) {
        $fields[] = "harga_produk='$harga_produk'";
    }

    if (!empty($stok)) {
        $fields[] = "stok='$stok'";
    }

    $sql .= implode(', ', $fields);
    $sql .= " WHERE id_produk='$id_produk'";
    $cek = mysqli_query($koneksi, $sql);

    if ($cek) {
        $data = [
            'status' => 'berhasil'
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => 'gagal'
        ];
        echo json_encode($data);
    }
}
?>
