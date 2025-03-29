<?php $this->extend("layouts/dashboard") ?>

<?php $this->section("content") ?>

<!-- header -->
<?= $this->include("pages/components/dashboard-header") ?>

<!-- content -->
<section class="p-4">
    <div class="flex justify-end">
        <form class="w-sm">
            <label for="status" class="block">Status</label>
            <select name="status" id="status" class="w-full py-1 px-2 border border-gray-400 rounded-lg mt-2">
                <?php foreach ($order_status as $order_status): ?>
                    <option <?= $status === $order_status ? "selected" : "" ?> value="<?= $order_status ?>"><?= $order_status ?></option>
                <?php endforeach ?>
            </select>
        </form>
    </div>

    <table id="customer-order-table" class="w-full border-separate border-spacing-y-4 mt-4">
        <thead>
            <tr class="rounded-lg shadow h-9">
                <th scope="col">No</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Total Pembayaran</th>
                <th scope="col">Tanggal Pemesanan</th>
                <th scope="col">Status Pesanan</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr class="text-center shadow-lg rounded-xl" role="button" data-id="<?= $order->id ?>">
                    <th class="py-4" scope="col"><?= isset($no) ? ++$no : $no = 1 ?></th>
                    <td class="py-4">
                        <p><?= $order->name ?></p>
                    </td>
                    <td class="py-4">Rp. <?= number_format($order->total_price, 0, ",", ".") ?></td>
                    <td class="py-4"><?= date("d-m-Y H:i", strtotime($order->order_date)) ?> WIB</td>
                    <td class="py-4">
                        <span class="px-3 py-1 rounded <?= $statusColor($order->status) ?>"><?= $order->status ?></span>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>

<?php $this->endSection() ?>