<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use DB;

class TrafficController extends Controller
{
    public function get(Request $request)
    {
        $from = Carbon::parse($request->input('dateFrom'));
        $to = Carbon::parse($request->input('dateTo'));
        if (!$from->diffInMinutes($to) || $from > $to) {
            $from = $to->clone()->subDays(6)->subMinutes(1);
        }
        $visits = DB::table('visits')
            ->selectRaw('DATE(created_at) as date, count(*) as visitsCount')
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('date')
            ->get();
        while ($from->diffInDays($to)) {
            $dateString = $from->toDateString();
            if (!$visits->contains('date', $dateString)) {
                $visits->add((object)[
                    'date' => $dateString,
                    'visitsCount' => 0
                ]);
            }
            $from->addDay();
        }
        $visits = $visits->sortBy('date');
        $xAxisLegend = $this->getXAxis($visits);
        return view('admin.traffic', [
            'visits' => $visits->map(function ($day){return $day->visitsCount;})->values()->toJson(),
            'xAxisLegend' => json_encode(array_values($xAxisLegend))
        ]);
    }

    private function getYAxis(int $count): array
    {
        $quarterCount = round($count / 4);
        return [$count, $quarterCount * 3, $quarterCount * 2, $quarterCount];
    }

    private function getXAxis(Collection $collection): array
    {
        $collectionCount = $collection->count();
        if ($collectionCount > 7) {
            $collection = $collection->nth(ceil($collectionCount / 7));
        }
        return $collection->map(function ($element){
            return preg_replace('/[\\d]{4}-([\\d]{2})-([\\d]{2})/ui', '$1.$2', $element->date);
        })->toArray();
    }
}
