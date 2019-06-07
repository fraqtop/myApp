<?php

namespace App\Models\Football;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Mixins\UpdatesFromAPI;


/**
 * App\Models\Football\Team
 *
 * @property int $id
 * @property string $name
 * @property string $shortName
 * @property string $logoURL
 * @property string $tla
 * @property string $site
 * @property string $founded
 * @property string $colors
 * @property string $stadium
 * @property \Illuminate\Support\Carbon $lastUpdated
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Football\Player[] $players
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereColors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereFounded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereLogoURL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereStadium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team whereTla($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Football\Standings[] $standings
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Football\Team query()
 */
class Team extends Model
{
    use UpdatesFromAPI;

    public $incrementing = false;
    public $timestamps = false;
    protected $dates = ['lastUpdated'];
    protected $guarded = [];
    private $nationalities;

    public static function boot()
    {
        parent::boot();
        static::saving(function (Team $team){
            $team->lastUpdated = $team->freshTimestamp();
        });
        static::creating(function (Team $team){
           $team->lastUpdated = Carbon::create()->setTimestamp(0);
        });
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'teamId');
    }

    public function standings()
    {
        return $this->belongsToMany(Standings::class);
    }

    private function getNationalities()
    {
        if (!$this->nationalities){
            $this->nationalities = Location::all();
        }
        return $this->nationalities;
    }

    private function getLocationId($locationName)
    {
        if (!$locationName){
            return null;
        }
        $location = $this->getNationalities()->where('name', $locationName)->first();
        if (!$location){
            $locationName = str_replace(' Islands', '', $locationName);
            $locationName = str_replace(' ', '-', $locationName);
            $location = $this->getNationalities()
                ->where('name', $locationName)
                ->first();
        }
        if (!$location){
            $location = Location::create(['name' => $locationName]);
            $this->nationalities->push($location);
        }
        return $location->id;
    }

    public function updateSquad(array $newSquad)
    {
        foreach ($newSquad as $member) {
            if (!$player = Player::find($member->id)){
                $this->createMember($member);
            }
            else{
                $player->teamId = $this->id;
                $player->save();
            }
        }
        unset($this->nationalities);
    }

    private function createMember($playerData)
    {
        $birthDate = $playerData->dateOfBirth === null ? null : Carbon::createFromTimeString($playerData->dateOfBirth);
        if (!$playerData->position and $playerData->role === 'PLAYER') {
            $playerData->position = 'Universal';
        }
        $this->players()->create([
            'id' => $playerData->id,
            'name' => $playerData->name,
            'birth' => $birthDate,
            'position' => $playerData->position,
            'nationalityId' => $this->getLocationId($playerData->nationality),
            'birthCountryId' => $this->getLocationId($playerData->countryOfBirth)
        ]);
    }

    public function getLastUpdateDate(): \DateTime
    {
        return $this->lastUpdated;
    }


}