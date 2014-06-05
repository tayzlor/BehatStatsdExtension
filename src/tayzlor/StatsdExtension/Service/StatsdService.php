<?php

namespace tayzlor\StatsdExtension\Service;
use Domnikl\Statsd\Client;

/**
 * StatsD service
 *
 */
class StatsdService
{

  /**
   * @var \Client $client
   */
  private $client;

  /**
   * Constructor
   *
   * @param \Domnikl\Statsd\Client $client
   */
  public function __construct(Client $client)
  {
    $this->client = $client;
  }
}
