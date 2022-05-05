<?php

    namespace LENON\WAPP\Model;

    use LENON\WAPP\Model\Exception\ModelValidateException;

    class MessageModel implements BaseModelInterface
    {
        protected $msg;
        protected $number;

        /**
         * @param $msg
         * @param $number
         */
        public function __construct($msg, $number)
        {
            $this->msg = $msg;
            $this->number = $number;
        }

        public function getBody(): array
        {
            return [
                "phone" => $this->number,
                "message" => $this->msg
            ];
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
        public function getNumber()
        {
            return $this->number;
        }


        public function validate(): void
        {
            if(empty($this->msg))
                throw  new ModelValidateException("A msg Enviada é inválida") ;
        }
    }
