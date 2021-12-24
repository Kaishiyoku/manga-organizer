<?php

namespace App\ViewModels;

use Carbon\Carbon;

class LatestEntry
{
    /**
     * @var Carbon
     */
    public $createdAt;

    /**
     * @var string
     */
    public $name;

    /**
     * @param Carbon $createdAt
     * @param string $name
     */
    public function __construct(Carbon $createdAt, string $name)
    {
        $this->createdAt = $createdAt;
        $this->name = $name;
    }
}
