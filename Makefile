#################################
Project:

## Install les vendor et node_modules (pour dev)
install:
	composer install
	yarn install

## Compile les assets automatiquement à chaque modification
watch:
	yarn watch

## Compile les assets pour la production
build:
	yarn build

#################################
.DEFAULT_GOAL := help

ifndef CI_JOB_ID
    # COLORS
    GREEN  := $(shell tput -Txterm setaf 2)
    YELLOW := $(shell tput -Txterm setaf 3)
    WHITE  := $(shell tput -Txterm setaf 7)
    RESET  := $(shell tput -Txterm sgr0)
    TARGET_MAX_CHAR_NUM=30
endif

help:
	@awk '/^[a-zA-Z\-_0-9]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")); helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf "${YELLOW}%-$(TARGET_MAX_CHAR_NUM)s${RESET} ${GREEN}%s${RESET}\n", helpCommand, helpMessage; \
		} \
		isTopic = match(lastLine, /^###/); \
		if (isTopic) { printf "\n%s\n", $$1; } \
	} { lastLine = $$0 }' $(MAKEFILE_LIST)

