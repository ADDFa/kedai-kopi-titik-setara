<header class="h-18 shadow">
    <div class="flex h-full items-center justify-between px-8">
        <a href="/">
            <img class="h-12" src="/assets/img/logo.png" alt="Titik Setara">
        </a>

        <div class="flex gap-2 items-center">
            <p><?= session("user.name") ?></p>
            <i class="bi bi-person-circle text-2xl"></i>
        </div>
    </div>
</header>