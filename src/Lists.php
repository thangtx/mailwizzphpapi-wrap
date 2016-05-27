<?php

$app->group('/lists', function() use ($app) {
    $app->post('/get', function() use ($app) {
        $endpoint = new MailWizzApi_Endpoint_Lists();
        if(!$app->request()->post('list'))
        {
            echo json_encode(array('status' => 'error', 'result' => 'Parameter [list] is missing'));
            $app->stop();
        }
        $response = $endpoint->getList($app->request()->get('list'));
        echo MailWizzApi_Json::encode($response->body);
    });

    $app->get('/show', function() use ($app) {

        $endpoint = new MailWizzApi_Endpoint_Lists();
        $response = $endpoint->getLists();
        echo MailWizzApi_Json::encode($response->body);
    });

    $app->post('/fields', function() use ($app) {

        $endpoint = new MailWizzApi_Endpoint_ListFields();
        if(!$app->request()->post('list'))
        {
            echo json_encode(array('status' => 'error', 'result' => 'Parameter [list] is missing'));
            $app->stop();
        }
        $response = $endpoint->getFields($app->request()->get('list'));
        echo MailWizzApi_Json::encode($response->body);
    });

    $app->post('/segments', function() use ($app) {

        $endpoint = new MailWizzApi_Endpoint_ListSegments();
        if(!$app->request()->post('list'))
        {
            echo json_encode(array('status' => 'error', 'result' => 'Parameter [list] is missing'));
            $app->stop();
        }
        $response = $endpoint->getSegments($app->request()->post('list'));
        echo MailWizzApi_Json::encode($response->body);
    });

});