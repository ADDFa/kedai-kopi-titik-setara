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
    <div class="flex flex-wrap gap-4">
        <div class="flex-1">
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
                            <th scope="row">
                                <?= isset($no) ? ++$no : ($no = 1) ?>
                            </th>
                            <td>
                                <div class="flex gap-2 items-center my-4">
                                    <img src="<?= $cart->picture ?>" alt="Product" class="max-w-26 aspect-square rounded-xl" />

                                    <div class="text-start self-start">
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
        </div>

        <div class="shadow w-sm self-start rounded-lg p-4">
            <h3 class="text-xl font-bold">Total Belanja</h3>
            <hr class="my-3 text-gray-400" />

            <table class="w-full">
                <tbody>
                    <tr>
                        <th class="text-start">Sub Total</th>
                        <td class="text-end" data-name="total">Rp. <?= $total ?></td>
                    </tr>
                    <tr>
                        <th class="text-start">Biaya Admin</th>
                        <td class="text-end">-</td>
                    </tr>
                </tbody>
            </table>

            <div class="flex justify-between my-8">
                <p class="font-bold">Total</p>
                <p data-name="total">Rp. <?= $total ?></p>
            </div>

            <form action="/order" method="POST">
                <div>
                    <label for="payment-method">Metode Pembayaran</label>
                    <select name="payment_method" id="payment-method" class="block w-full border border-gray-400 p-2 rounded mt-3">
                        <option value="qris">Qris</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>

                <button type="submit" class="btn w-full my-8 mb-4">Order</button>
            </form>
        </div>
    </div>
</section>

<?= $this->endSection() ?>