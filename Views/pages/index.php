<?= Views\Templates\Index::run() ?>
<?php foreach($response['d'] as $val): ?>
  <p><?= $val->id."-".$val->tipo_pagina ?></p>
<?php endforeach; ?>
 <p>Hola mundo aquí estoy</p>
