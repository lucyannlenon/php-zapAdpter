#!/usr/bin/env php
<?php
    // application.php

    use GuzzleHttp\Exception\RequestException;
    use LENON\WAPP\Adapters\ZAPIAdapter;

    require __DIR__ . '/vendor/autoload.php';


    $idInstancia = "xxx";
    $token = "xx";
    $telefone = "xxx";

    $adpter = new ZAPIAdapter($idInstancia, $token);


    try {

        $adpter->sendMsg("Olá Deivison esté não é noss melhor forma de contato entretanto você também pode falar conosco atravéz do canal:",$telefone);

        $adpter->sendContact(new \LENON\WAPP\Model\ContactModel($telefone,"IZI Fácil","553333122222"));

    } catch (RequestException $e) {
        var_dump($e->getResponse()->getBody()->__toString());
    }

    echo "\n";
