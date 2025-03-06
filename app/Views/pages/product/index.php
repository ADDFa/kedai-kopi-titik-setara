<?= $this->extend("layouts/dashboard") ?>

<?= $this->section("content") ?>

<header class="py-4 px-2">
    <h1 class="text-lg">Manajemen Produk</h1>
</header>
<hr class="text-gray-300" />

<!-- filters -->
<section class="p-4 flex items-center justify-between">
    <div class="lg:w-1/3 h-10 flex rounded-lg overflow-hidden border border-gray-300 ps-4">
        <input type="text" class="flex-1 focus:outline-0" placeholder="Cari barang" name="keyword" />
        <button class="bg-gray-300">
            <i class="bi bi-search px-4 self-center text-sm"></i>
        </button>
    </div>

    <div>
        <a href="/product/new" class="btn" title="Tambah Produk">
            <span class="hidden lg:inline">Tambah Produk</span>
            <i class="bi bi-folder-plus lg:hidden"></i>
        </a>
    </div>
</section>

<section class="p-4">
    <table class="w-full border-separate border-spacing-y-4">
        <thead>
            <tr class="rounded-lg shadow h-9">
                <th scope="col">No</th>
                <th scope="col">Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($products as $i => $product): ?>
                <tr class="text-center shadow-lg rounded-xl">
                    <th class="py-4" scope="col"><?= $i + 1 ?></th>
                    <td class="py-4">
                        <img class="w-16 aspect-square rounded-full mx-auto" src="<?= $product->picture ?>" alt="Produk" />
                        <p><?= $product->name ?></p>
                    </td>
                    <td class="py-4"><?= $product->category_name ?></td>
                    <td class="py-4"><?= $product->price ?></td>
                    <td class="py-4"><?= $product->qty ?></td>
                    <td class="py-4">
                        <div class="flex gap-1 items-center justify-center">
                            <a href="" class="bg-amber-400 hover:bg-amber-300 text-white px-3 py-2 rounded-lg transition-colors">
                                <i class="bi bi-pen"></i>
                            </a>

                            <button type="button" data-action="confirm" data-target="/product/<?= $product->id ?>" class="bg-red-500 hover:bg-red-400 text-white px-3 py-2 rounded-lg transition-colors">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>

<?= $this->endSection() ?>