<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
    <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">List of Transactions</div>
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
                    <th class="p-1 text-center">#</th>
                    <th class="p-1 text-center">Date/Time</th>
                    <th class="p-1 text-center">Code</th>
                    <th class="p-1 text-center">Customer</th>
                    <th class="p-1 text-center">Items</th>
                    <th class="p-1 text-center">Total Amount</th>
                    <th class="p-1 text-center">Action</th>
                </thead>
                <tbody>
                   
                        <tr>
                            <th class="p-1 text-center align-middle">id</th>
                            <td class="px-2 py-1 align-middle">Tanggal</td>
                            <td class="px-2 py-1 align-middle">code</td>
                            <td class="px-2 py-1 align-middle">Nama Costumer</td>
                            <td class="px-2 py-1 align-middle text-end">Jumlah Item</td>
                            <td class="px-2 py-1 align-middle text-end">Total Belanja</td>
                            <td class="px-2 py-1 align-middle text-center">
                                <a href="<?= base_url('Main/transaction_view/') ?>" class="mx-2 text-decoration-none text-dark"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('Main/transaction_delete/')?>" class="mx-2 text-decoration-none text-danger" onclick="if(confirm('Are you sure to delete'))"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    
                        <tr>
                            <td class="p-1 text-center" colspan="7">No result found</td>
                        </tr>
                    
                </tbody>
            </table>
            <div>
                
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>