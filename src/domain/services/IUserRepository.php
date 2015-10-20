<?php
/**
 * Created by IntelliJ IDEA.
 * User: christian
 * Date: 20/10/15
 * Time: 13:22
 */
namespace domain\services;

use domain\model\User;

interface IUserRepository
{
    public function save(User $entity);

    public function find($entityId);

    public function truncateDb();

    public function startTransaction();

    public function rollbackTransaction();
}