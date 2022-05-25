<?php

    class Cita {

        private $tipocita;
        private $fecha_cita;
        private $hora_cita;
        private $descripcion;
        private $idestado;
        private $idusuario;
        private $idpaciente;

        public function __construct()
        {
        }

        public function cargarCita($cita){
            $this->tipocita =$cita["tipocita"];
            $this->fecha_cita = $cita["fecha_cita"];
            $this->hora_cita = $cita["hora_cita"];
            $this->descripcion = $cita["descripcion"];
            $this->idestado = $cita["idestado"];
            $this->idusuario = $cita["idusuario"];
            $this->idpaciente = $cita["idpaciente"];
        }

        public function  cargarCitaparaRegistro($cita){
            $this->tipocita =$cita["tipocita"];
            $this->fecha_cita = $cita["fecha_cita"];
            $this->hora_cita = $cita["hora_cita"];
            $this->descripcion = $cita["descripcion"];
            $this->idestado = $cita["idestado"];
            $this->idusuario = $cita["idusuario"];
            $this->idpaciente = $cita["idpaciente"];
        }

        /**
         * @return mixed
         */
        public function getTipocita()
        {
            return $this->tipocita;
        }

        /**
         * @param mixed $tipocita
         */
        public function setTipocita($tipocita)
        {
            $this->tipocita = $tipocita;
        }

        /**
         * @return mixed
         */
        public function getFechaCita()
        {
            return $this->fecha_cita;
        }

        /**
         * @param mixed $fecha_cita
         */
        public function setFechaCita($fecha_cita)
        {
            $this->fecha_cita = $fecha_cita;
        }

        /**
         * @return mixed
         */
        public function getHoraCita()
        {
            return $this->hora_cita;
        }

        /**
         * @param mixed $hora_cita
         */
        public function setHoraCita($hora_cita)
        {
            $this->hora_cita = $hora_cita;
        }

        /**
         * @return mixed
         */
        public function getDescripcion()
        {
            return $this->descripcion;
        }

        /**
         * @param mixed $descripcion
         */
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }

        /**
         * @return mixed
         */
        public function getEstado()
        {
            return $this->estado;
        }

        /**
         * @param mixed $estado
         */
        public function setEstado($estado)
        {
            $this->estado = $estado;
        }

        /**
         * @return mixed
         */
        public function getIdusuario()
        {
            return $this->idusuario;
        }

        /**
         * @param mixed $idusuario
         */
        public function setIdusuario($idusuario)
        {
            $this->idusuario = $idusuario;
        }

        /**
         * @return mixed
         */
        public function getIdpaciente()
        {
            return $this->idpaciente;
        }

        /**
         * @param mixed $idpaciente
         */
        public function setIdpaciente($idpaciente)
        {
            $this->idpaciente = $idpaciente;
        }


    }

