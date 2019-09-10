
<?php
$finder = \PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude([
        'vendor'
    ])
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);
return \PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'no_unused_imports' => true,
    ])
    ->setFinder($finder);
