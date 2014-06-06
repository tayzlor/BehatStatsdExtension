<?php
/**
 * @license MIT
 */

namespace tayzlor\StatsdExtension\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Behat\Behat\Event\ScenarioEvent,
  Behat\Behat\Event\FeatureEvent,
  Behat\Behat\Event\StepEvent;

use tayzlor\StatsdExtension\Service\StatsdService;

/**
 * Hook event listener
 */
class HookListener implements EventSubscriberInterface
{
  /**
   * @var \Domnikl\Statsd\Client
   *
   * StatsD Client
   */
  private $statsdClient;

  /**
   * Tags
   *
   * @var array
   */
  private $tags;

  /**
   * Constructor
   *
   * @param \Domnikl\Statsd\Client $statsdClient
   * @param array $tags
   */
  public function __construct($statsdClient, array $tags)
  {
    $this->statsdClient = $statsdClient;
    $this->tags = $tags;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents()
  {
    return array(
      'beforeScenario' => 'beforeScenario',
      'afterScenario' => 'afterScenario',
      'beforeFeature' => 'beforeFeature',
      'afterFeature' => 'afterFeature'
    );
  }

  /**
   * After Scenario hook
   *
   * @param ScenarioEvent $event
   */
  public function afterScenario(ScenarioEvent $event)
  {
    $scenario = $event->getScenario();
    if (array_intersect($this->tags, $scenario->getTags())) {
      $this->statsdClient->endTiming($scenario->getTitle());
    }
  }

  /**
   * Before Scenario hook
   *
   * @param ScenarioEvent $event
   */
  public function beforeScenario(ScenarioEvent $event)
  {
    $scenario = $event->getScenario();
    if (array_intersect($this->tags, $scenario->getTags())) {
      $this->statsdClient->startTiming($scenario->getTitle());
    }
  }

  /**
   * After Feature hook
   *
   * @param FeatureEvent $event
   */
  public function afterFeature(FeatureEvent $event)
  {
    $feature = $event->getFeature();
    if (array_intersect($this->tags, $feature->getTags())) {
      $this->statsdClient->startTiming($feature->getTitle());
    }
  }

  /**
   * Before Feature hook
   *
   * @param FeatureEvent $event
   */
  public function beforeFeature(FeatureEvent $event)
  {
    $feature = $event->getFeature();
    if (array_intersect($this->tags, $feature->getTags())) {
      $this->statsdClient->startTiming($feature->getTitle());
    }
  }
}
