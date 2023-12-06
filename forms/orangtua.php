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
                    <th>Tinggi Badan</th>
                    <th>Alamat</th>
                    <th>NIK Ibu</th>
                </tr>
            </thead>
            <tbody>
                <!-- Tampilkan data anak di sini -->
                <?php
                include("koneksi.php");
                $sqlAnak = "SELECT * FROM tbl_anak";
                $resultAnak = $koneksi->query($sqlAnak);

                if ($resultAnak->num_rows > 0) {
                    while ($rowAnak = $resultAnak->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th>" . $rowAnak["id_anak"] . "</th>";
                        echo "<th>" . $rowAnak["nama_anak"] . "</th>";
                        echo "<th>" . $rowAnak["jenis_kelamin"] . "</th>";
                        echo "<th>" . $rowAnak["tanggal_lahir_anak"] . "</th>";
                        echo "<th>" . $rowAnak["bb_lahir"] . "</th>";
                        echo "<th>" . $rowAnak["tb_lahir"] . "</th>";
                        echo "<th>" . $rowAnak["alamat"] . "</th>";
                        echo "<th>" . $rowAnak["nik_ibu"] . "</th>";
                        echo "</tr>";
                    }
                } else {
                    echo "Tidak ada data anak.";
                }

                // // Hapus semua data dari tbl_anak
                $sqlDeleteAnak = "DELETE FROM tbl_anak WHERE `tbl_anak`.`nik_ibu` = 2856868";
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
