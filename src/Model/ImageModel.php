<?php

    namespace LENON\WAPP\Model;

    use LENON\WAPP\Model\Exception\ModelValidateException;

    class ImageModel implements BaseModelInterface
    {

        protected $phone;
        protected $img;
        protected $caption;

        /**
         * @param $phone
         * @param $img
         * @param $caption
         */
        public function __construct($phone, $img, $caption = null)
        {
            $this->phone = $phone;
            $this->img = $img;
            $this->caption = $caption;
        }


        /**
         * @return mixed
         */
        public function getPhone()
        {
            return $this->phone;
        }

        /**
         * @return mixed
         */
        public function getImg()
        {
            if (!file_exists($this->img)) {
                return $this->img;
            }
            // Read image path, convert to base64 encoding
            $encode = base64_encode(file_get_contents($this->img));

            return 'data:' . mime_content_type($this->img) . ';base64,' . $encode;

        }

        /**
         * @return mixed
         */
        public function getCaption()
        {
            return $this->caption;
        }


        public function getBody(): array
        {
            $data = [
                'phone' => $this->phone,
                'image' => $this->getImg(),
            ];

            if (!empty($this->caption))
                $data['caption'] = $this->caption;
            return $data;
        }

        public function validate(): void
        {
            if (empty($this->img)) {
                throw  new ModelValidateException("A imagem enviada não é válida");
            }
        }
    }
