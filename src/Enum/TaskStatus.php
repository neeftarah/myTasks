<?php

namespace App\Enum;

enum TaskStatus: string
{
    case TODO = 'to_do';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
