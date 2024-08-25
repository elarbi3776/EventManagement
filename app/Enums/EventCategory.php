<?php

namespace App\Enums;

enum EventCategory: string
{
    case FESTIVAL = 'Festival';
    case CONFERENCE = 'Conference';
    case WORKSHOP = 'Workshop';
    case MEETUP = 'Meetup';
    case FORUM = 'Forum';
}
