<?php

namespace App\Repository;

use Prettus\Repository\Eloquent\BaseRepository;

class RegistrationFormRepository extends BaseRepository {

    function model()
    {
        return "App\\Models\\RegistrationForm";
    }
}