<?= $this->extend("layouts/dashboard") ?>

<?= $this->section("content") ?>

<header class="py-4 px-2">
    <h1 class="text-lg">Manajemen Produk</h1>
</header>
<hr class="text-gray-300" />

<!-- filters -->
<section class="p-4 flex items-center justify-between">
    <div class="lg:w-1/3 h-10 flex rounded-lg overflow-hidden border border-gray-300 ps-4">
        <input type="text" class="flex-1 focus:outline-0" placeholder="Cari barang" />
        <button class="bg-gray-300">
            <i class="bi bi-search px-4 self-center text-sm"></i>
        </button>
    </div>

    <div>
        <a href="/product/new" class="btn">Tambah Produk</a>
    </div>
</section>

<?= $this->endSection() ?>