<?php

class DocenteModel extends Model
{
    const CATEGORIAS = ["AUXILIAR", "ASOCIADO", "PRINCIPAL"];
    const DEDICACIONES = ["DEDICACION EXCLUSIVA-DE", "TIEMPO COMPLETO-TC", "TIEMPO PARCIAL-TP"];

    public function listado()
    {
        return $this->select("docente.*, f.nombre AS facultad, f.abreviatura AS facultad_abreviatura")
            ->join("facultad f", "f.id = docente.id_facultad")
            ->where("docente.estado", 1)
            ->orderBy("docente.apellidos")
            ->orderBy("docente.nombres")
            ->get();
    }

    public function activo($id)
    {
        return $this->where(["id" => $id, "estado" => 1])->first();
    }

    public function porDni($dni)
    {
        return $this->where(["dni" => $dni, "estado" => 1])->first();
    }

    public function facultades()
    {
        return (new Model("facultad"))->where("estado", 1)->orderBy("nombre")->get();
    }

    public function facultadActiva($id)
    {
        return (new Model("facultad"))->where(["id" => $id, "estado" => 1])->first();
    }

    public function desactivar($id)
    {
        return $this->update($id, ["estado" => 0]);
    }
}
