<?php

namespace App\Models\Football;

use Carbon\Carbon;

trait UpdatesFromAPI
{
    public function isOutdated(string $lastUpdate)
    {
        $lastUpdate = Carbon::createFromTimeString($lastUpdate);
        if ($lastUpdate > $this->lastUpdated) {
            return true;
        }
        return false;
    }

    public function isNeverUpdated()
    {
        return $this->lastUpdated == Carbon::createFromTimestamp(0);
    }
}