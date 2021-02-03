# Docker file with node and gulp js to compile sass files to css.
# This docker container is used by the wordpress devstack and the ansible deployment.
FROM node:14.15.4-buster

WORKDIR /usr/src/app

# Install app dependencies
# A wildcard is used to ensure both package.json AND package-lock.json are copied
# where available (npm@5+)
COPY package*.json ./

# Install gulp command line globally so the docker container could run gulp using command line.
RUN npm install --global gulp-cli

# Install all other npm packages required from the package*.json files.
RUN npm install
