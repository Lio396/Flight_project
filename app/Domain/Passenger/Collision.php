<?php
namespace App\Domain\Passenger;

use App\Models\Passenger;
use Illuminate\Support\Facades\DB;

class Collision
{
    public string $text;
    public bool $colided = false;

}
