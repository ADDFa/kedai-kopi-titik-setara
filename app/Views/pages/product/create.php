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
        <form action="/product" method="POST" enctype="multipart/form-data">
            <div class="flex flex-col relative">
                <label for="name" class="text-sm mb-3">Nama Produk</label>
                <input autocomplete="off" type="text" name="name" placeholder="Americano" id="name" class="border <?= session("errors.name") ? "border-red-400" : "border-gray-400" ?> rounded p-2 outline-none placeholder:text-xs" value="<?= old("name") ?>" />
                <?php if (session("errors.name")): ?>
                    <i class="bi bi-exclamation-triangle text-red-500 absolute bottom-7 right-3"></i>
                <?php endif ?>
                <p class="invalid-feedback"><?= session("errors.name") ?></p>
            </div>
            <div class="flex flex-col mt-3 relative">
                <label for="category" class="text-sm mb-3">Kategori Produk</label>
                <select name="category_id" id="category" class="border <?= session("errors.category") ? "border-red-400" : "border-gray-400" ?> rounded appearance-none p-2 outline-none hover:cursor-pointer">
                    <?php foreach ($categories as $category): ?>
                        <option <?= old("category") ? "selected" : "" ?> value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php endforeach ?>
                </select>
                <i class="bi bi-caret-down-fill text-gray-600 absolute bottom-2 end-3"></i>
            </div>
            <div class="flex flex-col mt-3 relative">
                <label for="picture" class="text-sm mb-3">Foto Produk</label>
                <input autocomplete="off" type="file" name="picture" placeholder="Jhon Doe" id="picture" class="border <?= session("errors.picture") ? "border-red-400" : "border-gray-400" ?> rounded p-2 outline-none placeholder:text-xs hover:cursor-pointer" />
                <?php if (session("errors.name")): ?>
                    <i class="bi bi-exclamation-triangle text-red-500 absolute bottom-7 right-3"></i>
                <?php endif ?>
                <p class="invalid-feedback"><?= session("errors.picture") ?></p>
            </div>
            <div class="flex flex-col mt-3 relative">
                <label for="price" class="text-sm mb-3">Harga Produk</label>
                <input autocomplete="off" type="text" inputmode="numeric" pattern="[0-9]*" name="price" placeholder="Jhon Doe" id="price" class="border <?= session("errors.price") ? "border-red-400" : "border-gray-400" ?> rounded p-2 outline-none placeholder:text-xs" value="<?= old("price") ?>" />
                <?php if (session("errors.name")): ?>
                    <i class="bi bi-exclamation-triangle text-red-500 absolute bottom-7 right-3"></i>
                <?php endif ?>
                <p class="invalid-feedback"><?= session("errors.price") ?></p>
            </div>
            <div class="pt-10 pb-4 text-end">
                <button type="submit" class="btn">Simpan</button>
            </div>
        </form>
    </div>
</section>

<?= $this->endSection() ?>