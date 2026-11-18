<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Facultades</h1>
    <a href="<?= url("facultad/registrar") ?>" class="btn btn-primary">Nueva facultad</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Abreviatura</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data["filas"] as $fila) : ?>
                <tr>
                    <td><?= e($fila["id"]) ?></td>
                    <td><?= e($fila["nombre"]) ?></td>
                    <td><?= e($fila["abreviatura"]) ?></td>
                    <td class="text-end">
                        <a href="<?= url("facultad/editar/" . $fila["id"]) ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                        <form action="<?= url("facultad/eliminar/" . $fila["id"]) ?>" method="post" class="d-inline" onsubmit="return confirm('Eliminar esta facultad?');">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($data["filas"])) : ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">No hay facultades activas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
