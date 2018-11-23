<?php

namespace Tweeconomics\Controllers;

use Tweeconomics\Controllers\BaseController;
use Tweeconomics\Models\Company;
use Tweeconomics\Models\Sentiment;

/**
 * Controller class for the Dashboard
 *
 * Dashboard
 *
 * @package Tweeconomics
 * @author  Ian Miranda  <iansecchin@poli.ufrj.br>
 */
class Dashboard extends BaseController
{
    /**
     * An associative array with the view names.
     *
     * @var array
     */
    protected $views = [
        'index' => 'dashboard'
    ];

    /**
     * Displays the dashboard of a given
     * company.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $additionalData = [
            'company'    => Company::find($id),
            'sentiments' => Sentiment::whereIn('id', [1, 2, 3])->get()
        ];

        return $this->renderView('index', $additionalData);
    }
}
