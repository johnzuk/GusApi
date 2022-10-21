<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in('./src')
    ->in('./tests');

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@Symfony' => true,
    '@Symfony:risky' => true,
    '@PHP80Migration' => true,
    '@PHP80Migration:risky' => true,
    'array_syntax' => ['syntax' => 'short'],
    'phpdoc_add_missing_param_annotation' => true,
    'linebreak_after_opening_tag' => true,
    'concat_space' => ['spacing' => 'one'],
    'phpdoc_summary' => false,
    'phpdoc_no_package' => false,
    'phpdoc_order' => true,
    'phpdoc_align' => true,
    'ordered_imports' => true,
    'native_function_invocation' => true,
    '@PSR12' => true,
    'strict_param' => true,
    'declare_strict_types' => true,
])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
