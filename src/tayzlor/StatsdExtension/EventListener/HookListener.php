<?php
/**
 * @license MIT
 */

namespace tayzlor\StatsdExtension\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Behat\Behat\Event\ScenarioEvent,
  Behat\Behat\Event\StepEvent;

use tayzlor\StatsdExtension\Service\StatsdService;

/**
 * Hook event listener
 */
class HookListener implements EventSubscriberInterface
{
  private $statsdService;

  /**
   * Constructor
   *
   * @param StatsdService $statsdService
   */
  public function __construct($statsdService)
  {
    $this->statsdService = $statsdService;
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents()
  {
    return array(
      'afterScenario' => 'afterScenario',
      'beforeScenario' => 'beforeScenario'
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
    $feature = $scenario->getFeature();
    $url = $feature->getFile();
  }
}
