<?php

namespace ProcessWire;

use ScssPhp\ScssPhp\Compiler;

/**
 * @author Bernhard Baumrock, 20.10.2022
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class Scss extends WireData implements Module
{
  /** @var Compiler */
  public $compiler;

  public static function getModuleInfo()
  {
    return [
      'title' => 'Scss',
      'version' => '1.0.0',
      'summary' => 'Module to compile CSS files from SCSS',
      'autoload' => false,
      'singular' => true,
      'icon' => 'css3',
    ];
  }

  public function init()
  {
    require_once __DIR__ . "/vendor/autoload.php";
    $this->compiler = new Compiler();
  }

  /**
   * Watch core .scss files and auto-compile .css files
   */
  public function watchCore()
  {
    $path = $this->wire->config->paths->wire;
    $opt = ['extensions' => ['scss']];
    foreach ($this->wire->files->find($path, $opt) as $scss) {
      $css = substr($scss, 0, -4) . "css";
      if (!is_file($css)) continue;
      if (filemtime($css) >= filemtime($scss)) continue;
      $content = $this->wire->files->fileGetContents($scss);
      $this->wire->files->filePutContents(
        $css,
        $this->compiler->compileString($content)->getCss()
      );
    }
  }

  public function __debugInfo()
  {
    return [
      'compiler' => $this->compiler,
    ];
  }
}
