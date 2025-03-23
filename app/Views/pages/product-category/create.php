<?= $this->extend("layouts/dashboard") ?>

<?= $this->section("content") ?>

<!-- header -->
<?= $this->include("pages/components/dashboard-header") ?>

<!-- actions -->
<section class="flex justify-end p-2">
    <a href="/product" class="bg-amber-400 hover:bg-amber-300 text-white px-3 py-2 rounded-lg transition-colors">
        <i class="bi bi-arrow-left"></i>
    </a>
</section>

<!-- content -->
<section class="p-4 lg:p-16 lg:pt-0">
    <div class="shadow-lg p-6 rounded-lg">
        <form action="/product-category" method="POST">
            <div class="flex flex-col relative">
                <label for="name" class="text-sm mb-3">Kategori</label>
                <input autocomplete="off" type="text" name="name" placeholder="" id="name" class="border <?= session("errors.name") ? "border-red-400" : "border-gray-400" ?> rounded p-2 outline-none placeholder:text-xs" value="<?= old("name") ?>" />
                <?php if (session("errors.name")): ?>
                    <i class="bi bi-exclamation-triangle text-red-500 absolute bottom-7 right-3"></i>
                <?php endif ?>
                <p class="invalid-feedback"><?= session("errors.name") ?></p>
            </div>
            <div class="pt-10 pb-4 text-end">
                <button type="submit" class="btn">Simpan</button>
            </div>
        </form>
    </div>
</section>

<?= $this->endSection() ?>