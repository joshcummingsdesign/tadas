<?php

$finder = PhpCsFixer\Finder::create()
  ->exclude(['vendor'])
  ->in(__DIR__)
;

$config = new PhpCsFixer\Config();

return $config->setRules([
  '@PSR2' => true,
  'braces' => [
    'position_after_anonymous_constructs' => 'same',
    'position_after_control_structures' => 'same',
    'position_after_functions_and_oop_constructs' => 'same',
  ],
])
  ->setIndent("  ")
  ->setFinder($finder)
  ;
