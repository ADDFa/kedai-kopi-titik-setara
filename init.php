<?php

// $files = [
//     "caffe-latte.jpg",
//     "cappucino.jpg",
//     "french-press.jpg",
//     "v60.jpg"
// ];

// foreach ($files as $file) {
//     $from = "writable/backup/coffe-images/$file";
//     $to = "public/coffe-images/$file";

//     if (copy($from, $to)) echo "\e[46m\e[37mInfo\e[0m\e[0m File: $file copied.\n";
// }

$dirs = scandir("writable/backup");

function cp($source, $dest)
{
    // Pastikan sumber ada dan merupakan direktori
    if (!is_dir($source)) return false;

    // Buat folder tujuan jika belum ada
    if (!is_dir($dest)) mkdir($dest, 0755, true);

    // Buka direktori sumber
    $files = scandir($source);
    foreach ($files as $file) {
        if ($file === "." || $file === "..") continue;

        $sourcePath = $source . DIRECTORY_SEPARATOR . $file;
        $destinationPath = $dest . DIRECTORY_SEPARATOR . $file;

        // jika file, salin langsung
        if (is_file($sourcePath)) copy($sourcePath, $destinationPath);

        // jika folder, panggil rekursif
        if (is_dir($sourcePath)) cp($sourcePath, $destinationPath);
    }

    return true;
}

cp("writable/backup", "public/img");
