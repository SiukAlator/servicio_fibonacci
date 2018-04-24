<?php


require __DIR__ . '/../vendor/autoload.php';
require_once '../src/DbHandler.php';
require_once '../src/middleware.php';
require_once '../src/Config.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Slim\Http\UploadedFile;




$app = new \Slim\App;


/*
{
  "status": {
    "code": "200",
    "message": "Success",
    "str": "OK"
  },
  "response": {
    "count": 1,
    "data": [
      {
        "code": "APP_CONTACT_PHONE",
        "name": "Mobile Contact Phone",
        "values": {
          "contact_phone": "*0123"
        }
      }
    ]
  }
}
*/


function fibonacci($n)
{
    $numbers = [1,1];
    for($i=0;$i<$n-2;$i++)
    {
        $last = count($numbers);
        $numbers[] = $numbers[$last-1] + $numbers[$last-2];
    }
    /*valor n y n-1*/
    $valores['valor n - 1'] = $numbers[$n-2];
    $valores['valor n'] = $numbers[$n-1];
    return $valores;
}
function formatResponse($code, $Msg, $data, $encode)
{
    $return = array();
    $status = array();
    $response = array();

    $status['code'] = $code;
    $status['message'] = $Msg;


    $response['count'] = count($data);
    $response['data'] = $data;

    $return['status'] = $status;
    $return['response'] = $response;
    if($encode == 1)
        return json_encode($return, JSON_UNESCAPED_UNICODE);
    elseif ($encode == 2) {
        return json_encode($return, JSON_UNESCAPED_SLASHES);
    }

}


$app->get('/fibonacci', function (Request $request, Response $response) {
    $headers = apache_request_headers();
    $numero = $headers['numero'];
    $Msg = 'Función fibonacci';
    if (is_numeric($numero))
    {
        $result = fibonacci($numero);
        $code = COD_OK;
    }
    else {
        $code = COD_ERROR_NN;
        $data['message'] = 'Y valor ingresado no es numérico';
        $result = $data;
    }

    $enconde = 1;
    $response = formatResponse($code, $Msg, $result, $enconde);

    return $response;
});


$app->run();

?>
