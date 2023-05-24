<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content') ?>

<div class="card rounded-0 mt-3">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">DETAIL TRANSAKSI</div>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('pos/index') ?>" class="btn btn btn-dark bg-gradient border rounded-0"><i class="fa fa-angle-left"></i> Kembali Ke List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
           <div class="lh-1">
                <dl class="d-flex w-100">
                    <dt class="col-auto">Kode Transaksi:</dt>
                    <dd class="col-auto flex-shrink-1 flex-grow-1 px-2"><?= $items[0]->id_transaksi; ?></dd>
                </dl>
                <dl class="d-flex w-100">
                    <dt class="col-auto">Tanggal Transaksi:</dt>
                    <dd class="col-auto flex-shrink-1 flex-grow-1 px-2"><?= $items[0]->tgl_pembelian; ?></dd>
                </dl>
                <dl class="d-flex w-100">
                    <dt class="col-auto">Customer:</dt>
                    <dd class="col-auto flex-shrink-1 flex-grow-1 px-2"><?= $items[0]->nama_pembeli; ?></dd>
                </dl>
                <dl class="d-flex w-100">
                    <dt class="col-auto">Cashier:</dt>
                    <dd class="col-auto flex-shrink-1 flex-grow-1 px-2"><?= $items[0]->nama_karyawan; ?></dd>
                </dl>
           </div>
           <h5 class="fw-bolder">Produk Terjual</h5>
           <hr>
           <table class="table table-stripped table-bordered">
                <colgroup>
                    <col width="10%">
                    <col width="50%">
                    <col width="20%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient bg-dark text-light">
                        <th class="p1-text-center text-center">Qty</th>
                        <th class="p1-text-center">Produk</th>
                        <th class="p1-text-center">Biaya x Jumlah Beli</th>
                        <th class="p1-text-center">Total Seluruhnya </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($items as $row): ?>
                    <tr>
                        <td class="px-2 py-1 align-middle text-center"><?= $row->jumlah; ?></td>
                        <td class="px-2 py-1 align-middle"><?= $row->nama_barang; ?></td>
                        <td class="px-2 py-1 align-middle text-end"><?= $row->harga_per_satuan; ?> x <?= $row->jumlah; ?></td>
                        <td class="px-2 py-1 align-middle text-end">Rp.<?= $row->total_harga; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="bg-greadient bg-warning text-dark">
                        <th class="p-1 text-end" colspan="3">Total Harga</th>
                        <th class="p-1 text-end">Rp.<?= $items[0]->harga_total; ?></th>
                    </tr>
                    <tr class="bg-greadient bg-warning text-dark">
                        <th class="p-1 text-end" colspan="3">Total Bayar</th>
                        <th class="p-1 text-end">Rp.<?= $items[0]->harga_bayar; ?></th>
                    </tr>
                    <tr class="bg-greadient bg-warning text-dark">
                        <th class="p-1 text-end" colspan="3">Total Kembalian</th>
                        <th class="p-1 text-end">Rp.<?= $items[0]->total_kembalian; ?></th>
                    </tr>
                </tfoot>
           </table>
        </div>
        <div class="d-flex justify-content-center">
            <input class="btn btn-dark" value="Print Transaksi" onclick="window.open('<?php echo base_url('pos/printpdf/' . $row->id_transaksi) ?>')"></input>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
