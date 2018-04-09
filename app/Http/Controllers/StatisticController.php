<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;

class StatisticController extends Controller
{
    public function show(User $user)
    {
        $chartsData = Comment::query()->addSelect(DB::raw('SUM(workTime) as hours'))
                        ->addSelect(DB::raw('DATE(created_at) as day'))
                        ->where(['user_id' => $user->id])
                        ->whereBetween('created_at', [
                            $from = request()->get('from', Carbon::now()->subWeek()->toDateString()),
                            $to   = request()->get('to', Carbon::today()->toDateString())
                        ]);
        if (request()->exists('project')) {
            $chartsData = $chartsData->where('project_id', request('project'));
        }

        $chartsData = $chartsData->groupBy('day')->orderBy('day')->get();
        $chart = \Charts::multi('line', 'material')
                       ->title("Timeline {$user->name} from $from to $to ")
                       ->dimensions(0, 400) // Width x Height
                       ->dataset("Timeline {$user->name}", $chartsData->pluck('hours'))
                       ->labels($chartsData->pluck('day'));

        $user->load(['projects', 'comments' => function ($q) use ($from, $to) {
            /** @var Builder $q */
            $q->whereBetween('created_at', [$from, $to]);

            if (request()->exists('project')) {
                $q->where('project_id', request('project'));
            }
        }]);

        return view('statistics.show', compact('chart', 'user'));
    }
}
