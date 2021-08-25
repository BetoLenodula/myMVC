<?= Views\Templates\Index::run()  ?>
<div class="container">
<?php foreach($response['d'] as $dt): ?>
  <p><?= $dt->nombre_pagina  ?></p>
<?php endforeach ?>
</div>
<?= Views\Templates\Index::load("pagination", $pagination) ?>