# Useful commands for the WordPress NAU theme.
#

SHELL := /bin/bash

# configure Make default goal. If you run "$ make" it will print the help target.
.DEFAULT_GOAL := help

# current makefile directory
ROOT_DIR:=$(shell dirname $(realpath $(firstword $(MAKEFILE_LIST))))

# Optional variables, change values using:
# make FOO="BAR"

# Generates a help message. Borrowed from https://github.com/pydanny/cookiecutter-djangopackage.
help: ## Display this help message
	@echo "Please use \`make <target>' where <target> is one of"
	@perl -nle'print $& if m{^[\.a-zA-Z0-9_-]+:.*?## .*$$}' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m  %-25s\033[0m %s\n", $$1, $$2}'

build: ## Build theme like scss to css
	@cd ${ROOT_DIR}
	@echo "Build docker image for compile theme"
	@docker build -t nau-wp-nau-theme-builder .
	@echo "Run theme compilation inside docker container"
	@docker run -v `pwd`:/usr/src/app nau-wp-nau-theme-builder bash -c 'npm install; gulp build'

update_translations: ## Update strings to be translated
	@cd ${ROOT_DIR}
	@find . -name "*.php" -print0 | xargs -0 xgettext --keyword=nau_trans --language=PHP --add-comments --sort-output -o languages/messages.pot
	@msgmerge --update languages/pt/messages.po languages/messages.pot
	@msgmerge --update languages/en/messages.po languages/messages.pot
	@rm languages/messages.pot

compile_translations: ## Compile .mo files into .po files
	@cd ${ROOT_DIR}
	@msgfmt --output-file=languages/pt_PT.mo languages/pt/messages.po
	@msgfmt --output-file=languages/en_GB.mo languages/en/messages.po
 
