<?php
/**
 * @license MIT
 */

namespace tayzlor;

/**
 * Generic autoloader
 *
 */
class Bootstrap
{
  /**
   * Load class
   *
   * @param string $class Class name
   */
  public static function autoload($class)
  {
    $file = str_replace(array('\\', '_'), '/', $class);
    $path = __DIR__ . '/src/' . $file . '.php';

    if (file_exists($path)) {
      include_once $path;
    }
  }
}

spl_autoload_register('tayzlor\Bootstrap::autoload');

if (! ini_get('date.timezone')) {
  date_default_timezone_set('Europe/London');
}
