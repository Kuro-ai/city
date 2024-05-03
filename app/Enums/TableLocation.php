<?php

namespace App\Enums;

enum TableLocation: string
{
    case Front = 'front';
    case Back = 'back';
    case Outside = 'outside';
    case Room = 'room';
}