<?= Views\Templates\Index::run()  ?>
<p><?= $response['msg'] ?></p>
<div class="container-fluid">
  <form class="container p-5" action="/pages/nuevo" method="post" enctype="multipart/form-data">
    <label for="">Nombre página</label>
    <input type="text" class="form-control" name="nombre" value="<?= $old['nombre'] ?>">
    <small class="text-danger"><?= $err['nombre'] ?></small><br>
    <label for="">Tipo página</label>
    <input type="text" class="form-control" name="tipo" value="<?= $old['tipo'] ?>">
    <small class="text-danger"><?= $err['tipo']  ?></small><br>
    <input type="hidden" name="tkn" value="<?= $execute->get_token() ?>">
    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
  </form>
</div>
