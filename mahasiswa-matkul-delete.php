<?php
   include "function.php";
   // Menampung id relasi untuk menghapus relasi
   $id = $_GET['id'];

   // menampung id mahasiswa untuk direct/kembali ke halaman edit mahasiswa ketika berhasil hapus
   $id_mhs = $_GET['mhs'];

   // jika hapus relasi berhasil
   if (deleteMatkulMahasiswa($id) > 0) {
      echo "
         <script>
            document.location.href = './mahasiswa-edit.php?id=$id_mhs';
         </script>
      ";
   } else {
      echo "
         <script>
               alert('Hapus data gagal');
               // document.location.href = 'todo-delete.php';
         </script>
      ";
      echo("<br>");
      echo mysqli_error($koneksi);
   }
?>