<?php

use App\Enum\ProductType;

?>

<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>

<?= $this->include("pages/components/home-header") ?>

<section class="container p-2 w-[calc(100%-0.5rem)] lg:w-[calc(100%-120px)] mx-auto mt-4 shadow">
    <h2 class="text-2xl font-bold leading-9 mb-4">PALING DISUKAI</h2>
    <hr class="text-gray-300" />

    <div class="grid gap-3 mt-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
        <?php foreach ($bestSellers as $bestSeller): ?>
            <div class="p-3 border border-gray-200 transition-colors hover:border-(--primary)">
                <img src="<?= $bestSeller->picture ?>" alt="best seller" class="aspect-square" />
                <p class="mt-4 text-center text-(--primary)"><?= $bestSeller->name ?></p>
            </div>
        <?php endforeach ?>
    </div>
</section>

<section class="container p-2 w-[calc(100%-0.5rem)] lg:w-[calc(100%-120px)] mx-auto shadow mt-8 mb-10">
    <h2 class="text-2xl font-bold leading-9 mb-4 text-center">REKOMENDASI</h2>
    <hr class="text-gray-300" />

    <div class="flex flex-col gap-3 mt-3 xl:flex-row">
        <div class="flex-1">
            <h3 class="text-xl font-bold text-center xl:text-start">Makanan</h3>
            <hr class="text-gray-300" />

            <div class="grid gap-1.5 mt-4 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($products as $product): ?>
                    <?php if ($product->type === ProductType::FOODS): ?>
                        <div class="p-3 border border-gray-200 transition-colors hover:border-(--primary)"
                            data-product="<?= json_encode($product) ?>">
                            <img src="<?= $product->picture ?>" alt="<?= $product->name ?>" class="aspect-square" />
                            <p class="mt-2"><?= $product->name ?></p>

                            <div class="mt-6 flex justify-between items-center">
                                <p class="text-(--primary) font-bold">Rp. <?= number_format($product->price, 0, ",", ".") ?></p>
                                <p class="px-2 bg-gray-200 rounded-full"><?= $product->sold ?> Terjual</p>
                            </div>

                            <div class="text-end mt-3">
                                <button data-action="add-to-cart" data-user-id="<?= session("user.id") ?? "" ?>" data-product-id="<?= $product->id ?>" type="button" class="rounded bg-(--primary) text-white px-2 py-1">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>

        <div class="flex-1">
            <h3 class="text-xl font-bold text-center xl:text-start">Minuman</h3>
            <hr class="text-gray-300" />

            <div class="grid gap-1.5 mt-4 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($products as $product): ?>
                    <?php if ($product->type === ProductType::DRINKS): ?>
                        <div class="p-3 border border-gray-200 transition-colors hover:border-(--primary)"
                            data-product="<?= json_encode($product) ?>">
                            <img src="<?= $product->picture ?>" alt="<?= $product->name ?>" class="aspect-square" />
                            <p class="mt-2"><?= $product->name ?></p>

                            <div class="mt-6 flex justify-between items-center">
                                <p class="text-(--primary) font-bold">Rp. <?= number_format($product->price, 0, ",", ".") ?></p>
                                <p class="px-2 bg-gray-200 rounded-full"><?= $product->sold ?> Terjual</p>
                            </div>

                            <div class="text-end mt-3">
                                <button data-action="add-to-cart" data-user-id="<?= session("user.id") ?? "" ?>" data-product-id="<?= $product->id ?>" type="button" class="rounded bg-(--primary) text-white px-2 py-1">
                                    <i class="bi bi-cart-plus"></i>
                                </button>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>

<footer class="h-20">
    <p class="text-center text-gray-600">&copy; 2025</p>
</footer>

<?= $this->endSection() ?>