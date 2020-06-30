<?php
   $title = "Data Mahasiswa";
   include "layouts/header.php";
   include "function.php";

   $userList = query("SELECT * FROM mahasiswa");

?>

<div class="row p-3 m-3">
   
   <h2 class="card-title mb-3">
      <?= $title ?>   
   </h2> 

   <div class="col-md-12 bg-white shadow-lg">
      <div class="row">
         <div class="col-md-12 text-right">
            <a href="mahasiswa-add.php" 
               class="btn btn-primary mt-3 mb-3">Tambah data Mahasiswa</a>
            <a href="matkul-add.php" 
               class="btn btn-primary mt-3 mb-3">Tambah data Mata Kuliah</a>
         </div>
      </div>
      <table class="table table-bordered table-striped table-hover">
         <thead align="center">
            <tr>
               <td width=5>NO</td>
               <td style="width: 200px">Nama</td>
               <td style="width: 200px">Email</td>
               <td style="width: 300px">Alamat</td>
               <td style="width: 300px">Mata Kuliah Diambil</td>
               <td>Action</td>
            </tr>
         </thead>
         <tbody align="center">
            <?php
               $i = 1;
               foreach ($userList as $data) {
            ?>
            <tr>
               <td><?= $i++ ?>.</td>
               <td><?= $data['nama'] ?></td>
               <td><?= $data['email'] ?></td>
               <td><?= $data['alamat'] ?></td>
               <td>
                  
                  <?php
                     // Query untuk menampilkan mata kuliah berdasarkan mahasiswa
                     $matkul_list = query("SELECT mk.nama as nama_matkul FROM mata_kuliah mk 
                        inner JOIN mahasiswa_mata_kuliah mmk ON mk.id = mmk.matkul_id 
                        inner JOIN mahasiswa m ON m.id = mmk.mahasiswa_id
                        WHERE mmk.mahasiswa_id = '$data[id]' ");
                  ?>
                  
                  <!-- Jika keadaan data kosong -->
                  <?php if ($matkul_list == null) { ?>
                     <div class="bg-danger text-white p-1">
                        Mahasiswa belum memilih mata kuliah
                     </div>
                  
                  <!-- Jika terdapat isi/datanya maka akan ditampilkan sesuai data yang ditambahkan -->
                  <?php } else { ?>

                     <ul>
                        <?php
                           // Menampilkan data mata kuliah yang dipilih mahasiswa
                           foreach ($matkul_list as $matkul) {
                              echo "<li>" . $matkul['nama_matkul'] . "</li>";
                           }
                        ?>
                     </ul>

                  <?php } ?>
               </td>

               <td>
                  <a href="mahasiswa-edit.php?id=<?= $data['id'] ?>" 
                     class="btn btn-warning btn-sm">Edit</a>

                  <a href="mahasiswa-delete.php?id=<?= $data['id'] ?>" 
                     onclick="return confirm('Apakah anda ingin menghapus user ini ?')"
                     class="btn btn-danger btn-sm">Delete</a>
               </td>
            </tr>

            <?php } ?>
         
         </tbody>
      </table>
   </div>
</div>

<?php
   include "layouts/footer.php";
?>