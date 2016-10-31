#!/bin/bash
if [ -f "composer.json" ]; then
  composer install --optimize-autoloader
fi

apache2-foreground