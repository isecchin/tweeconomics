<?php
namespace Tweeconomics;

use Illuminate\Foundation\Application as IlluminateApplication;

/**
 * Laravel's Application class tweaked to fit
 * the Tweeconomics particularities.
 *
 * Application
 *
 * @package Tweeconomics
 * @author  Ian Miranda  <iansecchin@poli.ufrj.br>
 */
class Application extends IlluminateApplication
{
    /**
     * Get the path to the application source directory.
     * Overrinding method to replace Laravel's hardcoded structure.
     *
     * @param  string  $path Optionally, a path to append to the app path
     * @return string
     */
    public function path($path = '')
    {
        return $this->basePath .
            DIRECTORY_SEPARATOR .
            'src' .
            ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
