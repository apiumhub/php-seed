<?php

use Phinx\Migration\AbstractMigration;

class UserTable extends AbstractMigration
{
    public function change()
    {
        $table=$this->table("users");
        $table
            ->addColumn("userId", "string")
            ->addColumn("name", "text")
            ->addColumn("age", "integer")
            ->save();
    }
}
