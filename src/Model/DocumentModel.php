<?php

    namespace LENON\WAPP\Model;

    use LENON\WAPP\Model\Exception\ModelValidateException;

    class DocumentModel implements BaseModelInterface
    {
        protected $id;
        protected $document;
        protected $documentName;
        protected $number;
        /**
         * @var \SplFileInfo
         */
        private $extension;

        /**
         * @param $msg
         * @param $number
         */
        public function __construct(string $document, $number, string $documentName = null,)
        {
            $this->number = $number;
            $this->document = $document;
            $this->documentName = $documentName;
            $this->extension = new \SplFileInfo($this->document);
        }

        public function getBody(): array
        {

            $data = [
                "phone" => $this->number,
                "document" => $this->getDocument(),
                'fileName' => $this->documentName ?? $this->extension->getBasename()
            ];


            return $data;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @return string
         */
        public function getDocument(): string
        {
            if (!file_exists($this->document)) {
                return $this->document;
            }
            // Read image path, convert to base64 encoding
            $encode = base64_encode(file_get_contents($this->document));

            return 'data:' . mime_content_type($this->document) . ';base64,' . $encode;

        }

        /**
         * @return string|null
         */
        public function getDocumentName(): ?string
        {
            return $this->documentName;
        }

        /**
         * @return mixed
         */
        public function getNumber()
        {
            return $this->number;
        }

        /**
         * @return string
         */
        public function getExtension(): mixed
        {

            return $this->extension->getExtension();
        }


        public function validate(): void
        {
            if (!filter_var($this->document, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED) && !$this->checkFileExists()) {
                throw  new ModelValidateException("O documento enviado precisa ser uma url apontando para um documento ou o path do documento ou um base 64 o arquivo ");
            }
        }

        public function checkFileExists(): bool
        {
            if (file_exists($this->document))
                return true;
            elseif (base64_decode($this->document))
                return true;
            return false;
        }
    }
