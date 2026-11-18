<?php
$accion = $data["id"] === null ? url("facultad/guardar") : url("facultad/actualizar/" . $data["id"]);
$old = $data["old"];
?>
<h1 class="h3 mb-3"><?= e($data["titulo"]) ?></h1>

<?php if (!empty($data["errores"])) : ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($data["errores"] as $error) : ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= $accion ?>" method="post" class="row g-3">
    <div class="col-md-8">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" id="nombre" name="nombre" class="form-control" maxlength="120" value="<?= e($old["nombre"] ?? "") ?>" required>
    </div>
    <div class="col-md-4">
        <label for="abreviatura" class="form-label">Abreviatura</label>
        <input type="text" id="abreviatura" name="abreviatura" class="form-control" maxlength="20" value="<?= e($old["abreviatura"] ?? "") ?>" required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?= url("facultad") ?>" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>
