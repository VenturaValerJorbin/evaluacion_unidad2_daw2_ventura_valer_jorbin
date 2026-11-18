<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->views->render($this, "index", ["titulo" => "Inicio"]);
    }
}
