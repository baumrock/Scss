<?php

namespace ProcessWire;

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;

/**
 * @author Bernhard Baumrock, 20.10.2022
 * @license Licensed under MIT
 * @link https://www.baumrock.com
 */
class Scss extends WireData implements Module
{
  /** @var Compiler */
  private $compiler;

  /**
   * Compile input file to output file
   *
   * $output can be left empty, then it will take the input file and replace
   * the .scss ending with .css ending!
   *
   * $style can either be 'compressed' or 'expanded'
   */
  public function compile(
    string $input,
    string $output = null,
    string $style = 'compressed',
  ): void {
    // auto-create output path if no custom one is set
    if (!$output) $output = substr($input, 0, -4) . "css";

    // get scss content of input file
    $content = $this->wire->files->fileGetContents($input);

    // get compiler and set output style
    $compiler = $this->compiler();
    $compiler->setOutputStyle($style);

    // write CSS to file
    $css = $compiler->compileString($content)->getCss();
    $this->wire->files->filePutContents($output, $css);
  }

  /**
   * Compile input file to output file if any watched file is newer than output
   *
   *
   * Returns TRUE if file has been compiled
   * and FALSE if nothing was done
   */
  public function compileIfChanged(
    string $input,
    array $watch,
    string $output = null,
    string $style = 'compressed',
  ): bool {
    if (!is_file($input)) throw new WireException("$input not found");

    // auto-create output path if no custom one is set
    if (!$output) $output = substr($input, 0, -4) . "css";

    // get modified timestamp of output file
    $mCSS = 0;
    if (is_file($output)) $mCSS = filemtime($output);

    // loop all watched files
    // as soon if we find one that is newer than the output we compile new
    foreach ($watch as $file) {
      if (filemtime($file) <= $mCSS) continue;
      $this->compile($input, $output, $style);
      return true;
    }
    return false;
  }

  /**
   * Get the compiler instance
   */
  public function compiler(): Compiler
  {
    if ($this->compiler) return $this->compiler;
    require_once __DIR__ . "/vendor/autoload.php";
    $this->compiler = new Compiler();
    return $this->compiler;
  }

  /**
   * Watch core .scss files and auto-compile .css files
   */
  public function watchCore()
  {
    $path = $this->wire->config->paths->wire;
    $opt = ['extensions' => ['scss']];
    $this->compiler()->setOutputStyle(OutputStyle::COMPRESSED);
    foreach ($this->wire->files->find($path, $opt) as $scss) {
      $css = substr($scss, 0, -4) . "css";
      if (!is_file($css)) continue;
      if (filemtime($css) >= filemtime($scss)) continue;
      $content = $this->wire->files->fileGetContents($scss);
      $this->wire->files->filePutContents(
        $css,
        $this->compiler()->compileString($content)->getCss()
      );
    }
  }

  public function __debugInfo()
  {
    return [
      'compiler' => $this->compiler(),
    ];
  }
}
