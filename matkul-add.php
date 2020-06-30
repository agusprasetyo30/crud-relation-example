<?php
   // menampung parameter variabel pada URL
   $id = $_GET['id'];

   $title = $id == null ? "Tambah Mata Kuliah" : "Edit Mata Kuliah";
   include "layouts/header.php";
   include "function.php";

   // variabel untuk menampung data list mata kuliah
   $matkul_list = query("SELECT * FROM mata_kuliah");

   // variabel untuk menampung data yang akan diedit
   $matkul_edit = query("SELECT * FROM mata_kuliah WHERE id = '$id'")[0];
?>


<div class="row p-3 m-3">   
   <div class="col-md-12 mb-3">
      <h2 class="card-title ">
         <?= $title ?>         
      </h2> 
   </div>   
   <div class="col-md-6 bg-white">

      <?php
         if ($_GET['id'] == null) {         
      ?>

         <!-- TAMPILAN UNTUK TAMBAH MATA KULIAH -->
         <form action="" method="post" class="shadow-lg p-3 bg-white">
            <label for="nama">Nama Mata Kuliah</label>
            <input type="text" 
               name="nama" 
               id="nama"
               class="form-control"
               placeholder="Input nama mata kuliah . . ." 
               autofocus="on" required> <br>

            <input type="submit" name="submit"
               value="Simpan" 
               class="btn btn-success btn-block">
            <a
               class="btn btn-info btn-block text-white"
               onclick="document.location.href = './'">
               Kembali
            </a>
         </form>

      <?php
         } else {
      ?>

         <!-- TAMPILAN UNTUK EDIT MATA KULIAH -->
         <form action="" method="post" class="shadow-lg p-3 bg-white">
            <label for="nama">Nama Mata Kuliah</label>
            <input type="text" 
               name="nama" 
               id="nama"
               class="form-control"
               placeholder="Input nama mata kuliah . . ."
               autofocus="on" required
               value="<?= $matkul_edit['nama'] ?>"> <br>

            <input type="submit" name="update"
               value="Update" 
               class="btn btn-success btn-block">
            <a
               class="btn btn-danger btn-block text-white"
               onclick="document.location.href = './matkul-add.php'">
               Batal
            </a>
         </form>

      <?php
         }
      ?>
   </div>

   <div class="col-md-6">
      <table class="table table-bordered table-striped table-hover">
         <thead align="center">
            <tr>
               <td width=5>NO</td>
               <td style="width: 250px">Nama</td>
               <td>Action</td>
            </tr>
         </thead>
         <tbody align="center">
            <?php
               $i = 1;
               foreach ($matkul_list as $data) {
            ?>
            <tr>
               <td><?= $i++ ?>.</td>
               <td><?= $data['nama'] ?></td>
               <td>
                  <a href="matkul-add.php?id=<?= $data['id'] ?>" 
                     class="btn btn-warning btn-sm">Edit</a>
                  <a href="matkul-delete.php?id=<?= $data['id'] ?>" 
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

   // UNTUK TAMBAH
   // ini adalah keadaan ketika tombol SIMPAN ditekan
   // submit adalah nama dari tombolnya
   if (isset($_POST['submit'])) 
   {
      if (addMataKuliah($_POST) > 0) 
      {
         echo "
            <script>
               alert('Mata Kuliah berhasil ditambahkan');
               document.location.href = './matkul-add.php';
            </script>
            ";

      } else {
            echo "
            <script>
               alert('Data gagal ditambahkan');
               // document.location.href = 'matkul-add.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
      }
   }

   // UNTUK UPDATE
   // ini adalah keadaan ketika tombol UPDATE ditekan
   // update adalah nama dari tombolnya
   if (isset($_POST['update'])) 
   {
      if (editMataKuliah($_POST, $id) > 0) 
      {
         echo "
            <script>
               alert('Mata Kuliah berhasil diupdate');
               document.location.href = './matkul-add.php';
            </script>
            ";

      } else {
            echo "
            <script>
               alert('Data gagal ditambahkan');
               // document.location.href = 'matkul-add.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
      }      
         
   }
?>