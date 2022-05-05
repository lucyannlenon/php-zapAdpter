<?php

    namespace LENON\WAPP\Model;

    class Button
    {
        public $id;
        public $label;

        /**
         * @param $id
         * @param $label
         */
        public function __construct($label, $id = null)
        {
            $this->setId($id);
            $this->label = $label;
        }

        private function setId($id)
        {
            if (empty($id)) {
                $this->id = md5(uniqid());
                return;
            }
            $this->id = $id;
        }


    }
