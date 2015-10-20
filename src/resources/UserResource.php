<?php
namespace resources;
use application\UserApplicationService;

/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 23/06/15
 * Time: 12:12
 */
class UserResource
{
    public static function add($app)
    {
        $app->get(
            '/hello/:name', function ($name) {
            echo "Hello, $name";
            }
        );
        $app->post(
            '/user', function () use ($app) {
                $json = $app->request->getBody();
                $data = json_decode($json, true);
                $service = new UserApplicationService();
                $userId=$service->createUser($data["name"], $data["age"]);
                $app->response()['Content-Type'] = 'application/json';
                $app->response()->body(
                    '{"userId": "'.$userId.'"}'
                );
            }
        );
    }
}
