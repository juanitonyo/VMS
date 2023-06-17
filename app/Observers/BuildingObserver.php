<?php

namespace App\Observers;

use App\Models\Building;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BuildingObserver
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Handle the Building "creating" event.
     */
    public function creating(Building $building): void
    {
        $building->qr_id = Str::uuid();
    }
    /**
     * Handle the Building "created" event.
     */
    public function created(Building $building): void
    {
        //
    }

    /**
     * Handle the Building "updated" event.
     */
    public function updated(Building $building): void
    {
        //
    }

    /**
     * Handle the Building "deleted" event.
     */
    public function deleted(Building $building): void
    {
        //
    }

    /**
     * Handle the Building "restored" event.
     */
    public function restored(Building $building): void
    {
        //
    }

    /**
     * Handle the Building "force deleted" event.
     */
    public function forceDeleted(Building $building): void
    {
        //
    }
}
