<?php

namespace OzanAkman\ServerPlanner;

class ServerType
{
    private Resources $resources;

    public function __construct(Resources $resources)
    {
        $this->resources = $resources;
    }

    /**
     * Returns resources available to a server of this type.
     * @return Resources
     */
    public function getResources() : Resources
    {
        return $this->resources;
    }
}
