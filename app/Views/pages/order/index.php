<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>

<?= $this->include("pages/components/home-header") ?>

<section id="cart" class="container max-w-7xl mx-auto p-2 lg:p-4">
    <!-- actions -->
    <div class="my-4 flex justify-between">
        <ul class="flex gap-3">
            <li>
                <a href="/cart" class="py-3 <?= $active === "cart" ?  "tabs-active" : "" ?>">Keranjang</a>
            </li>
            <li>
                <a href="/order" class="py-3 <?= $active === "order" ?  "tabs-active" : "" ?>">Pesanan</a>
            </li>
        </ul>

        <a href="/" class="bg-amber-400 hover:bg-amber-300 text-white px-3 py-2 rounded-lg transition-colors">
            <i class="bi bi-arrow-left"></i>
        </a>
    </div>

    <!-- content -->
    <?php foreach ($orders as $order): ?>
        <div class="shadow rounded-lg p-4 mb-4">
            <p class="<?php
                        switch ($order->status) {
                            case "completed":
                                echo "text-(--primary)";
                                break;

                            case "pending":
                                echo "text-amber-500";
                                break;

                            case "canceled":
                                echo "text-red-600";
                                break;

                            case "processed":
                                echo "text-green-600";
                                break;
                        }
                        ?>
                text-end
            ">
                <?= $order->status ?>
            </p>

            <?php foreach ($order->items as $item): ?>
                <div class="flex gap-2">
                    <div>
                        <img src="<?= $item->picture ?>" alt="<?= $item->name ?>" class="w-28 sm:w-38 aspect-square rounded">
                        <p class="mt-2"><?= $order->order_date ?></p>
                    </div>

                    <div class="flex-1">
                        <p><?= $item->name ?></p>

                        <div class="flex justify-between text-gray-500 text-xs">
                            <p><?= $item->category ?></p>
                            <p>x<?= $item->qty ?></p>
                        </div>

                        <p class="mt-20 text-end text-sm">Rp. <?= $item->price ?></p>
                        <p class="mt-2 text-end">Total <?= $item->qty ?> produk: <br class="md:hidden" /> <span class="font-bold">Rp. <?= $item->subtotal ?></span></p>
                    </div>
                </div>
                <hr class="my-4 text-gray-400" />
            <?php endforeach ?>

            <div class="flex justify-end gap-1">
                <?php if ($order->status === "pending"): ?>
                    <form action="/order/<?= $order->id ?>/cancel" method="POST">
                        <button class="px-3 py-2 rounded-lg border transition-colors border-red-600 hover:bg-red-600 hover:text-white">
                            Batalkan Pesanan
                        </button>
                    </form>
                <?php endif ?>
            </div>
        </div>
    <?php endforeach ?>
</section>

<?= $this->endSection() ?>