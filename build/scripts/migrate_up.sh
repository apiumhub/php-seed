#!/usr/bin/env bash
config=${1:-local}
php vendor/bin/phinx migrate -e $config
