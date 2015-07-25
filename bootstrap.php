<?php
require_once __DIR__.'/vendor/autoload.php';

use WordSelector\WordSelector;

$container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
$loader = new \Symfony\Component\DependencyInjection\Loader\YamlFileLoader(
    $container,
    new \Symfony\Component\Config\FileLocator(__DIR__.'/config')
);
$loader->load('application.yml');

/* @var $wordSelector WordSelector */
$wordSelector = $container->get('WordSelector');
$word = $wordSelector->getRandomWord(10, 'en');

echo $word . "\n";
