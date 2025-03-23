<?= $this->extend("layouts/dashboard") ?>

<?= $this->section("content") ?>

<!-- header -->
<?= $this->include("pages/components/dashboard-header") ?>

<!-- filters -->
<section class="p-4 flex items-center justify-between">
    <form action="/product" class="lg:w-1/3 h-10 flex rounded-lg overflow-hidden border border-gray-300 ps-4">
        <input type="text" class="flex-1 focus:outline-0" placeholder="Cari barang" name="keyword" value="<?= $keyword ?>" />
        <button class="bg-gray-300">
            <i class="bi bi-search px-4 self-center text-sm"></i>
        </button>
    </form>

    <div class="relative">
        <button class="btn" data-toggle="dropdown" data-target="add-dropdown">
            <i class="bi bi-plus-lg"></i>
        </button>

        <ul id="add-dropdown" class="dropdown absolute top-[calc(100%+4px)] right-0 min-w-xs py-3 rounded bg-white/95 shadow-xl">
            <li class="mb-1">
                <a href="/product-category/new" class="block py-2 px-3 hover:bg-gray-200">Tambah Kategori Produk</a>
            </li>
            <li>
                <a href="/product/new" class="block py-2 px-3 hover:bg-gray-200">Tambah Produk</a>
            </li>
        </ul>
    </div>
</section>

<!-- content -->
<section class="p-4">
    <table id="product-table" class="w-full border-separate border-spacing-y-4">
        <thead>
            <tr class="rounded-lg shadow h-9">
                <th scope="col">No</th>
                <th scope="col">Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($products as $i => $product): ?>
                <tr class="text-center shadow-lg rounded-xl" role="button" data-id="<?= $product->id ?>">
                    <th class="py-4" scope="col"><?= $i + 1 ?></th>
                    <td class="py-4">
                        <img class="w-16 aspect-square rounded-full mx-auto" src="<?= $product->picture ?>" alt="Produk" />
                        <p><?= $product->name ?></p>
                    </td>
                    <td class="py-4"><?= $product->category_name ?></td>
                    <td class="py-4"><?= $product->price ?></td>
                    <td class="py-4">
                        <div class="flex gap-1 items-center justify-center">
                            <a href="/product/<?= $product->id ?>/edit" class="bg-amber-400 hover:bg-amber-300 text-white px-3 py-2 rounded-lg transition-colors">
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