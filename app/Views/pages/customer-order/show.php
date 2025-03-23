<?php

use App\Enum\OrderStatus;

$this->extend("layouts/dashboard");

?>

<?php $this->section("content") ?>

<!-- header -->
<?= $this->include("pages/components/dashboard-header") ?>

<!-- actions -->
<section class="flex justify-end p-2">
    <a href="/customer/order?status=<?= $order->status ?>" class="bg-amber-400 hover:bg-amber-300 text-white px-3 py-2 rounded-lg transition-colors">
        <i class="bi bi-arrow-left"></i>
    </a>
</section>

<!-- content -->
<section class="p-4">
    <div class="shadow p-4 rounded-lg max-w-sm mx-auto border-t-4 border-t-pink-700">
        <div class="mb-3">
            <p class="font-bold">Pemesan</p>
            <p><?= $order->name ?></p>
        </div>

        <?php foreach ($order->order_items as $item): ?>
            <div class="mt-3 flex gap-3">
                <img src="/<?= $item->picture ?>" alt="<?= $item->name ?>" class="w-24 aspect-square rounded-lg">

                <div class="flex-1">
                    <p class="font-bold"><?= $item->name ?></p>
                    <p class="text-sm text-gray-600">x<?= $item->qty ?></p>
                    <p class="mt-4 text-end"><?= $item->subtotal ?></p>
                </div>
            </div>
        <?php endforeach ?>

        <hr class="my-3 text-gray-400" />

        <div class=" mt-3">
            <p class="font-bold">Status</p>
            <p class="py-1 px-2 rounded text-sm <?= $statusColor($order->status) ?>"><?= $order->status ?></p>
        </div>
        <div class=" mt-3">
            <p class="font-bold">Tanggal Pemesanan</p>
            <p><?= date("Y-m-d", strtotime($order->order_date)) ?></p>
        </div>
        <div class="mt-3">
            <p class="font-bold">Metode Pembayaran</p>
            <p><?= strtoupper($order->payment_method) ?></p>
        </div>
        <div class="mt-3">
            <p class="font-bold">Status Pembayaran</p>
            <p><?= $order->payment_status ?></p>
        </div>
        <div class="mt-3 ">
            <p class="font-bold">Total Pembayaran</p>
            <p>Rp. <?= number_format($order->total_price, 0, ",", ".") ?></p>
        </div>

        <div class="flex items-end gap-1 justify-end">
            <?php if ($order->status === OrderStatus::COMPLETE): ?>
                <a href="/customer/order/6/print" class="px-3 py-2 block bg-blue-700 text-white rounded-lg" title="Cetak Struk" target="_blank">
                    <i class="bi bi-printer"></i>
                </a>
            <?php endif ?>

            <?php if ($order->status === OrderStatus::PROCESS): ?>
                <form action="/customer/order/<?= $order->id ?>/completed" method="POST">
                    <button type="submit" class="py-1 px-2 block bg-green-700 text-white text-2xl rounded-lg" title="Proses Pesanan">
                        <i class="bi bi-check"></i>
                    </button>
                </form>
            <?php endif ?>

            <?php if ($order->status === OrderStatus::PENDING): ?>
                <form action="/customer/order/<?= $order->id ?>/process" method="POST">
                    <button type="submit" class="btn block mt-3 ms-auto" title="Proses Pesanan">
                        <i class="bi bi-arrow-repeat"></i>
                    </button>
                </form>
            <?php endif ?>

            <?php if ($order->status === OrderStatus::CANCEL): ?>
                <button type="button" data-action="confirm" data-target="" data-text="Hapus data pesanan?" class="bg-red-500 hover:bg-red-400 text-white px-3 py-2 rounded-lg transition-colors">
                    <i class="bi bi-trash"></i>
                </button>
            <?php endif ?>
        </div>
    </div>
</section>

<?php $this->endSection() ?>