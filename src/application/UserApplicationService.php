<?php
/**
 * Created by PhpStorm.
 * User: anagam
 * Date: 03/07/2015
 * Time: 17:55
 */

namespace application;
use domain\model\User;

/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 20/10/15
 * Time: 13:25
 */
class UserApplicationService
{
    private $repository;

    /**
     * UserApplicationService constructor.
     */
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function createUser($name, $age)
    {
        $this->repository->save(User::create($name, $age));
    }

}