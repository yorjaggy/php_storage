<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__ . '/utils.php';

return function (App $app) {
    $app->group('/micro_storage_i2t', function () use ($app) {
    $container = $app->getContainer();
    
        $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
            // Sample log message
            $container->get('logger')->info("Slim-Skeleton '/' route");

            // Render index view
            return $container->get('renderer')->render($response, 'index.phtml', $args);
        });

        $app->post('/image/', function ($req, $res, $args) {
            $data = json_decode($req->getBody());

            $cutil = new Utils();
            $urlFoto = $cutil -> save_image_in_server($data->base64);

            $rest_object = (object) [
                'filename' => $urlFoto
            ];
            
            return $res
                ->withHeader('Content-type', 'application/json')
                ->getBody()
                ->write(
                    json_encode(
                    $rest_object
                    )
                );
        });

        // $app->get('/image/[{name}]', function (Request $request, Response $response, array $args) {
        //     $filename = $args['name'];
            
        
        //     $image = file_get_contents("storage/".$filename.".jpg");
        //     header('Content-type: image/jpeg');
        //     $finfo = new finfo(FILEINFO_MIME_TYPE);
        //     #return $response->withHeader('Content-Type', 'content-type: ' . $finfo->buffer($image));
        //     echo $image;

        //});
    });
};
