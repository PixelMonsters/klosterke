.PHONY: build shell, test

build:
	docker build -t klosterke-php .

shell:
	docker run --rm -it -v "$(PWD):/app" klosterke-php

test:
	docker run --rm -it -v "$(PWD):/app" klosterke-php php vendor/bin/kahlan