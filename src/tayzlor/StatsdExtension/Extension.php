<?php
/**
 * @copyright 2014 Graham Taylor
 * @license MIT
 */

namespace tayzlor\StatsdExtension;

use Symfony\Component\Config\FileLocator,
  Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition,
  Symfony\Component\DependencyInjection\ContainerBuilder,
  Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

use Behat\Behat\Extension\ExtensionInterface;

/**
 * A StatsD extension for Behat
 *
 * @author Graham Taylor
 */
class Extension implements ExtensionInterface
{
  /**
   * {@inheritdoc}
   */
  public function load(array $config, ContainerBuilder $container)
  {
    $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/services'));
    $loader->load('core.xml');

    if (isset($config['host'])) {
      $container->setParameter('behat.statsd.host', rtrim($config['host'], '/'));
    }
    if (isset($config['port'])) {
      $container->setParameter('behat.statsd.port', $config['port']);
    }
    if (isset($config['namespace'])) {
      $container->setParameter('behat.statsd.namespace', $config['namespace']);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(ArrayNodeDefinition $builder)
  {
    $builder->
      children()->
      scalarNode('host')->
      defaultNull()->
      end()->
      scalarNode('port')->
      defaultValue('8125')->
      end()->
      scalarNode('namespace')->
      defaultValue('')->
      end()->
      end()->
      end();
  }

  /**
   * {@inheritdoc}
   */
  public function getCompilerPasses()
  {
    return array();
  }
}
