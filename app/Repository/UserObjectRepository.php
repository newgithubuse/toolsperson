<?php

namespace App\Repository;

use Prettus\Repository\Eloquent\BaseRepository;

class UserPostEventRepository extends BaseRepository {

    function model()
    {
        return "App\\Models\\UserPostEvent";
    }
}