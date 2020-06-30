<?php
   $title = "Tambah Mahasiswa";
   include "layouts/header.php";
   include "function.php";
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
            autofocus="on" required> <br>
      
         <label for="email">E-mail</label>
         <input type="email" 
            name="email" id="email"
            class="form-control"
            placeholder="Input email . . . " required> <br>

         <label for="alamat">Alamat</label>
         <textarea name="alamat" id="alamat" rows="3" class="form-control mb-3" placeholder="Input alamat . . ."></textarea>

         <input type="submit" name="submit"
            value="Simpan" 
            class="btn btn-success btn-block">
         <a
            class="btn btn-info btn-block text-white"
            onclick="document.location.href = './'">
            Kembali
         </a>
      </form>
   </div>
</div>

<?php
   include "layouts/footer.php";

   if (isset($_POST['submit'])) 
   {
      if (addMahasiswa($_POST) > 0) 
      {
         echo "
            <script>
               alert('Mahasiswa berhasil ditambahkan');
               document.location.href = './';
            </script>
            ";

      } else {
            echo "
            <script>
               alert('Data gagal ditambahkan');
               // document.location.href = 'mahasiswa-add.php';            
            </script>
            ";
            echo("<br>");
            echo mysqli_error($koneksi);        
      }      
         
   }
?>