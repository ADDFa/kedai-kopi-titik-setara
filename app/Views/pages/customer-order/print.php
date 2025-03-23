<?php $this->extend("layouts/main") ?>

<?php $this->section("content") ?>

<div class="w-dvw h-dvh flex justify-center items-center">
    <div class="border p-4 min-w-xs rounded-xl text-gray-700">
        <h1 class="font-bold text-2xl text-center">Kedai Kopi</h1>
        <hr class="my-2" />

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

            <ul class="mt-2">
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

        <div class="mt-6">
            <button id="print" class="ms-auto px-3 py-2 block bg-blue-700 text-white rounded-lg">
                <i class="bi bi-printer"></i>
            </button>
        </div>
    </div>
</div>

<?php $this->endSection("content") ?>

<?php $this->section("script") ?>

<script>
    document.getElementById("print")?.addEventListener("click", () => {
        print()
    })
</script>

<?php $this->endSection("script") ?>