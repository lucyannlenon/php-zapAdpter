<?php

    namespace LENON\WAPP\Model;

    use JMS\Serializer\SerializerBuilder;

    class ReturnModel
    {

        private $id;
        private $retorno;
        private $msg;
        private $config;
        private $service;
        private \JMS\Serializer\Serializer $serializer;

        /**
         * @param $id
         * @param $retorno
         * @param $msg
         * @param $config
         * @param $service
         */
        public function __construct($id, $retorno, $msg, $config, $service)
        {
            $this->serializer = SerializerBuilder::create()->build();
            $this->id = $id;
            $this->retorno = $this->serializerData($retorno);
            $this->msg = $this->serializerData($msg);
            $this->config = $this->serializerData($config);
            $this->service = $service;
        }


        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return mixed
         */
        public function getRetorno()
        {
            return $this->retorno;
        }

        /**
         * @return mixed
         */
        public function getMsg()
        {
            return $this->msg;
        }

        /**
         * @return mixed
         */
        public function getConfig()
        {
            return $this->config;
        }

        /**
         * @return mixed
         */
        public function getService()
        {
            return $this->service;
        }

        /**
         * @param $data
         * @return mixed
         */
        public function serializerData($data)
        {
            return $this->serializer->serialize($data, 'json');
        }


    }
