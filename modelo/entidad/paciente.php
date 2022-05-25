<?php
class Paciente {

    private $usuariop;
    private $contraseñap;
    private $nombrep;
    private $correop;
    private $fechanacimiento;
    private $telefonop;
    private $generop;
    private $fechacp;
    private $cedula;

    public function __construct()
    {

    }

    public function cargarPaciente ($paciente){
        $this->nombrep = $paciente["nombre"];
        $this->usuariop = $paciente["usuariop"];
        $this->contraseñap = $paciente["contraseña"];
        $this->correop = $paciente["correo"];
        $this->generop = $paciente["genero"];
        $this->telefonop = $paciente["telefono"];
        $this->fechacp = $paciente["fechacp"];
        $this->cedula = $paciente["cedula"];
        $this->fechanacimiento = $paciente["fechanacimiento"];
    }
    public function cargarPacienteRegistro($paciente){
        $this->nombrep = $paciente["nombre"];
        $this->usuariop = $paciente["usuariop"];
        $this->contraseñap = $paciente["contraseña"];
        $this->correop = $paciente["correo"];
        $this->generop = $paciente["genero"];
        $this->telefonop = $paciente["telefono"];
        $this->fechacp = $paciente["fechacp"];
        $this->cedula = $paciente["cedula"];
        $this->fechanacimiento = $paciente["fechanacimiento"];
    }

    /**
     * @return mixed
     */
    public function getUsuariop()
    {
        return $this->usuariop;
    }

    /**
     * @param mixed $usuariop
     */
    public function setUsuariop($usuariop)
    {
        $this->usuariop = $usuariop;
    }

    /**
     * @return mixed
     */
    public function getContraseñap()
    {
        return $this->contraseñap;
    }

    /**
     * @param mixed $contraseñap
     */
    public function setContraseñap($contraseñap)
    {
        $this->contraseñap = $contraseñap;
    }

    /**
     * @return mixed
     */
    public function getNombrep()
    {
        return $this->nombrep;
    }

    /**
     * @param mixed $nombrep
     */
    public function setNombrep($nombrep)
    {
        $this->nombrep = $nombrep;
    }

    /**
     * @return mixed
     */
    public function getCorreop()
    {
        return $this->correop;
    }

    /**
     * @param mixed $correop
     */
    public function setCorreop($correop)
    {
        $this->correop = $correop;
    }

    /**
     * @return mixed
     */
    public function getFechanacimiento()
    {
        return $this->fechanacimiento;
    }

    /**
     * @param mixed $fechanacimiento
     */
    public function setFechanacimiento($fechanacimiento)
    {
        $this->fechanacimiento = $fechanacimiento;
    }

    /**
     * @return mixed
     */
    public function getTelefonop()
    {
        return $this->telefonop;
    }

    /**
     * @param mixed $telefonop
     */
    public function setTelefonop($telefonop)
    {
        $this->telefonop = $telefonop;
    }

    /**
     * @return mixed
     */
    public function getGenerop()
    {
        return $this->generop;
    }

    /**
     * @param mixed $generop
     */
    public function setGenerop($generop)
    {
        $this->generop = $generop;
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
    public function getFechacp()
    {
        return $this->fechacp;
    }

    /**
     * @param mixed $fechacp
     */
    public function setFechacp($fechacp)
    {
        $this->fechacp = $fechacp;
    }

    /**
     * @return mixed
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @param mixed $cedula
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }



}