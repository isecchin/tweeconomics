<?php

namespace Tweeconomics\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

use Tweeconomics\Exceptions\MisconfiguredViewsException;
use Tweeconomics\Models\Neighborhood;

/**
 * Base Controller class to be extended further
 *
 * BaseController
 *
 * @package Tweeconomics
 * @author  Ian Miranda  <iansecchin@poli.ufrj.br>
 */
abstract class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * An associative array with the view names.
     *
     * @var array
     */
    protected $views = [];

    /**
     * Data that will be passed to the view.
     *
     * @var array
     */
    protected $viewData = [];

    /**
     * Resets the viewData attribute and
     * sets the data that will be passed to
     * the view with the given value.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    protected function setViewData(array $data = [])
    {
        $this->viewData = $data;
    }

    /**
     * Appends the additionalData received
     * to the viewData attribute that will
     * be passed to the view.
     *
     * @param  array  $additionalData
     * @return \Illuminate\Http\Response
     */
    protected function addViewData(array $additionalData = [])
    {
        $this->viewData = array_merge($this->viewData, $additionalData);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->renderView('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $viewName
     * @param  array   $additionalData
     * @return \Illuminate\Http\Response
     */
    protected function renderView($viewName, array $additionalData = [])
    {
        if (! isset($this->views[$viewName])) {
            throw new MisconfiguredViewsException(
                'View "' . $viewName . '" not declared on controller.'
            );
        }

        $additionalData = array_merge(
            $additionalData,
            [
                'neighborhoods' => Neighborhood::orderBy('Label')->get()
            ]
        );

        $this->addViewData($additionalData);

        return view($this->views[$viewName], $this->viewData);
    }
}
