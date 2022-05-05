#!/usr/bin/env php
<?php
    // application.php

    use GuzzleHttp\Exception\RequestException;
    use LENON\WAPP\Adapters\ZAPIAdapter;

    require __DIR__ . '/vendor/autoload.php';


    $idInstancia = "3AADFC560FADD055FFFA265ECBC15AAE";
    $token = "0DDC40794AAAF1CE0575E636";
    $telefone = "5533991557333";

    $adpter = new ZAPIAdapter($idInstancia, $token);


    try {

        $adpter->sendMsg("Olá Deivison esté não é noss melhor forma de contato entretanto você também pode falar conosco atravéz do canal:",$telefone);

        $adpter->sendContact(new \LENON\WAPP\Model\ContactModel($telefone,"IZI Fácil","553333122222"));

    } catch (RequestException $e) {
        var_dump($e->getResponse()->getBody()->__toString());
    }

    echo "\n";
