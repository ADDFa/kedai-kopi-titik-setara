<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>
<h1>Home</h1>

<form action="/sign-out" method="POST">
    <button type="submit" class="btn">Sign Out</button>
</form>
<?= $this->endSection() ?>