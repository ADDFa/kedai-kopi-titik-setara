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
    <table class="w-full border-separate border-spacing-y-4">
        <thead>
            <tr class="rounded-lg shadow h-9">
                <th scope="col">No</th>
                <th scope="col" class="text-start">Produk</th>
                <th scope="col">Kuantitas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($carts as $cart): ?>
                <tr class="shadow-lg rounded-xl text-center">
                    <th scope="row">1</th>
                    <td>
                        <div class="flex gap-2 items-center my-4">
                            <img src="<?= $cart->picture ?>" alt="Product" class="max-w-26 aspect-square rounded-xl" />

                            <div class="text-start">
                                <p><?= $cart->name ?></p>
                                <p class="text-(--primary)">
                                    <?= number_format($cart->price, 0, ",", ".") ?>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center mx-auto border rounded border-gray-300 w-fit gap-2">
                            <button data-id="<?= $cart->id ?>" data-name="reduce-product" class="border rounded border-gray-300 px-2 transition-colors hover:bg-gray-300">
                                <i class="bi bi-dash"></i>
                            </button>
                            <p data-name="product-total-value-<?= $cart->id ?>" class="px-1"><?= $cart->qty ?></p>
                            <button data-id="<?= $cart->id ?>" data-name="add-product" class="border rounded border-gray-300 px-2 transition-colors hover:bg-gray-300">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </td>
                    <td>
                        <button data-target="/cart/<?= $cart->id ?>" data-name="delete-product-in-cart" type="button" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="mt-4">
        <button class="btn w-full">Order</button>
    </div>
</section>

<?= $this->endSection() ?>