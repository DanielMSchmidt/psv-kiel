#!/bin/sh

cd ../psv-theme/ && vagrant up && cd ../psv-wordpress
scp -r vagrant@10.0.0.87:/var/www/wordpress . && rm -R wordpress/wp-content/uploads/*
#mv -f wordpress/* .
rm -R wordpress
cd ../psv-theme/ && vagrant halt && cd ../psv-wordpress
