<?php

namespace App\Enums;

enum RecurringInterval: string
{
    case daily = 'daily';
    case weekly = 'weekly';
    case biweekly = 'biweekly';
    case monthly = 'monthly';
    case yearly = 'yearly';
}
