<?php

    namespace LENON\WAPP\Model;

    use LENON\WAPP\Model\Exception\ModelValidateException;

    class ContactModel implements BaseModelInterface
    {
        private $phone;
        private $contactName;
        private $contactPhone;

        public function __construct($phone, $contactName, $contactPhone)
        {

            $this->phone = $phone;
            $this->contactName = $contactName;
            $this->contactPhone = $contactPhone;
        }

        public function getBody(): array
        {
            return [
                "phone" => $this->phone,
                "contactName" => $this->contactName,
                "contactPhone" => $this->contactPhone
            ];
        }

        /**
         * @inheritDoc
         */
        public function validate(): void
        {
            if (empty($this->contactName)) {
                throw  new ModelValidateException("O nome do contato não pode ser vazio");
            } elseif (empty($this->contactPhone)) {
                throw  new ModelValidateException("O Numero do contato não pode ser vazio");
            }
        }
    }
