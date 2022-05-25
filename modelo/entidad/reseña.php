<?php

    class  Reseña {

        private $idreseña;
        private $descripcion;
        private $idcita;
        private $idusuario;
        private $idpaciente;

        public function __construct()
        {
        }

        public function cargarReseña ($reseña){

            $this->idreseña = $reseña["idreseña"];
            $this->descripcion = $reseña["descripcion"];
            $this->idusuario = $reseña["idusario"];
            $this->idpaciente = $reseña["idpaciente"];
            $this->idcita = $reseña["idcita"];

        }
        /**
         * @return mixed
         */
        public function getIdreseña()
        {
            return $this->idreseña;
        }

        /**
         * @param mixed $idreseña
         */
        public function setIdreseña($idreseña)
        {
            $this->idreseña = $idreseña;
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
        public function getIdcita()
        {
            return $this->idcita;
        }

        /**
         * @param mixed $idcita
         */
        public function setIdcita($idcita)
        {
            $this->idcita = $idcita;
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