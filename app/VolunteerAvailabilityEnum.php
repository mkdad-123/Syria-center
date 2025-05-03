<?php

namespace App;

enum VolunteerAvailabilityEnum :string
{
    case Full_Time = 'full_time';
    case Part_time = 'part_time';
    case Weekends = 'weekends';
}
