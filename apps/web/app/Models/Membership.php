<?php

namespace Pfy\Web\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Jetstream\Membership as JetstreamMembership;

class Membership extends JetstreamMembership
{
    use HasUuids;
}
