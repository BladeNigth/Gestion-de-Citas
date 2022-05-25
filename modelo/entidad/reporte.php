<?php
    class Reporte {
        private $descripcion;
        private $idreporte;
        private $idcita;
        private $idusuario;

        public function __construct()
        {
        }

        public function cargarReporte($reporte){
            $this->descripcion = $reporte["reporte"];
            $this->idcita = $reporte["idcita"];
            $this->idreporte = $reporte["idreporte"];
            $this->idusuario = $reporte["idusuario"];
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
        public function getIdreporte()
        {
            return $this->idreporte;
        }

        /**
         * @param mixed $idreporte
         */
        public function setIdreporte($idreporte)
        {
            $this->idreporte = $idreporte;
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



    }