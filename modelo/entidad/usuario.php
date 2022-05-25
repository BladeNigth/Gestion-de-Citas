<?php
class Usuario {

    private $usuario;
    private $contraseña;
    private $nombre;
    private $correo;
    private $telefono;
    private $genero;
    private $turno;
    private $fechac;
    private $tipo_usuario;

    public function __construct()
    {
    }

    public function cargarUsuario($usuario){
        $this->nombre = $usuario["nombre"];
        $this->usuario = $usuario["usuario"];
        $this->contraseña = $usuario["contraseña"];
        $this->correo = $usuario["correo"];
        $this->genero = $usuario["genero"];
        $this->telefono = $usuario["telefono"];
        $this->turno = $usuario["turno"];
        $this->tipo_usuario = $usuario["tipo_usuario"];

    }

    public function cargarUsuarioparaRegistro($usuario){

        $this->nombre = $usuario["nombre"];
        $this->usuario = $usuario["usuario"];
        $this->contraseña = $usuario["contraseña"];
        $this->correo = $usuario["correo"];
        $this->genero = $usuario["genero"];
        $this->telefono = $usuario["telefono"];
        $this->turno = $usuario["turno"];
        $this->tipo_usuario = $usuario["tipo_usuario"];

    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getContraseña()
    {
        return $this->contraseña;
    }

    /**
     * @param mixed $contraseña
     */
    public function setContraseña($contraseña)
    {
        $this->contraseña = $contraseña;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * @param mixed $turno
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;
    }

    /**
     * @return mixed
     */
    public function getFechac()
    {
        return $this->fechac;
    }

    /**
     * @param mixed $fechac
     */
    public function setFechac($fechac)
    {
        $this->fechac = $fechac;
    }

    /**
     * @return mixed
     */
    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }

    /**
     * @param mixed $tipo_usuario
     */
    public function setTipoUsuario($tipo_usuario)
    {
        $this->tipo_usuario = $tipo_usuario;
    }



}