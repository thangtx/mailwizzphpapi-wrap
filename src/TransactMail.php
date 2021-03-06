<?php

$app->group('/transact', function() use ($app) {

    $app->post('/get', function() use ($app) {
        $endpoint = new MailWizzApi_Endpoint_TransactionalEmails();
        if(!$app->request()->post('id'))
        {
            echo json_encode(array('status' => 'error', 'result' => 'Parameter [id] is missing'));
            $app->stop();
        }
        $response = $endpoint->getEmail($app->request()->get('id'));
        echo MailWizzApi_Json::encode($response->body);
    });


    $app->post('/show', function() use ($app) {

        $endpoint = new MailWizzApi_Endpoint_TransactionalEmails();

        if(!$app->request()->post('pageNumber'))
        {
            $pageNumber=1;
        }
        else
        {
            $pageNumber= $app->request()->post('pageNumber');
        }

        if(!$app->request()->post('perPage'))
        {
            $perPage=1;
        }
        else
        {
            $perPage= $app->request()->post('perPage');
        }
        

        $response = $endpoint->getEmails($pageNumber = $pageNumber, $perPage = $perPage);

        echo MailWizzApi_Json::encode($response->body);

    });

    $app->post('/create', function() use ($app) {

        $endpoint = new MailWizzApi_Endpoint_TransactionalEmails();

        $post = $app->request->post();

        if(!$post['to_name'] )
        {
            echo json_encode(array('status' => 'error', 'result' => 'Chưa có tên người nhận'));
            $app->stop();
        }

        if(!$post['to_email'] )
        {
            echo json_encode(array('status' => 'error', 'result' => 'Chưa có địa chỉ nhận thư'));
            $app->stop();
        }

        if(!$post['subject'] )
        {
            echo json_encode(array('status' => 'error', 'result' => 'Chưa có tiêu đề thư'));
            $app->stop();
        }

        if(!isset($post['from_name']))
        {
            $post['from_name'] = 'JAMJA - Chẳng lo về giá';
        }

        if(!isset($post['from_email']))
        {
            $post['from_email'] = 'info@jamja.vn';
        }

        if(!isset($post['reply_to_name']))
        {
            $post['reply_to_name'] = 'JAMJA Team';
        }

        if(!isset($post['reply_to_email']))
        {
            $post['reply_to_email'] = 'info@jamja.vn';
        }

        if(!isset($post['plain_text']))
        {
            $post['plain_text'] = '';
        }

        if(!isset($post['body']))
        {
            echo json_encode(array('status' => 'error', 'result' => 'Chưa có nội dung thư'));
            $app->stop();
        }
        #$send_at=date('Y-m-d H:i:s');
        #$send_at->modify('-1 day');
        $date = new DateTime("now", new DateTimeZone('UTC') );
        $response = $endpoint->create(array(
            'to_name'           => $post['to_name'], // required
            'to_email'          => $post['to_email'], // required
            'from_name'         => $post['from_name'], // required
            'from_email'        => $post['from_email'], // optional
            'reply_to_name'     => $post['reply_to_name'], // optional
            'reply_to_email'    => $post['reply_to_email'], // optional
            'subject'           => $post['subject'], // required
            'body'              => $post['body'], // required
            'plain_text'        => $post['plain_text'], // optional, will be autogenerated if missing
            'send_at'           => $date->format('Y-m-d H:i:s'),  // required, UTC date time in same format!
        ));
        
        echo MailWizzApi_Json::encode($response->body);

    });

});
