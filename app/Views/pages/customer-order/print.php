<?php $this->extend("layouts/main") ?>

<?php $this->section("content") ?>

<div class="w-dvw h-dvh flex justify-center items-center">
    <div class="border p-4 min-w-xs rounded-xl text-gray-700">
        <h1 class="font-bold text-lg text-center">KEDAI KOPI</h1>
        <h2 class="font-bold text-3xl text-center text-gray-600">TITIK SETARA</h2>
        <hr class="my-2 text-slate-400" />

        <div class="mt-3">
            <h2 class="font-bold">Produk</h2>

            <ul>
                <?php foreach ($order->order_items as $orderItem): ?>
                    <li>
                        x<?= $orderItem->qty . " " . $orderItem->name ?>
                        (Rp. <?= number_format($orderItem->subtotal, 0, ",", ".") ?>)
                    </li>
                <?php endforeach ?>
            </ul>
        </div>

        <div class="mt-4">
            <h2 class="font-bold">Pembayaran</h2>

            <ul>
                <li class="flex justify-between">
                    <span>Metode Pembayaran:</span>
                    <span><?= strtoupper($order->payment_method) ?></span>
                </li>
                <li class="flex justify-between">
                    <span>Total:</span>
                    <span>Rp. <?= number_format($order->total_price, 0, ",", ".") ?></span>
                </li>
            </ul>
        </div>

        <div class="mt-6 text-end">
            <p class="font-bold">Tanggal Pemesanan:</p>
            <p><?= date("d-m-Y H:i", strtotime($order->order_date)) ?> WIB</p>
        </div>

        <div class="mt-6 mb-4 text-center italic text-sm text-gray-400">
            <p>===============</p>
            <p>Terimakasih...</p>
            <p>😊 Sampai Bertemu Kembali 😊</p>
            <p>===============</p>
        </div>
    </div>
</div>

<?php $this->endSection("content") ?>

<?php $this->section("script") ?>

<script>
    addEventListener("DOMContentLoaded", () => print())
</script>

<?php $this->endSection("script") ?>