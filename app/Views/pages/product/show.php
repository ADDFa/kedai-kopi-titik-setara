<?= $this->extend("layouts/dashboard") ?>

<?= $this->section("content") ?>

<!-- header -->
<?= $this->include("pages/components/dashboard-header") ?>

<!-- actions -->
<section class="flex justify-end p-2">
    <a href="javascript:history.back()" class="bg-amber-400 hover:bg-amber-300 text-white px-3 py-2 rounded-lg transition-colors">
        <i class="bi bi-arrow-left"></i>
    </a>
</section>

<!-- content -->
<section class="flex min-h-10 mt-3 justify-stretch p-16">
    <div class="p-10 w-1/2">
        <img src="<?= base_url($product->picture) ?>" alt="Gambar Produk" class="w-5/6 mx-auto rounded-xl">
    </div>
    <div class="flex-1 shadow-lg p-16">
        <h2 class="text-3xl font-bold"><?= $product->name ?></h2>
        <p class="italic text-gray-600 text-sm mt-1"><?= $product->category_name ?></p>

        <h6 class="text-lg mt-4 font-semibold"><?= "Rp. " . number_format($product->price) ?></h6>
        <p class="italic text-gray-600 text-sm">Tersedia: <?= $product->qty ?></p>
    </div>
</section>

<?= $this->endSection() ?>