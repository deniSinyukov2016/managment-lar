<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\RememberNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendRememberNotification extends Command
{
    protected $signature = 'user-notify:forget-report';
    protected $description = 'Send notification all people who forgot delay report';

    public function handle()
    {
        $users = User::query()->whereDoesntHave('comments', function ($q) {
            /** @var \Illuminate\Database\Query\Builder $q */
            $q->where(\DB::raw('DATE(created_at)'), Carbon::now()->toDateString())->toSql();
        })->where('is_admin', false)->get();

        \Notification::send($users, new RememberNotification);
    }
}
