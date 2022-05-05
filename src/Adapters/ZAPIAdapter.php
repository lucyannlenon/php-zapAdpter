<?php


    namespace LENON\WAPP\Adapters;

    use GuzzleHttp\Client;
    use GuzzleHttp\Psr7\Utils;
    use LENON\WAPP\Model\BaseModelInterface;
    use LENON\WAPP\Model\ButtonsMessageModel;
    use LENON\WAPP\Model\ContactModel;
    use LENON\WAPP\Model\DocumentModel;
    use LENON\WAPP\Model\ImageModel;
    use LENON\WAPP\Model\MessageModel;

    class ZAPIAdapter
    {
        const SEND_TEXT = "1";
        const SEND_DOCUMENT = "2";
        const SEND_IMAGE = "3";
        const SEND_BUTTON = "4";
        const SEND_CONTACT = "5";
        const ENDPOINTS = [
            self::SEND_TEXT => '/send-text',
            self::SEND_DOCUMENT => '/send-document/',
            self::SEND_IMAGE => '/send-image',
            self::SEND_BUTTON => '/send-button-list',
            self::SEND_CONTACT => '/send-contact'
        ];

        private $urlBase = "https://api.z-api.io/instances/:INSTANCIA/token/:TOKEN";

        public function __construct($idInstancia, $token)
        {
            $this->urlBase = str_replace([':INSTANCIA', ':TOKEN'], [$idInstancia, $token], $this->urlBase);
        }

        /**
         * @param string $msg
         * @param $number
         * @return void
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \LENON\WAPP\Model\Exception\ModelValidateException
         */
        public function sendMsg(string $msg, $number): void
        {
            $model = new MessageModel($msg, $number);

            $this->send($model, self::ENDPOINTS[self::SEND_TEXT]);

        }

        /**
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \LENON\WAPP\Model\Exception\ModelValidateException
         */
        public function sendDocumento(DocumentModel $model)
        {

            $this->send($model, self::ENDPOINTS[self::SEND_DOCUMENT] . $model->getExtension());

        }


        public function sendImage(ImageModel $imageModel)
        {
            $this->send($imageModel, self::ENDPOINTS[self::SEND_IMAGE]);
        }

        public function sendButtons(ButtonsMessageModel $buttonsMessageModel)
        {
            $this->send($buttonsMessageModel, self::ENDPOINTS[self::SEND_BUTTON]);
        }

        public function sendContact(ContactModel $contactModel)
        {
            $this->send($contactModel, self::ENDPOINTS[self::SEND_CONTACT]);
        }

        /**
         * @throws \GuzzleHttp\Exception\GuzzleException
         * @throws \LENON\WAPP\Model\Exception\ModelValidateException
         */
        private function send(BaseModelInterface $msg, $endPoint)
        {
            $client = new Client();

            $msg->validate();

            $body = json_encode($msg->getBody());


            $uri = $this->urlBase . $endPoint;
            $response = $client->post($uri, [
                'headers' => [
                    "Content-Type" => 'application/json',
                ],
                'body' => $body
            ]);

            echo $response->getStatusCode(); // 200
            echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
            echo $response->getBody();

        }


    }
    /*
     *             if ($msg instanceof DocumentModel || $msg instanceof ImageModel) {
                    $body = Utils::streamFor($body);
                }
     */
