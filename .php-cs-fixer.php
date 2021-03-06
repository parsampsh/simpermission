<?php

$header = <<<EOF
This file is part of Simpermission.

Copyright 2021-2022 Parsa Shahmaleki <parsampsh@gmail.com>

Simpermission project is Licensed Under MIT.
For more information, please see the LICENSE file.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->files()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
    ->in(__DIR__.'/migrations')
    ->name('*.php');

return (new PhpCsFixer\Config)
    ->setUsingCache(true)
    ->setRiskyAllowed(true)
    ->setRules(array(
        'header_comment' => array('header' => $header),
    ))
    ->setFinder($finder);

