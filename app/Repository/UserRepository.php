<?php

namespace App\Repository;

use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository {

    function model()
    {
        return "App\\Models\\User";
    }
}