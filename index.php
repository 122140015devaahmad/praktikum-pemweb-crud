<?php 
    include "db.php";
    $message = "";
    if (isset($_POST['submit'])) {
        $nama = $_POST['name'];
        $nim = $_POST['nim'];
        $gender = $_POST['gender'];
        try{
            $stmt = "INSERT INTO data_user (username, nim, gender) VALUES('$nama', '$nim', '$gender')";
            if ($conn->query($stmt)){
                $message = "Akun berhasil didaftarkan";
            } else{
                $message = "Akun gagal didaftarkan";
            }
        } catch (mysqli_sql_exception $e){
            $message = "NIM sudah digunakan";
        }
        $conn->close();
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 shadow-lg px-5 py-3 mt-3 d-flex flex-column mx-auto rounded-3">
                <h3>Tambah Akun</h3>
                <form action="index.php" method="post">
                    <label for="nim" class="form-label">Masukkan NIM</label><br>
                    <input type="name" name="nim" class="form-control"><br>
                    <label for="name" class="form-label">Masukkan Nama </label><br>
                    <input type="text" name="name" class="form-control"><br>
                    <label for="name" class="form-label">Masukkan Jenis Kelamin</label><br>
                    <label for="gender" class="form-label">Laki-Laki</label>
                    <input type="radio" name="gender" value="Laki-laki" class="form-check-input">
                    <label for="gender" class="form-label">Perempuan</label>
                    <input type="radio" name="gender" value="Perempuan" class="form-check-input"><br>
                    <input type="submit" name="submit" value="Kumpulkan" class="mt-3 btn btn-primary">
                    <?php
                        if(isset($message)){
                            echo "<p>$message</p>";
                        }
                    ?> 
                </form>
                <a href="tampilan.php" class="mt-3 btn btn-success">LIHAT TABEL ANGGOTA</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>