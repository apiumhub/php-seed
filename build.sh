#!/bin/bash -e
cp build/patches/SqlServerAdapter.php vendor/robmorgan/phinx/src/Phinx/Db/Adapter/SqlServerAdapter.php
rm -fr vendor/squizlabs/php_codesniffer/CodeSniffer/Standards/Zend/Sniffs/NamingConventions/ValidVariableNameSniff.php
. build/scripts/migrate_up.sh $1
#comment
. test.sh
./vendor/phing/phing/bin/phing inspect
