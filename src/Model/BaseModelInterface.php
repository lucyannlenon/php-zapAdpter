<?php

    namespace LENON\WAPP\Model;

    use LENON\WAPP\Model\Exception\ModelValidateException;

    interface BaseModelInterface
    {
        public function getBody():array ;

        /**
         * @throws ModelValidateException
         * @return void
         */
        public function validate() :void ;

    }
