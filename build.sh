#!/bin/bash -e
cp build/patches/SqlServerAdapter.php vendor/robmorgan/phinx/src/Phinx/Db/Adapter/SqlServerAdapter.php
. build/scripts/migrate_up.sh
#comment
. test.sh
