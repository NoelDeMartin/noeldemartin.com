<?php

namespace App\SemanticSEO\Experiments;

use Illuminate\Support\Carbon;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use NoelDeMartin\SemanticSEO\Types\CreativeWork;

class DCMotorSandbox extends CreativeWork
{
    public function __construct()
    {
        parent::__construct();

        $this->setAttributes(trans('seo.schema:dc_motor_sandbox'));
        $this->url('https://noeldemartin.github.io/DC-Motor-Sandbox/');
        $this->sameAs('https://github.com/NoelDeMartin/DC-Motor-Sandbox');
        $this->datePublished(Carbon::create(2018, 3, 2)->startOfDay());
        $this->author(NoelDeMartin::class);
        $this->creator(NoelDeMartin::class);
        $this->publisher(NoelDeMartinOrganization::class);
    }

    protected function getType()
    {
        return 'CreativeWork';
    }
}
