  <div class="container">
    <ul class="pagination">
      <li class="page-item <?php if($arg['pag'] == 1) print "active" ?>"><a href="<?= $arg['url'] ?>1" class="page-link">1</a></li>
    <?php for($p = $arg['pag'] - 1; $p <= $arg['pag'] + 9; $p++): ?>
        <?php if($p != 0 && $p != 1 && $p <= $arg['res']['pages']): ?>
      <li class="page-item <?php if($arg['pag'] == $p) print "active" ?>"><a href="<?= $arg['url'].$p ?>" class="page-link"><?= $p ?></a></li> 
        <?php endif ?>
    <?php endfor ?>
    </ul>
  </div>