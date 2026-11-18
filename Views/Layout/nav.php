<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= url() ?>"><?= e(APP_NAME) ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal" aria-controls="menuPrincipal" aria-expanded="false" aria-label="Mostrar menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $controller === "Home" ? "active" : "" ?>" href="<?= url() ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller === "Facultad" ? "active" : "" ?>" href="<?= url("facultad") ?>">Facultades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $controller === "Docente" ? "active" : "" ?>" href="<?= url("docente") ?>">Docentes</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
