<?php

namespace App\Enums;

enum TaskPriority: int {
    case LOW = 1;
    case NORMAL = 2;
    case MEDIUM = 3;
    case HIGH = 4;
    case URGENT = 5;
}
