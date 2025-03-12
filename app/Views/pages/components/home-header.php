<header class="sticky top-0">
    <div class="h-20 flex items-center justify-between bg-(--primary)">
        <div class="p-4">
            <img class="w-30" src="/assets/img/logo.png" alt="Logo" />
        </div>
        <div class="px-5">
            <a href="/cart" class="text-white relative">
                <i class="bi bi-cart text-2xl"></i>
                <?php if (session("sign-in")): ?>
                    <div class="rounded-full bg-orange-500 w-4 h-4 text-center align-middle text-xs absolute -top-3 -right-3" data-name="user-total-product">
                        <?= session("userTotalProduct") ?? $userTotalProduct ?? 0 ?>
                    </div>
                <?php endif ?>
            </a>

            <?php if (!session("sign-in")): ?>
                <a href="/sign-in" class="border border-cyan-700 ms-6 px-2 py-1 text-white rounded hover:bg-cyan-700 transition-colors">
                    <i class="bi bi-box-arrow-in-right"></i>
                </a>
            <?php endif ?>
            <?php if (session("sign-in")): ?>
                <form action="/sign-out" method="POST" class="inline">
                    <button class="border border-red-700 ms-6 px-2 py-1 text-white rounded hover:bg-red-700 transition-colors">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            <?php endif ?>
        </div>
    </div>
</header>