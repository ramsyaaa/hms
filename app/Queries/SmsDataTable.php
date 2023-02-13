<?php

namespace App\Queries;

use App\Models\Sms;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SmsDataTable
 */
class SmsDataTable
{
    /**
     * @return Builder
     */
    public function get()
    {
        /** @var Builder $query */
        $query = Sms::whereHas('sendBy')->with('user', 'sendBy')->select('sms*');

        /** @var User $user */
        $user = Auth::user();
        if (! $user->hasRole('Admin')) {
            $query->where('send_to', $user->id)->orwhere('send_by', $user->id);
        }

        return $query->select('sms.*');
    }
}
