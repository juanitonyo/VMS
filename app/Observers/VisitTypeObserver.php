<?php

namespace App\Observers;

use App\Models\VisitTypes;
use Illuminate\Http\Request;

class VisitTypeObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function creating(VisitTypes $visitTypes): void
    {
        $visitTypes->buildingType = $this->request->buildingType['value'];
    }
    /**
     * Handle the VisitTypes "created" event.
     */
    public function created(VisitTypes $visitTypes): void
    {
        //
    }

    /**
     * Handle the VisitTypes "updated" event.
     */
    public function updated(VisitTypes $visitTypes): void
    {
        //
    }

    /**
     * Handle the VisitTypes "deleted" event.
     */
    public function deleted(VisitTypes $visitTypes): void
    {
        //
    }

    /**
     * Handle the VisitTypes "restored" event.
     */
    public function restored(VisitTypes $visitTypes): void
    {
        //
    }

    /**
     * Handle the VisitTypes "force deleted" event.
     */
    public function forceDeleted(VisitTypes $visitTypes): void
    {
        //
    }
}
