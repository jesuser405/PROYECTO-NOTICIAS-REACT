<?php
class Formulario {
    public $name;
    public $apellido;
    public $email;
    public $empleo;
    public $titulacion;
    public $comentario;

    // SETTERS
    public function setName($name) {
        $this->name = $name;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setEmpleo($empleo) {
        $this->empleo = $empleo;
    }

    public function setTitulacion($titulacion) {
        $this->titulacion = $titulacion;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    // GETTERS
    public function getName() {
        return $this->name;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getEmpleo() {
        return $this->empleo;
    }

    public function getTitulacion() {
        return $this->titulacion;
    }

    public function getComentario() {
        return $this->comentario;
    }
}
