Tabel Anak
<div class="card mb-4">
    <div class="card-header" style="font-size: 18px;">
        <i class="fas fa-table me-1" style="margin-top: 8px;"></i>
        Data Anak
    </div>
    <div class="card-body">
        <table id="datatablesAnak" class="table table-hover">
            <thead>
                <tr>
                    <th>NIK Anak</th>
                    <th>Nama Anak</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Berat Badan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data anak di sini -->
                <?php
                include("koneksi.php");
                $sqlAnak = "SELECT * FROM tbl_orangtua";
                $resultAnak = $koneksi->query($sqlAnak);

                if ($resultAnak->num_rows > 0) {
                    while ($rowAnak = $resultAnak->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th>" . $rowAnak["nik_ibu"] . "</th>";
                        echo "<th>" . $rowAnak["id_ibu"] . "</th>";
                        echo "<th>" . $rowAnak["nama_ibu"] . "</th>";
                        echo "<th>" . $rowAnak["nama_ayah"] . "</th>";
                        echo "<th>" . $rowAnak["email"] . "</th>";
                        echo "</tr>";
                    }
                } else {
                    echo "Tidak ada data anak.";
                }

                // // Hapus semua data dari tbl_anak
                // $sqlDeleteAnak = "DELETE FROM tbl_orangtua  WHERE `tbl_orangtua`.`nik_ibu` = 085231702701";
                if ($koneksi->query($sqlDeleteAnak) === TRUE) {
                    echo "Semua data anak berhasil dihapus.";
                } else {
                    echo "Error: " . $sqlDeleteAnak . "<br>" . $koneksi->error;
                }

                $koneksi->close();
                ?>
                <!-- Tambahkan data anak lainnya di sini dengan format yang sama -->
            </tbody>
        </table>
    </div>
</div>
