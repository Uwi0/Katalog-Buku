<?php
include('../koneksi/koneksi.php');
if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
        $id_penerbit = $_GET['data'];
        //hapus kategori buku
        $sql_dh = "delete from `penerbit` where `id_penerbit` = '$id_penerbit'";
        mysqli_query($koneksi,$sql_dh);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-book-reader"></i> Penerbit</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Penerbit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Penerbit</h3>
                <div class="card-tools">
                  <a href="tambahpenerbit.php" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Penerbit</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="get" action="penerbit.php">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
                  <?php if(!empty($_GET['notif'])) {?>
                      <?php if($_GET['notif']=="tambahberhasil") {?>
                          <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                      <?php } else if($_GET['notif']=="editberhasil") {?>
                          <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                      <?php } else if($_GET['notif']=="hapusberhasil"){?>
                          <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
                      <?php }?>
                  <?php }?>
              </div>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="5%">No</th>
                      <th width="30%">Penerbit</th>
                      <th width="50%">Alamat</th>
                      <th width="15%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $batas = 2;
                  if(!isset($_GET['halaman'])){
                      $posisi = 0;
                      $halaman = 1;
                  }else{
                      $halaman = $_GET['halaman'];
                      $posisi = ($halaman-1) * $batas;
                  }
                  $sql_k = "SELECT `id_penerbit`,`penerbit`, `alamat` FROM `penerbit`";
                  if (isset($_GET["katakunci"])){
                      $katakunci_penerbit = $_GET["katakunci"];
                      $sql_k .= " where `penerbit` LIKE '%$katakunci_penerbit'";
                  }
                  $sql_k .= " ORDER BY `penerbit`";
                  $query_k = mysqli_query($koneksi, $sql_k);
                  $no = 1;
//                  echo $sql_k;
                  while($data_k = mysqli_fetch_row($query_k)) {
                  $id_penerbit = $data_k[0];
                  $penerbit = $data_k[1];
                  $alamat = $data_k[2];
                  ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $penerbit; ?></td>
                        <td><?php echo $alamat; ?></td>
                        <td align="center">
                            <a href="editpenerbit.php?data=<?php echo $id_penerbit; ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i>Edit</a>
                            <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $penerbit; ?>?'))window.location.href = 'penerbit.php?aksi=hapus&data=<?php echo $id_penerbit;?>&notif=hapusberhasil'" class="btn btn-xs btn-warning"><i class="fas fa-trash"></i>Hapus</a>
                        </td>
                    </tr>
                      <?php $no++; }?>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
</body>
</html>
