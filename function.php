<?php
  include "koneksi/koneksi.php";

  /**
   * Fungsi yang digunakan untuk QUERY SELECT, biar nggk ngetik ulang gitu loo
   *
   * @param [type] $query
   * @return void
   */
  function query($query)
  {
      global $koneksi;

      $result = mysqli_query($koneksi, $query);
      $rows = [];
      while ($data = mysqli_fetch_assoc($result)) {
          $rows[] = $data;
      }
      return $rows;
  }

  /**
   * Fungsi yang digunakan untuk menambahkan data mahasiswa
   *
   * @param [type] $data
   * @return void
   */
  function addMahasiswa($data)
  {
    global $koneksi;

    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);

    $query = "INSERT INTO mahasiswa VALUES (NULL, '$nama', '$email', '$alamat') ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
  }

    /**
   * Fungsi ini digunakan untuk mengupdate data mahasiswa
   * dalam fungsi ini ada 2 parameter yaitu $data dan $id
   *
   * @param [type] $data : digunakan untuk menampung data inputan
   * @param [type] $id : menampung ID dari mata kuliah yang akan diedit
   * @return void
   */
  function editMahasiswa($data, $id)
  {
    global $koneksi;

    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $email = htmlspecialchars($data['email']);

    $query = "UPDATE mahasiswa SET 
            nama = '$nama',
            email = '$email',
            alamat = '$alamat'
            WHERE id = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
  }

  /**
   * fungsi yang digunakan untuk menghapus data mahasiswa
   *
   * @param [type] $id
   * @return void
   */
  function deleteMahasiswa($id)
  {
      global $koneksi;

      $query = "DELETE FROM mahasiswa WHERE id = '$id'";

      mysqli_query($koneksi, $query);

      return mysqli_affected_rows($koneksi);
  }

  /**
   * Fungsi yang digunakan untuk menambahkan data mata kuliah
   *
   * @param [type] $data
   * @return void
   */
  function addMataKuliah($data)
  {
    global $koneksi;

    $nama = htmlspecialchars($data['nama']);

    $query = "INSERT INTO mata_kuliah VALUES (NULL, '$nama') ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
  }

  /**
   * Fungsi ini digunakan untuk mengupdate data mata kuliah
   * dalam fungsi ini ada 2 parameter yaitu $data dan $id
   *
   * @param [type] $data : digunakan untuk menampung data inputan
   * @param [type] $id : menampung ID dari mata kuliah yang akan diedit
   * @return void
   */
  function editMataKuliah($data, $id)
  {
    global $koneksi;

    $nama = htmlspecialchars($data['nama']);

    $query = "UPDATE mata_kuliah SET 
            nama = '$nama'
            WHERE id = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
  }

  /**
   * fungsi yang digunakan untuk menghapus mata kuliah
   *
   * @param [type] $id
   * @return void
   */
  function deleteMatkul($id)
  {
      global $koneksi;

      $query = "DELETE FROM mata_kuliah WHERE id = '$id'";

      mysqli_query($koneksi, $query);

      return mysqli_affected_rows($koneksi);
  }


  /**
   * Menambahkan relasi mahasiswa yang mengambil mata kuliah
   *
   * @param [type] $data
   * @param [type] $id
   * @return void
   */
  function tambahMatkulMahasiswa($data, $id)
  {
    global $koneksi;

    $matkul = htmlspecialchars($data['matkul']);

    $query = "INSERT INTO mahasiswa_mata_kuliah VALUES (NULL, '$id', '$matkul') ";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
  }

  /**
   * Menghapus relasi mahasiswa yang mengambil mata kuliah
   *
   * @param [type] $id
   * @return void
   */
  function deleteMatkulMahasiswa($id)
  {
      global $koneksi;

      $query = "DELETE FROM mahasiswa_mata_kuliah WHERE id = '$id'";

      mysqli_query($koneksi, $query);

      return mysqli_affected_rows($koneksi);
  }
?>