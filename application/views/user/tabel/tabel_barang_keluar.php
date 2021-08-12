<div class="container" style="margin: 2em auto;">
  <h2 class="tex-center">Tabel Barang Keluar</h2>
  <br>
  <div class="panel panel-default">
    <div class="panel-body">
      <form id="form-filter" class="form-horizontal">
        <div class="form-group">
          <label for="tanggal_keluar" class="col-sm-2 control-label">Tanggal Keluar</label>
          <div class="col-sm-4">
            <input type="date" class="form-control" id="tanggal_keluar">
          </div>
        </div>
        <div class="form-group">
          <label for="supplier" class="col-sm-2 control-label">Supplier</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="supplier">
          </div>
        </div>
        <div class="form-group">
          <label for="supplier" class="col-sm-2 control-label"></label>
          <div class="col-sm-4">
            <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
            <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <br>
  <table class="table table-bordered table-striped" style="margin: 2em auto;" id="tabel_barang_keluar">
    <thead>
      <tr>
        <th>No</th>
        <th>ID_Transaksi</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Keluar</th>
        <th>Supplier</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Satuan</th>
        <th>Jumlah</th>
      </tr>
    </thead>
  </table>
</div>
</div>

<script type="text/javascript">
  var table;

  $(document).ready(function() {

    //datatables
    table = $('#tabel_barang_keluar').DataTable({

      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
        "url": "<?php echo site_url('admin/get_ajax_keluar') ?>",
        "type": "POST",
        "data": function(data) {
          data.tanggal_keluar = $('#tanggal_keluar').val();
          data.nama_supplier = $('#supplier').val();
        }
      },

      //Set column definition initialisation properties.
      "columnDefs": [{
        "targets": [0], //first column / numbering column
        "orderable": false, //set not orderable
      }, ],

    });

    $('#btn-filter').click(function() { //button filter event click
      table.ajax.reload(); //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
      $('#form-filter')[0].reset();
      table.ajax.reload(); //just reload table
    });
  });
</script>