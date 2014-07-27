#!/bin/sh

rm -R wordpress
cd ../psv-theme/ && vagrant up && cd ../psv-wordpress
scp -r vagrant@10.0.0.87:/var/www/wordpress .
cd ../psv-theme/ && vagrant halt && cd ../psv-wordpress