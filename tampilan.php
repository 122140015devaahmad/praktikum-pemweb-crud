<?php 
    include "db.php";
    $rows_per_page = 10;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1; 
    }
    $start_from = ($page - 1) * $rows_per_page;
    $stmt = $conn->query("SELECT nim, username, gender FROM data_user LIMIT $start_from, $rows_per_page");
    $total_rows_result = $conn->query("SELECT COUNT(*) AS total FROM data_user");
    $total_rows = $total_rows_result->fetch_assoc()['total'];
    $total_pages = ceil($total_rows / $rows_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12 shadow-lg px-5 py-3 mt-3 d-flex flex-column mx-auto rounded-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="table-primary">NIM</th>
                            <th class="table-secondary">Username</th>
                            <th class="table-success">Kelamin</th>
                            <th class="table-danger">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if ($stmt->num_rows > 0) {
                                $no = 1;
                                while ($row = $stmt->fetch_assoc()) {
                                    echo "
                                        <tr>
                                            <td>{$row['nim']}</td>
                                            <td>{$row['username']}</td>
                                            <td>{$row['gender']}</td>
                                            <td><a href='edit_account.php?nim={$row['nim']}' class='btn btn-warning' >Edit</a> <button class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-username='{$row['username']}' data-nim='{$row['nim']}'>Hapus</button></td>
                                        </tr>
                                    ";
                                }
                            } else {
                                echo "
                                    <tr>
                                        <td colspan='3'>Data Tidak Ada</td>
                                    </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            <div>
            <?php 
                if ($page > 1) {
                    echo "<a href='tampilan.php?page=" . ($page - 1) . "' class='btn btn-primary rounded-circle'>←</a> ";
                }
                if ($page < $total_pages) {
                    echo "<a href='tampilan.php?page=" . ($page + 1) . "' class='btn btn-primary rounded-circle'>→</a>";
                }
            ?>
            <a href="index.php" class='btn btn-success'>KEMBALI</a>
        </div>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus akun dengan Username: <span id="deleteUsername"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <a id="deleteAccount" href="#" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        const confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; 
            const username = button.getAttribute('data-username'); 
            const nim = button.getAttribute('data-nim'); 
            const deleteUsername = document.getElementById('deleteUsername'); 
            const deleteAccount = document.getElementById('deleteAccount');

            deleteUsername.textContent = username; 
            deleteAccount.href = `delete_account.php?nim=${nim}`;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
