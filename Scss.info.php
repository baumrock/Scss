<?php

namespace ProcessWire;

$info = [
  'title' => 'Scss',
  'version' => json_decode(file_get_contents(__DIR__ . "/package.json"))->version,
  'summary' => 'Module to compile CSS files from SCSS',
  'autoload' => false,
  'singular' => true,
  'icon' => 'css3',
  'requires' => [
    'PHP>=8.0',
  ],
];
