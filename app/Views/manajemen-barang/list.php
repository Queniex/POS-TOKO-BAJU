
<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content'); ?>
    <div class="mt-4">
    <hr/>
    <div class="d-flex flex-row mb-2">
        <h3 class="fw-semibold">LIST DAFTAR BARANG</h3>
    </div>
    <hr/>

    <div class="card-body">
    <div class="container-fluid">
        <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-<?= session()->getFlashdata('warna'); ?>" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
    <div class="d-flex mb-3">
        <div class="me-auto "><a href="<?= base_url('product/create/')?>" class="btn btn-dark mb-3">+ Tambah</a></div>
    </div>
        <table class="table table-dark table-striped">
            <colgroup>
                <col width="7%">
                <col width="31%">
                <col width="36%">
                <col width="26%">
            </colgroup>
            <thead>
                <tr class="bg-gradient bg-primary text-light">
                    <th class="py-1 text-center">No</th>
                    <th class="py-1 text-center">Foto Produk</th>
                    <th class="py-1 text-center">Nama</th>
                    <th class="py-1 text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                    <?php if(count($list) > 0): ?>
                        <?php $i = 1; ?>
                        <?php foreach($list as $row): ?>
                        <tr>
                            <th class="p-1 align-middle text-center"><?= $i++ ?></th>
                            <td class="p-1 align-middle text-center"><img src="/img/product/<?= $row["foto_barang"]; ?>" class="rounded mx-auto d-block" height="150" width="150"></td>
                            <td class="align-middle text-center"><?= $row["nama_barang"]; ?></td>
                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal<?= $row["id_barang"]; ?>" class="btn btn-success bg-gradient-light border text-dark rounded-0" title="Lihat Product">
                                    <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- Modal Detail-->
                                    <div class="modal fade" id="modal<?= $row["id_barang"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="d-flex flex-column">
                                                <div class="p-2">
                                                    <div class="d-flex flex-row">
                                                        <div class="p-1 mt-3"><img src="/img/product/<?= $row["foto_barang"]; ?>" alt="" height="220" width="220"></div>
                                                        <div class="p-1 card" style="width: 18rem;">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item bg-dark" style="color:white;"><?=$row["nama_barang"]; ?> </li>
                                                            <li class="list-group-item text-start">Jenis Barang : <?=$row["jenis_barang"]; ?> </li>
                                                            <li class="list-group-item text-start">Ukuran Barang : <?=$row["ukuran_barang"]; ?> </li>
                                                            <li class="list-group-item text-start">Kuantitas Barang : <?=$row["kuantitas"]; ?> </li>
                                                            <li class="list-group-item text-start">Harga Barang : Rp.<?=$row["harga_per_satuan"]; ?> </li>
                                                            <li class="list-group-item text-start bg-dark"></li>
                                                            <li class="list-group-item text-start bg-dark"></li>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <a href="<?= base_url('product/edit/'.$row["id_barang"])?>" class="btn btn-primary rounded-0" title="Edit Contact"><i class="fa fa-edit"></i></a>
                                    <a href="#myModal<?= $row["id_barang"]; ?>" class="btn btn-danger rounded-0" class="trigger-btn" data-toggle="modal"><i class="fa fa-trash"></i></a>

                                        <!-- Modal HTML -->
                                        <div id="myModal<?= $row["id_barang"]; ?>" class="modal fade">
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
                                                        <p>Data Barang Yang Terhapus Tidak Bisa Dikembalikan!</p>
                                                    </div>
                                                    <hr>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary text-black" data-dismiss="modal">BATAL</button>
                                                        <a href="<?= base_url('product/delete/'.$row["id_barang"])?>" class="btn btn-danger text-black">HAPUS</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            <?= $pager->links("products", "pagination"); ?>
        </div>

    </div>
    </div>
    </div>

    
<?= $this->endSection(); ?>