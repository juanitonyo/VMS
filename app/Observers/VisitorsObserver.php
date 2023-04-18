<?php

namespace App\Observers;

use App\Models\Visitors;
use Illuminate\Http\Request;

class VisitorsObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Handle the Building "creating" event.
     */
    public function creating(Visitors $visitors): void
    {
        $visitors->refId = $this->request->refId['value'];
    }
    /**
     * Handle the Visitors "created" event.
     */
    public function created(Visitors $visitors): void
    {
        //
    }

    /**
     * Handle the Visitors "updated" event.
     */
    public function updated(Visitors $visitors): void
    {
        //
    }

    /**
     * Handle the Visitors "deleted" event.
     */
    public function deleted(Visitors $visitors): void
    {
        //
    }

    /**
     * Handle the Visitors "restored" event.
     */
    public function restored(Visitors $visitors): void
    {
        //
    }

    /**
     * Handle the Visitors "force deleted" event.
     */
    public function forceDeleted(Visitors $visitors): void
    {
        //
    }
}
