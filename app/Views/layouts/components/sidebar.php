<?php

$sidebarList = [
    [
        "text"      => "Dashboard",
        "icon"      => "ui-checks-grid",
        "action"    => "dashboard"
    ],
    [
        "text"      => "Produk",
        "icon"      => "box-seam",
        "action"    => "product"
    ],
    [
        "text"      => "Pesanan",
        "icon"      => "receipt",
        "action"    => "customer/order"
    ]
];

?>

<aside class="flex-none overflow-auto p-4 shadow-lg flex flex-col w-[82px] lg:w-70 transition-all duration-500 ease-in-out">
    <ul class="py-4 flex-1">
        <?php foreach ($sidebarList as $sidebarItem): ?>
            <li class="flex flex-col mb-3">
                <a href="<?= "/" . $sidebarItem["action"] ?>" class="flex items-center overflow-hidden px-4 py-3 rounded-lg transition-all hover:bg-[#ffc4a090] lg:text-left <?= isset($active) && $active === $sidebarItem["action"] ? "active" : "" ?>">
                    <i class="bi bi-<?= $sidebarItem["icon"] ?> text-lg lg:me-4 lg:text-sm"></i>
                    <span class="hidden lg:inline"><?= $sidebarItem["text"] ?></span>
                </a>
            </li>
        <?php endforeach ?>
    </ul>

    <form action="/sign-out" method="POST">
        <button role="button" role="button" class="w-full text-center border border-red-700 py-2 rounded-lg transition-colors hover:bg-red-700 hover:text-white lg:rounded-full flex justify-center items-center gap-2 max-h-11 overflow-hidden">
            <span class="hidden lg:inline text-nowrap">Sign Out</span>
            <i class="bi bi-box-arrow-right"></i>
        </button>
    </form>
</aside>