<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AppController extends Controller
{

    public function getAudioFileList ()
    {
        return response()->json(scandir(public_path('audio')));
    }

    public function getAudioFile ($file)
    {
        $audioPath = public_path('audio');
        $matchedFiles = [];
        foreach (scandir($audioPath) as $audioFile)
        {
            if (Str::startsWith($audioFile, strtoupper($file)))
            {
                array_push($matchedFiles, $audioFile);
                break;
            }
            elseif (Str::contains($audioFile, strtoupper($file)))
            {
                array_push($matchedFiles, $audioFile);
                continue;
            }
        }
        return response()->file('audio/' . Arr::random($matchedFiles));
    }
}
