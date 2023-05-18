<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content') ?>
<div class="card rounded-0 mt-3">
    <div class="card-header">
    <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">List Transaksi</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-stripped table-bordered">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="25%">
                    <col width="10%">
                    <col width="20%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <th class="p-1 text-center bg-info">ID</th>
                    <th class="p-1 text-center">Tanggal/Waktu</th>
                    <th class="p-1 text-center">Nama Kasir</th>
                    <th class="p-1 text-center">Nama Kostumer</th>
                    <th class="p-1 text-center">Jumlah Barang</th>
                    <th class="p-1 text-center">Total Belanja</th>
                    <th class="p-1 text-center">Aksi</th>
                </thead>
                <tbody>
                <?php foreach($transactions as $row): ?>
                        <tr>
                            <th class="p-1 text-center align-middle bg-primary"><?= $row->id_transaksi; ?></th>
                            <td class="px-2 py-1 align-middle"><?= $row->tgl_pembelian; ?></td>
                            <td class="px-2 py-1 align-middle"><?= $row->nama_karyawan; ?></td>
                            <td class="px-2 py-1 align-middle"><?= $row->nama_pembeli; ?></td>
                            <td class="px-2 py-1 align-middle text-end"><?= $row->total_barang; ?></td>
                            <td class="px-2 py-1 align-middle text-end"><?= $row->harga_total; ?></td>
                            <td class="px-2 py-1 align-middle text-center">
                                <a href="<?= base_url('pos/view/'.$row->id_transaksi) ?>" class="mx-2 text-decoration-none text-dark"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('pos/delete/'.$row->id_transaksi)?>" class="mx-2 text-decoration-none text-danger" onclick="if(confirm('Apakah Kamu Ingin Menghapus Produk Ini?') === false) event.preventDefault()"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                <?php endforeach; ?>
                    <?php if(count($transactions) <= 0): ?>
                        <tr>
                            <td class="p-1 text-center" colspan="7">Tidak Ada Data Ditemukan</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
            <div>
                
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>