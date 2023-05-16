<?= $this->extend('dashboard/templates/main'); ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">Transaction Details of Kode</div>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('Main/transactions') ?>" class="btn btn btn-light bg-gradient border rounded-0"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
           <div class="lh-1">
                <dl class="d-flex w-100">
                    <dt class="col-auto">Transaction Code:</dt>
                    <dd class="col-auto flex-shrink-1 flex-grow-1 px-2">Kode</dd>
                </dl>
                <dl class="d-flex w-100">
                    <dt class="col-auto">Transaction Date/Time:</dt>
                    <dd class="col-auto flex-shrink-1 flex-grow-1 px-2">Tanggal</dd>
                </dl>
                <dl class="d-flex w-100">
                    <dt class="col-auto">Customer:</dt>
                    <dd class="col-auto flex-shrink-1 flex-grow-1 px-2">Nama Kostumer</dd>
                </dl>
           </div>
           <h5 class="fw-bolder">Purchased Products</h5>
           <hr>
           <table class="table table-stripped table-bordered">
                <colgroup>
                <col width="10%">
                <col width="50%">
                <col width="20%">
                <col width="20%">
            </colgroup>
                <thead>
                    <tr class="bg-gradient bg-primary text-light">
                        <th class="p1-text-center">Qty</th>
                        <th class="p1-text-center">Product</th>
                        <th class="p1-text-center">Unit Price</th>
                        <th class="p1-text-center">Total</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td class="px-2 py-1 align-middle text-center">Jumlah QTY</td>
                        <td class="px-2 py-1 align-middle">Nama Produk</td>
                        <td class="px-2 py-1 align-middle text-end">Harga</td>
                        <td class="px-2 py-1 align-middle text-end">Jumlah Harga</td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr class="bg-greadient bg-warning text-dark">
                        <th class="p-1 text-end" colspan="3">Total Amount</th>
                        <th class="p-1 text-end">Jumlah bayar</th>
                    </tr>
                    <tr class="bg-greadient bg-warning text-dark">
                        <th class="p-1 text-end" colspan="3">Tendered Amount</th>
                        <th class="p-1 text-end">Uang Bayar</th>
                    </tr>
                    <tr class="bg-greadient bg-warning text-dark">
                        <th class="p-1 text-end" colspan="3">Change</th>
                        <th class="p-1 text-end">Kembalian</th>
                    </tr>
                </tfoot>
           </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>