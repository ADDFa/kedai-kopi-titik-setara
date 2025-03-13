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
            <p class="text-(--primary) text-end">
                <?= $order->status ?>
            </p>

            <?php foreach ($order->items as $item): ?>
                <div class="flex gap-2">
                    <div>
                        <img src="<?= $item->picture ?>" alt="<?= $item->name ?>" class="max-w-40 aspect-square">
                        <p class="mt-2"><?= $order->order_date ?></p>
                    </div>

                    <div class="flex-1">
                        <p><?= $item->name ?></p>

                        <div class="flex justify-between text-gray-500 text-xs">
                            <p><?= $item->category ?></p>
                            <p>x<?= $item->qty ?></p>
                        </div>

                        <p class="mt-20 text-end text-sm">Rp. <?= $item->price ?></p>
                        <p class="mt-2 text-end">Total <?= $item->qty ?> produk: <span class="font-bold">Rp. <?= $item->subtotal ?></span></p>
                    </div>
                </div>
                <hr class="my-4 text-gray-400" />
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</section>

<?= $this->endSection() ?>