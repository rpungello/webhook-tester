<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    public function __invoke()
    {
        $status = Artisan::call('status');
        if ($status === Command::SUCCESS) {
            return response('Up');
        } else {
            return response('Down', Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
