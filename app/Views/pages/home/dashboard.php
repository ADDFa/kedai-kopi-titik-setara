<?= $this->extend("layouts/dashboard") ?>

<?= $this->section("content") ?>
<section class="p-4 flex flex-wrap box-border min-h-32 gap-2">
    <?php foreach ($cards as $card): ?>
        <div class="rounded-2xl p-4 w-full lg:w-1/4 <?= $card["bg-color"] ?>">
            <i class="bi bi-<?= $card["icon"] ?> text-5xl text-blue-400 block mb-3"></i>
            <p class="text-2xl font-bold my-1"><?= $card["value"] ?></p>
            <p class="text-zinc-700"><?= $card["label"] ?></p>
        </div>
    <?php endforeach ?>
</section>

<section class="p-4 lg:w-3/4 min-h-96 h-64 mt-4">
    <?= $chart->renderElement() ?>
</section>

<?= $this->endSection() ?>

<?= $this->section("script") ?>
<?= $chart->renderScript() ?>
<?= $this->endSection() ?>