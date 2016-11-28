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
    public static function get()
    {
        return new UserResource();
    }
    public function add($app)
    {
        $app->get(
            '/hello/{name}',
            function ($_, $_, $args) {
                $name = $args['name'];
                echo "Hello, $name";
            }
        );
        $app->post(
            '/user', function ($request, $response, $_) {
            $data = $request->getParsedBody();

            $service = new UserApplicationService();
            $userId = $service->createUser($data["name"], $data["age"]);

            $obj = new \stdClass();
            $obj->userId = $userId;
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withJson($obj);
        }
        );
    }
}
