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
            <?php if(session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-<?= session()->getFlashdata('warna'); ?>" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-stripped table-bordered">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="22%">
                    <col width="10%">
                    <col width="13%">
                </colgroup>
                <thead>
                    <th class="p-1 text-center bg-info">ID</th>
                    <th class="p-1 text-center">Tanggal/Waktu</th>
                    <th class="p-1 text-center">Nama Kasir</th>
                    <th class="p-1 text-center">Nama Kostumer</th>
                    <th class="p-1 text-center">Jumlah Barang</th>
                    <th class="p-1 text-center">Aksi</th>
                </thead>
                <tbody>
                <?php foreach($transactions as $row): ?>
                        <tr>
                            <th class="p-1 text-center align-middle bg-primary"><?= $row["id_transaksi"]; ?></th>
                            <td class="px-2 py-1 align-middle text-center"><?= $row["tgl_pembelian"]; ?></td>
                            <td class="px-2 py-1 align-middle text-center"><?= $row["nama_karyawan"]; ?></td>
                            <td class="px-2 py-1 align-middle text-center"><?= $row["nama_pembeli"]; ?></td>
                            <td class="px-2 py-1 align-middle text-center">Rp.<?= $row["harga_total"]; ?></td>
                            <td class="px-2 py-1 align-middle text-center">
                                <a href="<?= base_url('pos/view/'.$row["id_transaksi"]) ?>" class="btn btn-success   bg-gradient-light border text-dark rounded-0" title="View Detail Data"><i class="fa fa-eye"></i></a>
                                <!-- <a href=" // base_url('pos/edit/'.$row["id_transaksi"]) " class="btn btn-primary rounded-0" title="Edit Data"><i class="fa fa-edit"></i></a> -->
                                <a href="#myModal<?= $row["id_transaksi"]; ?>" class="btn btn-danger rounded-0" class="trigger-btn" data-toggle="modal" title="Delete Data"><i class="fa fa-trash"></i></a>

                                <!-- Modal HTML -->
                                <div id="myModal<?= $row["id_transaksi"]; ?>" class="modal fade">
                                    <div class="modal-dialog modal-dialog-centered modal-confirm">
                                        <div class="modal-content">
                                            <div class="modal-header flex-column">
                                                <div class="icon-box">
                                                <i class='fa fa-remove' style='color:#ff0000'></i>
                                                </div>						
                                                <h4 class="modal-title w-100">Apakah Kamu Yakin?</h4>	
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Data Transaksi Yang Terhapus Tidak Bisa Dikembalikan!</p>
                                            </div>
                                            <hr>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary text-black" data-dismiss="modal">BATAL</button>
                                                <a href="<?= base_url('pos/delete/'.$row["id_transaksi"]) ?>" class="btn btn-danger text-black">HAPUS</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
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
            <div class="d-flex justify-content-end">
                <?= $pager->links("transaction", "pagination"); ?>
            </div>
        </div>
    </div>
</div>

    
<?= $this->endSection() ?>