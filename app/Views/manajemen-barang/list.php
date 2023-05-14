
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
        <a href="<?= base_url('product/create/')?>" class="btn btn-dark mb-3">+ Tambah</a>
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
                        <th class="py-1 text-center">Gambar</th>
                        <th class="py-1 text-center">Nama</th>
                        <th class="py-1 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($list) > 0): ?>
                        <?php $i = 1; ?>
                        <?php foreach($list as $row): ?>
                            <tr>
                                <th class="p-1 align-middle text-center"><?= $i++ ?></th>
                                <td class="p-1 align-middle text-center"><img src="/img/product/seragam-putih-pdk.png" class="rounded mx-auto d-block" height="150" width="150"></td>
                                <td class="align-middle text-center"><?= $row->nama_barang; ?></td>
                                <td class="align-middle text-center">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal<?= $row->id_barang; ?>" class="btn btn-success bg-gradient-light border text-dark rounded-0" title="Lihat Product">
                                        <i class="fa fa-eye"></i>
                                        </button>

                                        <!-- Modal Detail-->
                                        <div class="modal fade" id="modal<?= $row->id_barang; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="d-flex flex-column">
                                                    <div class="p-2">
                                                        <div class="d-flex flex-row">
                                                            <div class="p-1 mt-3"><img src="/img/product/seragam-putih-pdk.png" alt="" height="220" width="220"></div>
                                                            <div class="p-1 card" style="width: 18rem;">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item bg-dark" style="color:white;"><?=$row->nama_barang; ?> </li>
                                                                <li class="list-group-item text-start">Jenis Barang : <?=$row->id_jenis; ?> </li>
                                                                <li class="list-group-item text-start">Ukuran Barang : <?=$row->ukuran_barang; ?> </li>
                                                                <li class="list-group-item text-start">Kuantitas Barang : <?=$row->kuantitas; ?> </li>
                                                                <li class="list-group-item text-start">Harga Barang : Rp.<?=$row->harga_per_satuan; ?> </li>
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

                                        <a href="<?= base_url('product/edit/'.$row->id_barang)?>" class="btn btn-primary rounded-0" title="Edit Contact"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('product/delete/'.$row->id_barang)?>" onclick="if(confirm('Apakah Kamu Ingin Menghapus Produk Ini?') === false) event.preventDefault()" class="btn btn-danger rounded-0" title="Delete Contact"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
 
        </div>
        </div>
        </div>

        
    <?= $this->endSection(); ?>