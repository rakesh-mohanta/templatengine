<?php
/**
 * Application documentation builder
 *
 * See http://github.com/fabpot/Sami
 *
 * To build doc, run:
 *     $ php vendor/sami/sami/sami.php render sami.config.php
 *
 * To update it, run:
 *     $ php vendor/sami/sami/sami.php update sami.config.php
 *
 */

use Sami\Sami;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in(__DIR__.'/src')
;

$options = array(
    'title'                => 'Template Engine',
    'build_dir'            => __DIR__.'/phpdoc',
    'cache_dir'            => __DIR__.'/../tmp/cache/templatengine',
    'default_opened_level' => 2,
);

return new Sami($iterator, $options);

// Endfile