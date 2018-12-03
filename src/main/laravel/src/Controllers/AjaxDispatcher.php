<?php

namespace Tweeconomics\Controllers;

use Carbon\Carbon;
use DB;
use Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Tweeconomics\Models\Sentiment;

/**
 * Controller class for general AJAX calls
 *
 * AjaxDispatcher
 *
 * @package Tweeconomics
 * @author  Ian Miranda  <iansecchin@poli.ufrj.br>
 */
class AjaxDispatcher extends Controller
{
    /**
     * Gets the date the first tweet was analyzed.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function getInitialDate(Request $request)
    {
        $date = DB::table('analyzed_tweets')
            ->select(
                DB::raw(
                    "CONVERT_TZ(
                        MIN(posted_at),
                        'UTC',
                        'America/Sao_Paulo'
                    ) AS initial_date"
                )
            )
            ->first()
            ->initial_date;

        $date = Carbon::parse($date);

        return Response::json(
            [
                'success' => true,
                'data'    => [
                    'date' => $date->formatLocalized(trans('utils.date_format'))
                ]
            ]
        );
    }

    /**
     * Gets the total number of analyzed tweets
     * from the given company.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function getTotalTweets(Request $request)
    {
        $results = DB::table('analyzed_tweets')
            ->select(
                DB::raw(
                    "count(*) AS number_of_tweets,
                    CASE
                        WHEN sentiment_id = 0 THEN 1
                        WHEN sentiment_id = 4 THEN 3
                        ELSE sentiment_id
                    END AS sentiment"
                )
            )
            ->where('company_id', $request->companyId)
            ->groupBy(['company_id', 'sentiment'])
            ->get();

        $sentiments = Sentiment::whereIn('id', [1, 2, 3])->get();

        $data = [];
        foreach ($sentiments as $sentiment) {
            $total = number_format(
                $results->where('sentiment', $sentiment->getKey())
                    ->first()
                    ->number_of_tweets,
                0,
                trans('utils.decimal_separator'),
                trans('utils.thousands_separator')
            );

            $data[strtolower($sentiment->label)] = $total;
        }

        return Response::json(
            [
                'success' => true,
                'data'    => $data
            ]
        );
    }

    /**
     * Gets the data from the given company between
     * the desired dates withing the given interval.
     *
     * @param int            $companyId
     * @param \Carbon\Carbon $from
     * @param \Carbon\Carbon $to
     * @param int            $interval
     *
     * @return void
     */
    private function _getData($companyId, $from, $to, $interval)
    {
        $results = DB::table('analyzed_tweets')
            ->select(
                DB::raw(
                    "count(*) AS number_of_tweets,
                    CASE
                        WHEN sentiment_id = 0 THEN 1
                        WHEN sentiment_id = 4 THEN 3
                        ELSE sentiment_id
                    END AS sentiment,
                    CONVERT_TZ(
                        FROM_UNIXTIME(
                            FLOOR(
                                UNIX_TIMESTAMP(posted_at) / ($interval)
                            ) * ($interval)
                        ),
                        'UTC',
                        'America/Sao_Paulo'
                    ) AS time_block"
                )
            )
            ->where('company_id', $companyId)
            ->whereBetween('posted_at', [$from, $to])
            ->groupBy(
                [
                    "company_id",
                    "sentiment",
                    "time_block"
                ]
            )
            ->orderBy("time_block")
            ->get();

        $sentiments = Sentiment::whereIn('id', [1, 2, 3])->get();
        $sentimentMapper = [];
        foreach ($sentiments as $sentiment) {
            $sentimentMapper[$sentiment->getKey()] = strtolower($sentiment->label);
        }

        $data = $results
            ->groupBy('time_block')
            ->transform(
                function ($item, $key) use ($sentimentMapper) {
                    $item->transform(
                        function ($i, $k) use ($sentimentMapper) {
                            $i->sentiment = $sentimentMapper[$i->sentiment];
                            return $i;
                        }
                    );

                    $timeBlockData = $item
                        ->pluck('number_of_tweets', 'sentiment')
                        ->prepend($item->first()->time_block, 'date')
                        ->toArray();

                    // Zeroes entries with no data
                    foreach ($sentimentMapper as $sentiment) {
                        if (! isset($timeBlockData[$sentiment])) {
                            $timeBlockData[$sentiment] = 0;
                        }
                    }

                    return $timeBlockData;
                }
            );

        return Response::json(
            [
                'success' => true,
                'data'    => $data
            ]
        );
    }

    /**
     * Gets the daily data from the company.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function getDailyData(Request $request)
    {
        $from = Carbon::now()->subDay();
        $to = Carbon::now();
        $interval = 5*60;

        return $this->_getData($request->companyId, $from, $to, $interval);
    }

    /**
     * Gets the weekly data from the company.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function getWeeklyData(Request $request)
    {
        $from = Carbon::now()->subWeek();
        $to = Carbon::now();
        $interval = 5*60;

        return $this->_getData($request->companyId, $from, $to, $interval);
    }

    /**
     * Gets the monthly data from the company.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function getMonthlyData(Request $request)
    {
        $from = Carbon::now()->subMonth();
        $to = Carbon::now();
        $interval = 60*60;

        return $this->_getData($request->companyId, $from, $to, $interval);
    }

    /**
     * Gets the yearly data from the company.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function getYearlyData(Request $request)
    {
        $from = Carbon::now()->subYear();
        $to = Carbon::now();
        $interval = 24*60*60;

        return $this->_getData($request->companyId, $from, $to, $interval);
    }
}
