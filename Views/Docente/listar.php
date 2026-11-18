<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Docentes</h1>
    <a href="<?= url("docente/registrar") ?>" class="btn btn-primary">Nuevo docente</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Facultad</th>
                <th>DNI</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Correo</th>
                <th>Categoria</th>
                <th>Dedicacion</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data["filas"] as $fila) : ?>
                <tr>
                    <td><?= e($fila["facultad"]) ?></td>
                    <td><?= e($fila["dni"]) ?></td>
                    <td><?= e($fila["apellidos"]) ?></td>
                    <td><?= e($fila["nombres"]) ?></td>
                    <td><?= e($fila["correo"]) ?></td>
                    <td><?= e($fila["categoria"]) ?></td>
                    <td><?= e($fila["dedicacion"]) ?></td>
                    <td class="text-end text-nowrap">
                        <a href="<?= url("docente/editar/" . $fila["id"]) ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                        <form action="<?= url("docente/eliminar/" . $fila["id"]) ?>" method="post" class="d-inline" onsubmit="return confirm('Eliminar este docente?');">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($data["filas"])) : ?>
                <tr>
                    <td colspan="8" class="text-center text-muted">No hay docentes activos.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
