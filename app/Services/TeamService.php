<?php


namespace App\Services;

use App\Models\Football\Team;


class TeamService
{
    public function refresh($data)
    {
        $team = Team::firstOrNew(
            [
                'id' => $data->id
            ],
            [
                'name' => $data->name,
                'tla' => $this->extractDynamicValue($data, 'tla'),
                'site' => $this->extractDynamicValue($data, 'site'),
                'founded' => $this->extractDynamicValue($data, 'founded'),
                'colors' => $this->extractDynamicValue($data, 'colors'),
                'stadium' => $this->extractDynamicValue($data, 'venue')
            ]
        );
        if (!$team->logoURL){
            $team->logoURL = $data->crestUrl;
        }
        $team->save();
        return $team;
    }

    private function extractDynamicValue($object, string $attribute)
    {
        return isset($object->$attribute) ? $object->$attribute: null;
    }
}