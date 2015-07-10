<?php
namespace resources;
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
        $app->get('/hello/:name', function ($name) {
            echo "Hello, $name";
        });

        //TODO: implement access to real service
    }

}
