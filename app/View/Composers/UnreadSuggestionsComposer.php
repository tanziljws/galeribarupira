<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class UnreadSuggestionsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Count unread suggestions (status = 'pending')
        $unreadCount = DB::table('suggestions')
            ->where('status', 'pending')
            ->count();
        
        $view->with('unreadSuggestionsCount', $unreadCount);
    }
}
