<!doctype html>
<html lang="en">

<head>
    <title>Todos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
			shrink-to-fit=no">
    <?= $this->Html->meta('csrfToken', $this->request->getCookie('csrfToken')); ?>
    <!-- Importing all css -->
    <?= $this->Html->css(['bootstrap.min', 'style',  'font-awesome.min.css',]) ?>

    <!-- Importing all scripts -->
    <?= $this->Html->script(
        [
            'jquery',
            'bootstrap',
            'main',
        ],
        ['block' => 'allJS']
    ) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>

<body>
    <!-- <?= debug($this->request->getCookie('csrfToken')); ?> -->
    <div class="wrapper d-flex align-items-stretch">
        <?= $this->element('nav'); ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <?= $this->fetch('content'); ?>
        </div>
    </div>

</body>
<?= $this->fetch('allJS') ?>

</html>