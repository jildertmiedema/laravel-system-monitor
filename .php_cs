<?php

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules(array(
        '@PSR2' => true,
        'array_syntax' => array('syntax' => 'short'),
        'combine_consecutive_unsets' => true,
        // one should use PHPUnit methods to set up expected exception instead of annotations
        'no_extra_consecutive_blank_lines' => array('break', 'continue', 'extra', 'return', 'throw', 'use', 'parenthesis_brace_block', 'square_brace_block', 'curly_brace_block'),
        'no_useless_else' => true,
        'no_useless_return' => true,
        'ordered_class_elements' => true,
        'return_type_declaration' => true,
        'ordered_imports' => true,
        'php_unit_strict' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'psr4' => true,
        'declare_strict_types' => true,
        'strict_comparison' => true,
        'strict_param' => true,
    ))
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->exclude('tests/Fixtures')
            ->in(__DIR__)
    )
;