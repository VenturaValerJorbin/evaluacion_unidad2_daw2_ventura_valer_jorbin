<?php

class FacultadModel extends Model
{
    public function activas()
    {
        return $this->where("estado", 1)->orderBy("nombre")->get();
    }

    public function activa($id)
    {
        return $this->where(["id" => $id, "estado" => 1])->first();
    }

    public function desactivar($id)
    {
        return $this->update($id, ["estado" => 0]);
    }
}
