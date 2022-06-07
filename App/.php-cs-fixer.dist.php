<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('view')
    ->exclude('vendor')
    ->in(__DIR__)
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        //'declare_strict_types' => true,
    ])
    ->setFinder($finder)
;
