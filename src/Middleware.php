<?php

/**
 * Class APIResponseMiddleware
 * Set proper header for API response
 */
class APIResponseMiddleware extends \Slim\Middleware
{
    public function call()
    {
        $this->next->call();

        $this->app->response()->header('Content-Type', 'application/json');
    }
}

/**
 * Class APIAuthMiddleware
 * Authorize API call with tokens
 */
class APIAuthMiddleware extends \Slim\Middleware
{


    private $_privateKey;
    private $_publicKey;

    public function __construct()
    {
    }

    public function call()
    {
        $request = $this->app->request();

        $this->_publicKey = $request->headers->get('public-key');
        $this->_privateKey = $request->headers->get('private-key');

        //echo($publicKey);
        //echo($privateKey);

        if (!$this->_publicKey) {
            echo json_encode(array('status' => 'error', 'result' => 'Please provide public app key'));
            return;
        }


        if (!$this->_privateKey) {
            echo json_encode(array('status' => 'error', 'result' => 'Please provide private app key'));
            return;
        }
        
        $config = new MailWizzApi_Config(array(
            'apiUrl' => 'https://news.jamja.vn/api/index.php',
            'publicKey' => $this->_publicKey, 
            'privateKey' => $this->_privateKey,

            // components
            'components' => array(
                'cache' => array(
                    'class' => 'MailWizzApi_Cache_File',
                    'filesPath' => dirname(__FILE__) . '/../MailWizzApi/Cache/data/cache', // make sure it is writable by webserver
                )
            ),
        ));
        
        MailWizzApi_Base::setConfig($config);
        $this->next->call();
    }

}
