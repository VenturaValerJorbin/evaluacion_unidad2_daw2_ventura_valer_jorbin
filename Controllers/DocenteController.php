<?php

class DocenteController extends Controller
{
    public function index()
    {
        $this->views->render($this, "listar", [
            "titulo" => "Docentes",
            "filas" => $this->model->listado(),
        ]);
    }

    public function registrar()
    {
        $this->mostrarFormulario("Nuevo docente", null, [], []);
    }

    public function guardar()
    {
        $this->soloPost();
        $datos = $this->datosDelFormulario();
        $errores = $this->validar($datos, null);

        if ($errores) {
            return $this->mostrarFormulario("Nuevo docente", null, $_POST, $errores);
        }

        $datos["estado"] = 1;
        $this->model->insert($datos);
        $this->redirect("docente");
    }

    public function editar($id)
    {
        $fila = $this->model->activo($id);
        if (!$fila) {
            return $this->notFound();
        }
        $this->mostrarFormulario("Editar docente", $id, $fila, []);
    }

    public function actualizar($id)
    {
        $this->soloPost();
        if (!$this->model->activo($id)) {
            return $this->notFound();
        }

        $datos = $this->datosDelFormulario();
        $errores = $this->validar($datos, $id);

        if ($errores) {
            return $this->mostrarFormulario("Editar docente", $id, $_POST, $errores);
        }

        $this->model->update($id, $datos);
        $this->redirect("docente");
    }

    public function eliminar($id)
    {
        $this->soloPost();
        if ($this->model->activo($id)) {
            $this->model->desactivar($id);
        }
        $this->redirect("docente");
    }

    private function mostrarFormulario($titulo, $id, $old, $errores)
    {
        $this->views->render($this, "formulario", [
            "titulo" => $titulo,
            "id" => $id,
            "old" => $old,
            "errores" => $errores,
            "facultades" => $this->model->facultades(),
            "categorias" => DocenteModel::CATEGORIAS,
            "dedicaciones" => DocenteModel::DEDICACIONES,
        ]);
    }

    private function soloPost()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->redirect("docente");
        }
    }

    private function datosDelFormulario()
    {
        return [
            "id_facultad" => (int)($_POST["id_facultad"] ?? 0),
            "dni" => trim($_POST["dni"] ?? ""),
            "apellidos" => trim($_POST["apellidos"] ?? ""),
            "nombres" => trim($_POST["nombres"] ?? ""),
            "correo" => trim($_POST["correo"] ?? ""),
            "categoria" => $_POST["categoria"] ?? "",
            "dedicacion" => $_POST["dedicacion"] ?? "",
        ];
    }

    private function validar($datos, $idActual)
    {
        $errores = [];

        if (!$this->model->facultadActiva($datos["id_facultad"])) {
            $errores[] = "Seleccione una facultad valida.";
        }

        if (!preg_match('/^\d{8}$/', $datos["dni"])) {
            $errores[] = "El DNI debe tener exactamente 8 digitos.";
        } else {
            $existente = $this->model->porDni($datos["dni"]);
            if ($existente && (string)$existente["id"] !== (string)$idActual) {
                $errores[] = "Ya existe un docente activo con ese DNI.";
            }
        }

        if ($datos["apellidos"] === "" || mb_strlen($datos["apellidos"]) > 100) {
            $errores[] = "Los apellidos son obligatorios (maximo 100 caracteres).";
        }
        if ($datos["nombres"] === "" || mb_strlen($datos["nombres"]) > 100) {
            $errores[] = "Los nombres son obligatorios (maximo 100 caracteres).";
        }
        if (!filter_var($datos["correo"], FILTER_VALIDATE_EMAIL) || mb_strlen($datos["correo"]) > 150) {
            $errores[] = "Ingrese un correo valido (maximo 150 caracteres).";
        }

        if (!in_array($datos["categoria"], DocenteModel::CATEGORIAS, true)) {
            $errores[] = "La categoria debe ser AUXILIAR, ASOCIADO o PRINCIPAL.";
        }
        if (!in_array($datos["dedicacion"], DocenteModel::DEDICACIONES, true)) {
            $errores[] = "La dedicacion debe ser una de las opciones de la lista.";
        }

        return $errores;
    }
}
