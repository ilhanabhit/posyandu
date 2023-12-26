<!DOCTYPE html>
<html lang="en" style="width: 100%;">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" type="image/png" href="siduta.png" />
    <title>Data Balita - SiDuta</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="coba123.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="crud.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="crud.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body style="height: 2700px; width: 10000px;">
    <div class="wrapper d-flex align-items-stretch">
        <!-- Sidebar -->
        <?php include 'navbar.php'; ?>
        <div id="content" class="p-4 p-md-5 pt-5">
            <main>
                <div class="container-fluid px-4" style="width: 1200px;">
                    <h1 class="mt-4">Data Balita</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Balita</li>
                    </ol>
                    <div class="card mb-4">

                    </div>
                    <div class="card mb-4">
                        <div class="card-header" style="font-size: 18px;">
                            <i class="fas fa-table me-1" style="margin-top: 8px;"></i>
                            Data Balita
                            <style>
                                .material-icons {
                                    font-size: 18px;
                                    vertical-align: middle;
                                }
                            </style>
                            <button type="button" class="btn btn-primary float-end" data-toggle="modal" data-target="#addEmployeeModal"><i class="material-icons">&#xE147;</i>
                                Tambah Data
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NIK Anak</th>
                                        <th>Nama Anak</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Berat Badan</th>
                                        <th>Tinggi Badan</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NIK Anak</th>
                                        <th>Nama Anak</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Berat Badan</th>
                                        <th>Tinggi Badan</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <!-- Tambahkan baris berikut ke dalam tabel tbody untuk menampilkan data -->
                                    <?php
                                    include("koneksi.php");

                                    $sql = "SELECT id_anak, nama_anak, jenis_kelamin, tanggal_lahir_anak, bb_lahir, tb_lahir, alamat, nik_ibu FROM tbl_anak";

                                    $result = $koneksi->query($sql);

                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            // Tampilkan data anak dan nama ibu di dalam tabel
                                            echo "<tr>";
                                            echo "<th>" . $row["id_anak"] . "</th>";
                                            echo "<th>" . $row["nama_anak"] . "</th>";
                                            echo "<th>" . $row["jenis_kelamin"] . "</th>";
                                            echo "<th>" . $row["tanggal_lahir_anak"] . "</th>";
                                            echo "<th>" . $row["bb_lahir"] . "</th>";
                                            echo "<th>" . $row["tb_lahir"] . "</th>";
                                            echo "<th>" . $row["alamat"] . "</th>";

                                            echo "<th>
              <a href='#editEmployeeModal-" . $row["id_anak"] . "' class='edit' data-toggle='modal'><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
              <a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='" . $row["id_anak"] . "'><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
            </th>";
                                            echo "</tr>";

                                            // Tambahkan modal edit untuk setiap baris data
                                            echo "<div id='editEmployeeModal-" . $row["id_anak"] . "' class='modal fade'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <form id='edit-anak-form-" . $row["id_anak"] . "' action='editAnak.php' method='POST' onsubmit='return validateFormEdit(" . $row["id_anak"] . ")'>
                                                        <div class='modal-header'>
                                                            <h4 class='modal-title'>Edit Data Balita</h4>
                                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <div class='form-group'>
                                                                <label for='nik-" . $row["id_anak"] . "'>NIK Balita</label>
                                                                <input type='number' class='form-control' id='nik-" . $row["id_anak"] . "' name='nik' value='" . $row["id_anak"] . "' readonly>
                                                                <small id='nikWarning-" . $row["id_anak"] . "' class='text-danger'></small>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for='nama-" . $row["id_anak"] . "'>Nama Balita</label>
                                                                <input type='text' class='form-control' id='nama-" . $row["id_anak"] . "' name='nama' value='" . $row["nama_anak"] . "' required>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for='jenis-kelamin-" . $row["id_anak"] . "'>Jenis Kelamin</label>
                                                                <select id='jenis-kelamin-" . $row["id_anak"] . "' name='jenis-kelamin' class='form-control' required>
                                                                    <option value='Laki-laki' " . ($row["jenis_kelamin"] == 'Laki-laki' ? 'selected' : '') . ">Laki-laki</option>
                                                                    <option value='Perempuan' " . ($row["jenis_kelamin"] == 'Perempuan' ? 'selected' : '') . ">Perempuan</option>
                                                                </select>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for='tanggal-lahir-" . $row["id_anak"] . "'>Tanggal Lahir</label>
                                                                <input type='date' class='form-control' id='tanggal-lahir-" . $row["id_anak"] . "' name='tanggal-lahir' value='" . $row["tanggal_lahir_anak"] . "' required>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for='bb-lahir-" . $row["id_anak"] . "'>Berat Badan</label>
                                                                <input type='number' class='form-control' id='bb-lahir-" . $row["id_anak"] . "' name='bb-lahir' value='" . $row["bb_lahir"] . "' required>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for='tb-lahir-" . $row["id_anak"] . "'>Tinggi Badan</label>
                                                                <input type='number' class='form-control' id='tb-lahir-" . $row["id_anak"] . "' name='tb-lahir' value='" . $row["tb_lahir"] . "' required>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for='alamat-" . $row["id_anak"] . "'>Alamat</label>
                                                                <input type='text' class='form-control' id='alamat-" . $row["id_anak"] . "' name='alamat' value='" . $row["alamat"] . "' required>
                                                            </div>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <input type='button' class='btn btn-default' data-dismiss='modal' value='Batal'>
                                                            <input type='submit' id='submitButton-" . $row["id_anak"] . "' class='btn btn-info' value='Simpan' name='update' style='background-color: green;'>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>";

                                            echo "<script>
                                            function validateFormEdit(id) {
                                                var bbInput = document.getElementById('bb-lahir-' + id);
                                                var tbInput = document.getElementById('tb-lahir-' + id);                                
                                        
                                                // Check Berat Badan
                                                var minBerat = 2.7;
                                                if (bbInput.value < minBerat) {
                                                    alert('Berat Badan minimal harus 2.7 kg.');
                                                    return false; // Prevent form submission
                                                }
                                        
                                                // Check Tinggi Badan
                                                var minTinggi = 50;
                                                if (tbInput.value < minTinggi) {
                                                    alert('Tinggi Badan minimal harus 50 cm.');
                                                    return false; // Prevent form submission
                                                }
                                        
                                                return true; // Allow form submission
                                            }
                                        </script>";
                                        }
                                        mysqli_free_result($result);
                                    } else {
                                        echo "Tidak ada data anak.";
                                    }

                                    // Tutup koneksi
                                    $koneksi->close();
                                    ?>
                                </tbody>
                            </table>
                            <!-- Tambah Modal HTML -->
                            <div id="addEmployeeModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="tambah-anak-form" method="post" action="tambahAnak.php" onsubmit="return validateForm()">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Data Balita</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nik">NIK Balita</label>
                                                    <input type="number" id="nik" name="nik" class="form-control" required style="border-color: black; border: 1px solid black;" oninput="validateNikLength(this)">
                                                    <small id="nikWarning" class="text-danger"></small>
                                                </div>
                                                <script>
                                                    function validateNikLength(input) {
                                                        var minLength = 16;
                                                        var warningMessage = document.getElementById("nikWarning");
                                                        var submitButton = document.getElementById("submitButton");

                                                        // if (input.value.length < minLength) {
                                                        //     warningMessage.textContent = "Kolom harus berisi 16 karakter.";
                                                        //     submitButton.disabled = true; // Disable the submit button
                                                        // } else {
                                                        //     warningMessage.textContent = "";
                                                        //     submitButton.disabled = false; // Enable the submit button
                                                        // }
                                                    }

                                                    function validateForm() {
                                                        var nikInput = document.getElementById("nik");
                                                        var bbInput = document.getElementById("bb-lahir");
                                                        var tbInput = document.getElementById("tb-lahir");

                                                        // Check NIK length
                                                        if (nikInput.value.length < 16) {
                                                            alert("NIK harus berisi 16 karakter.");
                                                            return false; // Prevent form submission
                                                        }

                                                        // Check Berat Badan
                                                        var minBerat = 2.7;
                                                        if (bbInput.value < minBerat) {
                                                            alert("Berat Badan minimal harus 2.7 kg.");
                                                            return false; // Prevent form submission
                                                        }

                                                        // Check Tinggi Badan
                                                        var minTinggi = 50;
                                                        if (tbInput.value < minTinggi) {
                                                            alert("Tinggi Badan minimal harus 50 cm.");
                                                            return false; // Prevent form submission
                                                        }

                                                        return true; // Allow form submission
                                                    }
                                                </script>
                                                <div class="form-group">
                                                    <label for="nama">Nama Balita</label>
                                                    <input type="text" id="nama" name="nama" class="form-control" required style="border-color: black; border :1px solid black;">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis-kelamin">Jenis Kelamin</label>
                                                    <select id="jenis-kelamin" name="jenis-kelamin" class="form-control" required style="border-color: black; border :1px solid black;">
                                                        <option value="laki-laki">Laki-laki</option>
                                                        <option value="perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal-lahir">Tanggal Lahir</label>
                                                    <input type="date" id="tanggal-lahir" name="tanggal-lahir" class="form-control" required style="border-color: black; border :1px solid black;">
                                                </div>
                                                <div class="form-group">
                                                    <label for="bb-lahir">Berat Badan</label>
                                                    <input type="number" id="bb-lahir" name="bb-lahir" class="form-control" required style="border-color: black; border :1px solid black;">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tb-lahir">Tinggi Badan</label>
                                                    <input type="number" id="tb-lahir" name="tb-lahir" class="form-control" required style="border-color: black; border :1px solid black;">
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text" id="alamat" name="alamat" class="form-control" required style="border-color: black; border :1px solid black;">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama-orangtua">Nama Orangtua</label>
                                                    <select id="nama-orangtua" name="nama-orangtua" class="form-control" required style="border-color: black; border :1px solid black;">
                                                        <option value="">Pilih Nama Orangtua</option>
                                                        <?php
                                                        include('koneksi.php');

                                                        $query = "SELECT nik_ibu, nama_ibu, nama_ayah FROM tbl_orangtua";
                                                        $result = $koneksi->query($query);

                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo '<option value="' . $row["nik_ibu"] . '">' . $row["nama_ibu"] . '-' . $row["nama_ayah"] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                <button type="submit" id="submitButton" class="btn btn-success">Tambah</button>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal HTML -->
                            <div id="deleteEmployeeModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="hapusAnak.php" method="POST">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data Balita</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small" style="color: black; font-size: 110%;">Apakah Anda yakin ingin menghapus data ini?</p>
                                                <p class="small" style="color: black; font-size: 115%;"><small> Ketika data terhapus Tindakan ini tidak bisa dibatalkan</small></p>
                                                <input type="hidden" name="idToDelete" id="idToDelete">
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal" style="background-color: blue; color: white;">
                                                <input type="submit" class="btn btn-danger" value="Hapus" name="Hapus" style="background-color: red;">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="tabel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="tabel2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="dashboard.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="sb-admin-2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Store the ID of the child to delete when the "Hapus" button is clicked
            $('.delete').click(function() {
                var idToDelete = $(this).data('id');
                $('#idToDelete').val(idToDelete); // Set the ID in the hidden input field
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>