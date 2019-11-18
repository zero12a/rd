#!/bin/bash

echo Go Logger Watcher!

cd /data/www/r.d/

/usr/local/php/bin/php ./predis_watcher.php > /dev/null 2>&1 &
