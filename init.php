<?php

$files = [
    "caffe-latte.jpg",
    "cappucino.jpg",
    "french-press.jpg",
    "v60.jpg"
];

foreach ($files as $file) {
    $from = "writable/backup/coffe-images/$file";
    $to = "public/coffe-images/$file";

    if (copy($from, $to)) echo "\e[46m\e[37mInfo\e[0m\e[0m File: $file copied.\n";
}
