<?php

$app->group('/subscribers', function() use ($app){

    $app->post('/user/add', function() use ($app) {

        $endpoint = new MailWizzApi_Endpoint_ListSubscribers();

        $post = $app->request->post();

        if(!$post['email'] || !$post['list'] )
        {
            echo json_encode(array('status' => 'error', 'result' => 'Some parameters are missing'));
            $app->stop();
        }

        if(!isset($post['fname']))
        {
            $post['fname'] = '';
        }
        
        if(!isset($post['lname']))
        {
            $post['lname'] = '';
        }

        if(!isset($post['joindate']))
        {
            $post['joindate'] = '';
        }

        if(!isset($post['facebook']))
        {
            $post['facebook'] = '';
        }

        if(!isset($post['gender']))
        {
            $post['gender'] = '';
        }

        if(!isset($post['fullname']))
        {
            $post['fullname'] = '';
        }

        if(!isset($post['birthday']))
        {
            $post['birthday'] = '';
        }

        $response = $endpoint->createUpdate($post['list'], array(
            'EMAIL'    => $post['email'],
            'FNAME'    => $post['fname'],
            'LNAME'    => $post['lname'],
            'joindate'    => $post['joindate'],
            'facebook'    => $post['facebook'],
            'gender'    => $post['gender'],
            'fullname'    => $post['fullname'],
            'birthday'    => $post['birthday'],
        ));
        echo MailWizzApi_Json::encode($response->body);
    });
    

});
