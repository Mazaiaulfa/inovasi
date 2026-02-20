<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\KaryaTulis;
use App\Models\Proposal;
use App\Models\FinalKarya;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
