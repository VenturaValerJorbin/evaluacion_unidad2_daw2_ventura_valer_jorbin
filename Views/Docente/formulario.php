<?php
$accion = $data["id"] === null ? url("docente/guardar") : url("docente/actualizar/" . $data["id"]);
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
        <label for="id_facultad" class="form-label">Facultad</label>
        <select id="id_facultad" name="id_facultad" class="form-select" required>
            <option value="">Seleccione una facultad</option>
            <?php foreach ($data["facultades"] as $facultad) : ?>
                <option value="<?= e($facultad["id"]) ?>" <?= (string)($old["id_facultad"] ?? "") === (string)$facultad["id"] ? "selected" : "" ?>>
                    <?= e($facultad["abreviatura"] . " - " . $facultad["nombre"]) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-4">
        <label for="dni" class="form-label">DNI</label>
        <input type="text" id="dni" name="dni" class="form-control" maxlength="8" pattern="\d{8}" inputmode="numeric" value="<?= e($old["dni"] ?? "") ?>" required>
    </div>
    <div class="col-md-6">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" id="apellidos" name="apellidos" class="form-control" maxlength="100" value="<?= e($old["apellidos"] ?? "") ?>" required>
    </div>
    <div class="col-md-6">
        <label for="nombres" class="form-label">Nombres</label>
        <input type="text" id="nombres" name="nombres" class="form-control" maxlength="100" value="<?= e($old["nombres"] ?? "") ?>" required>
    </div>
    <div class="col-12">
        <label for="correo" class="form-label">Correo</label>
        <input type="email" id="correo" name="correo" class="form-control" maxlength="150" value="<?= e($old["correo"] ?? "") ?>" required>
    </div>
    <div class="col-md-6">
        <label for="categoria" class="form-label">Categoria</label>
        <select id="categoria" name="categoria" class="form-select" required>
            <option value="">Seleccione</option>
            <?php foreach ($data["categorias"] as $categoria) : ?>
                <option value="<?= e($categoria) ?>" <?= ($old["categoria"] ?? "") === $categoria ? "selected" : "" ?>><?= e($categoria) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="dedicacion" class="form-label">Dedicacion</label>
        <select id="dedicacion" name="dedicacion" class="form-select" required>
            <option value="">Seleccione</option>
            <?php foreach ($data["dedicaciones"] as $dedicacion) : ?>
                <option value="<?= e($dedicacion) ?>" <?= ($old["dedicacion"] ?? "") === $dedicacion ? "selected" : "" ?>><?= e($dedicacion) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?= url("docente") ?>" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</form>
