<?php

class FacultadController extends Controller
{
    public function index()
    {
        $this->views->render($this, "listar", [
            "titulo" => "Facultades",
            "filas" => $this->model->activas(),
        ]);
    }

    public function registrar()
    {
        $this->views->render($this, "formulario", [
            "titulo" => "Nueva facultad",
            "id" => null,
            "old" => [],
            "errores" => [],
        ]);
    }

    public function guardar()
    {
        $this->soloPost();
        $datos = $this->datosDelFormulario();
        $errores = $this->validar($datos);

        if ($errores) {
            return $this->views->render($this, "formulario", [
                "titulo" => "Nueva facultad",
                "id" => null,
                "old" => $_POST,
                "errores" => $errores,
            ]);
        }

        $datos["estado"] = 1;
        $this->model->insert($datos);
        $this->redirect("facultad");
    }

    public function editar($id)
    {
        $fila = $this->model->activa($id);
        if (!$fila) {
            return $this->notFound();
        }
        $this->views->render($this, "formulario", [
            "titulo" => "Editar facultad",
            "id" => $id,
            "old" => $fila,
            "errores" => [],
        ]);
    }

    public function actualizar($id)
    {
        $this->soloPost();
        if (!$this->model->activa($id)) {
            return $this->notFound();
        }

        $datos = $this->datosDelFormulario();
        $errores = $this->validar($datos);

        if ($errores) {
            return $this->views->render($this, "formulario", [
                "titulo" => "Editar facultad",
                "id" => $id,
                "old" => $_POST,
                "errores" => $errores,
            ]);
        }

        $this->model->update($id, $datos);
        $this->redirect("facultad");
    }

    public function eliminar($id)
    {
        $this->soloPost();
        if ($this->model->activa($id)) {
            $this->model->desactivar($id);
        }
        $this->redirect("facultad");
    }

    private function soloPost()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            $this->redirect("facultad");
        }
    }

    private function datosDelFormulario()
    {
        return [
            "nombre" => trim($_POST["nombre"] ?? ""),
            "abreviatura" => trim($_POST["abreviatura"] ?? ""),
        ];
    }

    private function validar($datos)
    {
        $errores = [];
        if ($datos["nombre"] === "") {
            $errores[] = "El nombre es obligatorio.";
        } elseif (mb_strlen($datos["nombre"]) > 120) {
            $errores[] = "El nombre no puede superar 120 caracteres.";
        }
        if ($datos["abreviatura"] === "") {
            $errores[] = "La abreviatura es obligatoria.";
        } elseif (mb_strlen($datos["abreviatura"]) > 20) {
            $errores[] = "La abreviatura no puede superar 20 caracteres.";
        }
        return $errores;
    }
}
