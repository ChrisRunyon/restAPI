<?php

/*require_once($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');*/

/*
$a = $_SERVER['HTTP_ORIGIN'];
if($a != "http://devclient.localhost.tv" && $a != "http://sobs.tv"){
    header("HTTP/1.0 403 Forbidden");
    exit;
}
*/

// get host name from URL
/*preg_match('@^(?:http://)?([^/]+)@i',
    $_SERVER['HTTP_ORIGIN'], $matches);
$host = $matches[1];

// get last two segments of host name
preg_match('/[^.]+\.[^.]+$/', $host, $matches);
if($host !='admin.localhost.tv' && $matches[0] != "localhost.tv" && $matches[0] != "sobs.tv" && $matches[0]!= "bkbazaar.tv"){
    header("HTTP/1.0 403 Forbidden");
    exit;
}*/

spl_autoload_register(
/**
 * @param $className
 * @return bool
 */
    function ($className) {

    if (preg_match('/[a-zA-Z]+Controller$/', $className)) {
        include_once __DIR__ . '/v1/controllers/' . $className . '.php';

        if (!class_exists($className, false)) {

        }
        return true;
    }
    elseif (preg_match('/[a-zA-Z]+Model$/', $className)) {
        include_once __DIR__ . '/v1/models/' . $className . '.php';

        if (!class_exists($className, false)) {

        }
        return true;
    }
    elseif (preg_match('/[a-zA-Z]+View$/', $className)) {
        include_once __DIR__ . '/v1/views/' . $className . '.php';

        if (!class_exists($className, false)) {

        }
        return true;
    }
});

// initialize Request handler
$init_request = new Request();

// if exists assign the request to the right controller
$controller_name = ucfirst($init_request->url_elements[1]) . 'Controller';

// assign className for auto loader
$className = $controller_name;

// if exists assign the request to the right model
$model_name = ucfirst($init_request->url_elements[1]) . 'Model';

/* Process request */
if (class_exists($model_name)) {
    $model = new $model_name();
    if (class_exists($controller_name)) {

        // instantiate new controller
        $controller = new $controller_name();

        // attach the relevant model to the controller
        $controller->attachModel($model);

        // assign process verb (GET, POST, DELETE) to a method name
        $action_name = strtolower($init_request->verb) . 'Action';

        // finalize request
        $result = $controller->$action_name($init_request);

        // instantiate new view based on content-type
        $view_name = ucfirst($init_request->format) . 'View';

        if(class_exists($view_name)) {
            $view = new $view_name();

            // return result to client
            $view->render($result);

        } else {
            //throw new Exception('View not found');
            header("Location http://rest.com/index.html");
        }
    } else {
        //throw new Exception('Controller not found');
        header("Location http://rest.com/index.html");
    }
} else {
    //throw new Exception('Model not found');
    header("Location http://rest.com/index.html");
}


class Request {

    public $url_elements;
    public $verb;
    public $parameters;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: http://127.0.0.1");
        header("Access-Control-Max-Age: 1000");
        header("Access-Control-Allow-Headers: x-csrf-token, x-requested-with, Content-Type, origin, authorization, Accept, oauth_consumer_key,oauth_nonce,oauth_signature,oauth_signature_method,oauth_timestamp,oauth_token,oauth_version");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

        $this->verb = $_SERVER['REQUEST_METHOD'];
        if(!empty($_SERVER['PATH_INFO'])) {
            $this->url_elements = explode('/', $_SERVER['PATH_INFO']);
            $this->parseQueryStringParams();
            $this->format = 'json';
            if(isset($this->parameters['format']))
            {
                $this->format = $this->parameters['format'];
            }
            return true;
        }
    }

    public function parseQueryStringParams() {
        $parameters = array();

        if(isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }

        $body = file_get_contents('php://input');
        $content_type = false;
        if(isset($_SERVER['CONTENT_TYPE'])) {
            $substring = explode(";", $_SERVER['CONTENT_TYPE']);
            $content_type = $substring[0];
        }

        switch($content_type) {
            case 'application/json':
                $body_params = json_decode($body);
                if($body_params) {
                    foreach($body_params as $param_name => $param_value) {
                        $parameters[$param_name] = $param_value;
                    }
                }
                $this->format = 'json';
                break;
            case 'application/x-www-form-urlencoded':
                parse_str($body, $postVars);
                foreach($postVars as $field => $value) {
                    $parameters[$field] = $value;
                }
                $this->format = 'html';
                break;
            default:
                break;
        }
        $this->parameters = $parameters;
    }
}

