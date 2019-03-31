<?php

namespace OzanAkman\ServerPlanner;

class VirtualMachine
{
    /**
     * @var Resources
     */
    private $resources;

    public function __construct(Resources $resources)
    {
        $this->resources = $resources;
    }

    /**
     * Returns resources required by this virtual machine.
     * @return Resources
     */
    public function getResources() : Resources
    {
        return $this->resources;
    }
}
