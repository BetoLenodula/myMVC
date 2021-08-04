<?= Views\Templates\Index::run()  ?>
<p><?= $response ?></p>
<div class="container-fluid">
  <form class="container p-5" action="/pages/nuevo" method="post">
    <label for="">Nombre página</label>
    <input type="text" class="form-control" name="nombre" value="<?= $old['nombre'] ?>">
    <small class="text-danger"><?= $err['nombre'] ?></small><br>
    <label for="">Tipo página</label>
    <input type="text" class="form-control" name="tipo" value="<?= $old['tipo'] ?>">
    <small class="text-danger"><?= $err['tipo']  ?></small><br>
    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
  </form>
</div>
