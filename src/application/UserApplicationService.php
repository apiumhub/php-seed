<?php
/**
 * Created by PhpStorm.
 * User: anagam
 * Date: 03/07/2015
 * Time: 17:55
 */

namespace application;
use domain\model\User;
use infrastructure\repository\UserRepository;

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
    public function __construct($repository=NULL)
    {
        if ($repository==NULL)
            $repository=new UserRepository();
        $this->repository = $repository;
    }

    public function createUser($name, $age)
    {
        $user = User::create($name, $age);
        $this->repository->save($user);
        return $user->getUserId();
    }

}