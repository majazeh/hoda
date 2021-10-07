<?php

namespace App\Models;


class FrequencyCreator
{
    public function __construct(
        private String $title,
        private int $startAt,
        private bool $qualitative = false,
        private int $coefficient = 1,
        private String $frequencyType,
        private int $frequencyCount,
        private $frequencyValue,
    )
    {

    }

    public static function build(array $data): FrequencyCreator
    {
        return new FrequencyCreator(
            $data['title'],
            $data['start_at'],
            // ()
        );
    }

    private static function getFreQuencyValue(String $type, array $data){
        switch($type){
            case 'weekly' : return (int) $data['weekday'];
            case 'monthly' : return ctype_digit($data['month_day']) ? (int) $data['month_day'] : $data['month_day'];
            default : return null;
        }
    }
}
