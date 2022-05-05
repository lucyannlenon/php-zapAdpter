<?php

    namespace LENON\WAPP\Model;

    use LENON\WAPP\Model\Exception\ModelValidateException;

    class ButtonsMessageModel implements BaseModelInterface
    {

        private $phone;
        private $msg;

        /** @var Button[] */
        private array $buttunsList;

        /**
         * @param $phone
         * @param $msg
         * @param array $buttonsList
         * @throws ModelValidateException
         */
        public function __construct($phone, $msg, array $buttonsList)
        {
            $this->phone = $phone;
            $this->msg = $msg;
            $this->addListButtons($buttonsList);
        }


        public function getBody(): array
        {
            return [
                "phone" => $this->phone,
                "message" => $this->msg,
                "buttonList" => [
                    "buttons" => $this->getButtons()
                ]
            ];
        }

        public function addButton(Button $button)
        {
            $this->buttunsList[] = $button;
        }

        public function validate(): void
        {
            if (empty($this->msg)) {
                throw  new ModelValidateException("A mensagem não pode estar vazia");
            } elseif (count($this->buttunsList) <= 0) {

                throw  new ModelValidateException("A adicione pelo menos um botão");
            }
        }

        private function getButtons(): array
        {
            $btns = [];
            foreach ($this->buttunsList as $btn) {
                $btns[] = [
                    "id" => $btn->id,
                    "label" => $btn->label
                ];
            }
            return $btns;
        }

        public function addListButtons(array $buttonsList)
        {
            foreach ($buttonsList as $item) {
                if (!($item instanceof Button)) {
                    throw  new ModelValidateException("O botão enviado precisa ser do tipo Botton");
                }
                $this->addButton($item);
            }
        }
    }
