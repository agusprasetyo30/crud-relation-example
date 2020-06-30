<?php
   include "function.php";
   $id = $_GET['id'];

   if (deleteMatkul($id) > 0) {
      echo "
         <script>
               alert('Mata kuliah berhasil dihapus');
               document.location.href = './matkul-add.php';
         </script>
      ";
   } else {
      echo "
         <script>
            //  alert('Hapus data gagal');
               document.location.href = 'todo-delete.php';
         </script>
      ";
      echo("<br>");
      echo mysqli_error($koneksi);
   }
?>