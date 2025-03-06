<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>
<?= $this->include("layouts/components/header") ?>

<main class="flex h-[calc(100lvh-72px)] overflow-hidden">
    <?= $this->include("layouts/components/sidebar") ?>

    <section class="w-full overflow-auto">
        <?= $this->renderSection("content") ?>
    </section>
</main>

<?= $this->endSection() ?>