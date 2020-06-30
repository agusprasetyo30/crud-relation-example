<?php
   $title = "Edit mahasiswa";
   include "layouts/header.php";
   include "function.php";

   $id = $_GET['id'];
   
   // query data mahasiswa berdasarkan ID mahasiswa
   $mahasiswa = query("SELECT * FROM mahasiswa WHERE id = '$id'")[0];
   
   // query data untuk menampilkan mata kuliah
   $matkul_data = query("SELECT * FROM mata_kuliah");

   $matkul_list = query("SELECT mmk.id as id_relasi, mk.nama as nama_matkul FROM mata_kuliah mk 
                        inner JOIN mahasiswa_mata_kuliah mmk ON mk.id = mmk.matkul_id 
                        inner JOIN mahasiswa m ON m.id = mmk.mahasiswa_id
                        WHERE mmk.mahasiswa_id = '$id' ");
   
?>

<div class="row p-3 m-3">   
   <div class="col-md-12 mb-3">
      <h2 class="card-title ">
            <?= $title ?>
      </h2> 
   </div>   
   <div class="col-md-6 bg-white">
      <form action="" method="post" class="shadow-lg p-3 bg-white">
         <label for="nama">Nama</label>
         <input type="text" 
            name="nama" 
            id="nama"
            class="form-control"
            placeholder="Input nama . . ." 
            autofocus="on" required
            value="<?= $mahasiswa['nama'] ?>"> <br>
      
         <label for="email">E-mail</label>
         <input type="email" 
            name="email" id="email"
            class="form-control"
            placeholder="Input email . . . " required
            value="<?= $mahasiswa['email'] ?>"> <br>

         <label for="alamat">Alamat</label>
         <textarea name="alamat" id="alamat" rows="3" class="form-control mb-3" placeholder="Input alamat . . ."><?= $mahasiswa['alamat'] ?></textarea>

         <input type="submit" name="submit"
            value="Update" 
            class="btn btn-warning btn-block"/>

            <a
               class="btn btn-info btn-block text-white"
               onclick="document.location.href = './'">
               Kembali
            </a>
      </form>
   </div>

   <div class="col-md-6 bg-white">
      <h3>
         Mata Kuliah dipilih
      </h3>

      <form action="" method="post" class="p-3 bg-white">

         <label>Tambah Mata Kuliah dipilih</label>
         <select name="matkul" id="matkul" class="form-control">
            <?php
               foreach ($matkul_data as $matkul) {
            ?>

               <option value="<?= $matkul['id'] ?>"><?= $matkul['nama'] ?></option>

            <?php } ?>
         </select>
         
         <input type="submit" name="tambah_matkul" value="Tambah" class="btn btn-success mt-1">
      </form>
      <table class="table table-bordered table-striped table-hover">
         <thead align="center">
            <tr>
               <td width=5>NO</td>
               <td style="width: 350px">Nama</td>
               <td>Action</td>
            </tr>
         </thead>
         <tbody align="center">
            <?php
               if ($matkul_list == null) {
                  echo "
                  <tr>
                     <td colspan=3>
                        Mata kuliah belum dipilih
                     </td>
                  </tr>";
               } else {

                  $i = 1;
                  foreach ($matkul_list as $data) {
            ?>
               <tr>
                  <td><?= $i++ ?>.</td>
                  <td><?= $data['nama_matkul'] ?></td>
                  <td>
                     <a href="mahasiswa-matkul-delete.php?id=<?= $data['id_relasi'] ?>&mhs=<?= $id ?>" 
                        onclick="return confirm('Apakah anda ingin menghapus user ini ?')"
                        class="btn btn-danger btn-sm">Delete</a>
                  </td>
               </tr>

            <?php 
                  }
               } 
            ?>
         
         </tbody>
      </table>
   </div>
</div>

<?php
   include "layouts/footer.php";

   // jka tombol edit ditekan
   if (isset($_POST['submit'])) {
      if (editMahasiswa($_POST, $id) > 0) 
      {
         echo "
            <script>
               alert('mahasiswa berhasil diupdate!');
               document.location.href = './';
            </script>
         ";

      } else {
            echo "
            <script>
               alert('Tidak ada perubahan data');
               // document.location.href = './';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
      }
   }

   // jika tombol tambah mata kuliah ditambah
   if (isset($_POST['tambah_matkul'])) {
      if (tambahMatkulMahasiswa($_POST, $id) > 0) 
      {
         echo "
            <script>
               document.location.href = './mahasiswa-edit.php?id=$id';
            </script>
         ";

      } else {
            echo "
            <script>
               alert('Tidak ada perubahan data');
               // document.location.href = './';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
      }
   }
?>