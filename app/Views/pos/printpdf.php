<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style type="text/css">
      /* * {
        border: 1px solid red;
      } */

      .container {
        margin: 5em;
        font-family: Arial, Helvetica, sans-serif;
      }
      .container2 {
        margin-top: 2em;
      }
      .judul {
        font-size: 2em;
        font-weight: bold;
      }
      .sub-judul {
        font-weight: 600;
      }
      .flex-container {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
      }
      .tg {
        border-collapse: collapse;
        border-spacing: 0;
      }
      .tg td {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
        width: 30%;
      }
      .tg th {
        border-color: black;
        border-style: solid;
        border-width: 1px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        overflow: hidden;
        padding: 10px 5px;
        word-break: normal;
      }
      .tg .tg-39xt {
        border-color: #c8c4c4;
        text-align: center;
        vertical-align: top;
        width: 10%;
      }
      .tg .tg-vl9k {
        background-color: #000000;
        border-color: #c8c4c4;
        color: #ffffff;
        text-align: center;
        vertical-align: middle;
        width: 40%;
      }
      .tg .tg-95py {
        background-color: #000000;
        border-color: #c8c4c4;
        color: #ffffff;
        text-align: center;
        vertical-align: middle;
        width: 40%;
      }
      .tg .tg-99py {
        background-color: #000000;
        border-color: #c8c4c4;
        color: #ffffff;
        text-align: center;
        vertical-align: middle;
        width: 10%;
      }
      .tg .tg-vp6y {
        border-color: #c8c4c4;
        text-align: right;
        vertical-align: top;
      }
      .tg .tg-7l3v {
        background-color: #fffe65;
        border-color: #c8c4c4;
        text-align: right;
        vertical-align: top;
      }
    </style>
  </head>
  <body>
    <div class="container mt-5">
      <hr />
      <div class="judul">DETAIL TRANSAKSI</div>
      <hr />
      <div class="container2">
        <div class="flex-container">
          <div>
            <span class="sub-judul">Kode Transaksi : </span
            ><?= $items[0]->id_transaksi; ?>
          </div>
          <div>
            <span class="sub-judul">Tanggal Transaksi : </span
            ><?= $items[0]->tgl_pembelian; ?>
          </div>
          <div>
            <span class="sub-judul">Nama Costumer : </span
            ><?= $items[0]->nama_pembeli; ?>
          </div>
          <div>
            <span class="sub-judul">Nama Cashier : </span
            ><?= $items[0]->nama_karyawan; ?>
          </div>
        </div>
        <div class="">
          <table class="tg">
            <thead>
              <tr>
                <th class="tg-99py">QTY</th>
                <th class="tg-vl9k">PRODUK</th>
                <th class="tg-95py">BIAYA X JUMLAH</th>
                <th class="tg-95py">TOTAL SELURUHNYA</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($items as $row): ?>
              <tr>
                <td class="tg-39xt"><?= $row->jumlah; ?></td>
                <td class="tg-39xt"><?= $row->nama_barang; ?></td>
                <td class="tg-39xt">
                  <?= $row->harga_per_satuan; ?> x
                  <?= $row->jumlah; ?>
                </td>
                <td class="tg-vp6y">Rp.<?= $row->total_harga; ?></td>
              </tr>
              <?php endforeach; ?>
              <tr>
                <td class="tg-7l3v" colspan="3">TOTAL HARGA</td>
                <td class="tg-7l3v">Rp.<?= $items[0]->harga_total; ?></td>
              </tr>
              <tr>
                <td class="tg-7l3v" colspan="3">TOTAL BAYAR</td>
                <td class="tg-7l3v">Rp.<?= $items[0]->harga_bayar; ?></td>
              </tr>
              <tr>
                <td class="tg-7l3v" colspan="3">TOTAL KEMBALIAN</td>
                <td class="tg-7l3v">Rp.<?= $items[0]->total_kembalian; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
