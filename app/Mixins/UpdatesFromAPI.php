<?php

namespace App\Mixins;

use Carbon\Carbon;

trait UpdatesFromAPI
{
    public function isOutdated(string $lastUpdate)
    {
        $APILastUpdate = Carbon::createFromTimeString($lastUpdate);
        $DBLastUpdate = $this->getLastUpdateDate();
        if ($APILastUpdate > $DBLastUpdate) {
            return true;
        }
        return false;
    }

    public abstract function getLastUpdateDate(): \DateTime;
}