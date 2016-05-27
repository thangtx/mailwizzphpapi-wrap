<?php

$app->group('/templates', function() use ($app) {

    $app->post('/get', function() use ($app) {
        $endpoint = new MailWizzApi_Endpoint_Templates();
        if(!$app->request()->post('id'))
        {
            echo json_encode(array('status' => 'error', 'result' => 'Parameter [id] is missing'));
            $app->stop();
        }
        $response = $endpoint->getTemplate($app->request()->get('id'));
        echo MailWizzApi_Json::encode($response->body);
    });


    $app->get('/show', function() use ($app) {

        $endpoint = new MailWizzApi_Endpoint_Templates();
        $response = $endpoint->getTemplates();
        echo MailWizzApi_Json::encode($response->body);

    });

});