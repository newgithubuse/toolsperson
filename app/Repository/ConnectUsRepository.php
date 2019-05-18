<?php

namespace App\Repository;

use Prettus\Repository\Eloquent\BaseRepository;

class ConnectUsRepository extends BaseRepository {

    function model()
    {
        return "App\\Models\\ConnectUs";
    }
}