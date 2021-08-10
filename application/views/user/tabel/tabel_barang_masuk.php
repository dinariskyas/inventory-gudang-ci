<div class="container" style="margin: 2em auto;">
  <h2 class="tex-center">Tabel Barang Masuk</h2>
  <br>
  <table class="table table-bordered table-striped" style="margin: 2em auto;" id="tabel_barang_masuk">
    <thead>
      <tr>
        <th>No</th>
        <th>ID_Transaksi</th>
        <th>Tanggal</th>
        <th>Supplier</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Satuan</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php if (is_array($list_data)) { ?>
          <?php $no = 1; ?>
          <?php foreach ($list_data as $dd) : ?>
            <td><?= $no ?></td>
            <td><?= $dd['id_barang_masuk'] ?></td>
            <td><?= $dd['tanggal'] ?></td>
            <td><?= $dd['nama_supplier'] ?></td>
            <td><?= $dd['nama_barang'] ?></td>
            <td><?= $dd['nama_kategori'] ?></td>
            <td><?= $dd['nama_satuan'] ?></td>
            <td><?= $dd['jumlah'] ?></td>
      </tr>
      <?php $no++; ?>
    <?php endforeach; ?>
  <?php } else { ?>
    <td colspan="7" align="center"><strong>Data Kosong</strong></td>
  <?php } ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#tabel_barang_masuk').DataTable();
  });
</script>