<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <style type="text/css">
        table {
            border: 1px solid #e3e3e3;
            border-collapse: collapse;
            font-family: arial;
            color: #5E5B5C;
            margin: 0 auto;
            width: 100%;
        }

        thead th {
            text-align: left;
            padding: 10px;
        }

        tbody td {
            border-top: 1px solid #e3e3e3;
            padding: 10px;
        }

        tbody tr:nth-child(even) {
            background: #F6F5FA;
        }

        tbody tr:hover {
            background: #EAE9F5;
        }
    </style>
</head>

<body>
    <center>
        <h3>Data Barang Masuk</h3>
        <table>
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
                <?php $no = 1; ?>
                <?php foreach ($data as $d) : ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $d->id_barang_masuk; ?></td>
                        <td><?= $d->tanggal; ?></td>
                        <td><?= $d->nama_supplier; ?></td>
                        <td><?= $d->nama_barang; ?></td>
                        <td><?= $d->nama_kategori; ?></td>
                        <td><?= $d->nama_satuan; ?></td>
                        <td><?= $d->jumlah; ?></td>
                    </tr>
                    <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </center>
</body>

</html>