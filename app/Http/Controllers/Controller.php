<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Trait untuk otorisasi
use Illuminate\Foundation\Bus\DispatchesJobs; // Trait untuk dispatch job
use Illuminate\Foundation\Validation\ValidatesRequests; // Trait untuk validasi request
use Illuminate\Routing\Controller as BaseController; // Controller dasar Laravel

class Controller extends BaseController
{
    // Menggunakan trait bawaan Laravel untuk otorisasi, job, dan validasi
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
