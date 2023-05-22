
    <?= $this->extend('dashboard/templates/main'); ?>

    <?= $this->section('content'); ?>
        <div class="mt-4">
        <hr/>
        <div class="d-flex flex-row mb-2">
            <h3 class="fw-semibold">LIST DAFTAR KARYAWAN</h3>
        </div>
        <hr/>

        
        <div class="card-body">
        <div class="container-fluid">
        <div class="d-flex mb-3">
            <div class="me-auto p-2"><a href="<?= base_url('employee/create/')?>" class="btn btn-dark mb-3">+ Tambah</a></div>
            <div class="p-2">
                
                <!-- <div class="btn-group">
                <button type="button" style="color:black; background-color:grey;" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Tampilkan 
                </button> -->
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Baju</a></li>
                    <li><a class="dropdown-item" href="#">Celana</a></li>
                    <li><a class="dropdown-item" href="#">Aksesoris</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Semuanya</a></li>
                </ul>
                </div>
            </div>
        </div>
            <table class="table table-dark table-striped">
                <colgroup>
                    <col width="7%">
                    <col width="31%">
                    <col width="10%">
                    <col width="32%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient bg-primary text-light">
                        <th class="py-1 text-center">NO</th>
                        <th class="py-1 text-center">GAMBAR</th>
                        <th class="py-1 text-center">ID USER</th>
                        <th class="py-1 text-center">USERNAME</th>
                        <th class="py-1 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($list) > 0): ?>
                        <?php $i = 1; ?>
                        <?php foreach($list as $row): ?>
                            <tr>
                                <th class="py-2 align-middle text-center"><?= $i++ ?></th>
                                <td class="py-2 align-middle text-center"><img src="/img/employee/<?= $row["foto_karyawan"]; ?>" class="rounded-circle" height="130" width="130"></td>
                                <td class="align-middle text-center"><?= $row["id_karyawan"]; ?></td>
                                <td class="align-middle text-center"><?= $row["nama_karyawan"]; ?></td>
                                <td class="align-middle text-center">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#modal<?= $row["id_karyawan"]; ?>" class="btn btn-success bg-gradient-light border text-dark rounded-0" title="Lihat Product">
                                        <i class="fa fa-eye"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal<?= $row["id_karyawan"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                Modal title
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card mb-3" style="max-width: 540px">
                                                <div class="row g-0">
                                                    <div class="d-flex mb-3 mt-2">
                                                    <!-- Buat Foto -->
                                                    <div class="d-flex justify-content-center">
                                                        <div class="m-2" style="border:1px solid black;">
                                                            <img src="/img/employee/<?= $row["foto_karyawan"]; ?>" alt="" width="130" height="130" class="rounded-circle mt-5 mx-2"/>
                                                        </div>
                                                    </div>
                                                    <!-- Buat Detail -->
                                                    <div class="p-2 mt-2">
                                                        <ul class="list-group list-group-flush">
                                                        <li class="list-group-item list-group-item-action list-group-item-dark">
                                                            Nama : <?= $row["nama_karyawan"]; ?> (<?= $row["username"]; ?> | <?= $row["id_karyawan"]; ?>)
                                                        </li>
                                                        <li class="list-group-item p-2">
                                                            Role : <span style="color:white; padding:5px; border-radius: 25px;" class="bg-dark"><?= $row["role"]; ?> </span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            Jenis Kelamin : <?= $row["jenis_kelamin"]; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            Email : <?= $row["email"]; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            Alamat : <?= $row["alamat"]; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            No Telp : <?= $row["no_tlp"]; ?>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="bg-dark p-3"></div>
                                                            <div class="bg-dark p-3"></div>
                                                        </li>
                                                        </ul>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                                                Close
                                                </button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                        <a href="<?= base_url('employee/edit/'.$row["id_karyawan"])?>" class="btn btn-primary rounded-0" title="Edit Contact"><i class="fa fa-edit"></i></a>
                                        <a href="#myModal<?= $row["id_karyawan"]; ?>" class="btn btn-danger rounded-0" class="trigger-btn" data-toggle="modal"><i class="fa fa-trash"></i></a>

                                        <!-- Modal HTML -->
                                        <div id="myModal<?= $row["id_karyawan"]; ?>" class="modal fade">
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
                                                        <p>Data Karyawan Yang Terhapus Tidak Bisa Dikembalikan!</p>
                                                    </div>
                                                    <hr>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary text-black" data-dismiss="modal">BATAL</button>
                                                        <a href="<?= base_url('employee/delete/'.$row["id_karyawan"])?>" class="btn btn-danger text-black">HAPUS</a>
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
                <?= $pager->links("employees", "pagination"); ?>
            </div>
 
        </div>
        </div>
        </div>

        
    <?= $this->endSection(); ?>