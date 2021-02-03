#!/bin/bash -xe
#
# Build the theme shell script
#

# enter current script directory
dir=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
cd $dir

# build docker image for compile theme
docker build -t nau-wp-nau-theme-builder .

# Run theme compilation
docker run -v `pwd`:/usr/src/app nau-wp-nau-theme-builder gulp build
