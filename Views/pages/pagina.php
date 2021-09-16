<?= Views\Templates\Index::run()  ?>
<div class="container">
<?php foreach($response['d'] as $d): ?>
  <p><?= $d->nombre_pagina  ?></p>
<?php endforeach ?>
</div>
<?= Views\Templates\Index::load("pagination", $pagination) ?>