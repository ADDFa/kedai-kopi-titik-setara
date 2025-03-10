<?php $defaultTitle = "Kedai Kopi Titik Setara" ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . " - " . $defaultTitle : $defaultTitle ?></title>

    <!-- icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- styles -->
    <link href="/assets/css/index.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <?= $this->renderSection("content") ?>

    <?php if (session("message")): ?>
        <div id="message" class="hidden" data-icon="<?= session("message.icon") ?? "success" ?>"><?= session("message.text") ?></div>
    <?php endif ?>

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- script -->
    <?= $this->renderSection("script") ?>
    <script src="/assets/js/index.js" type="module"></script>
</body>

</html>