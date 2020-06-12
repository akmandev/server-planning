<?php

namespace OzanAkman\ServerPlanner;

use Exception;

final class Calculator
{
    private array $servers = [];

    /**
     * @param ServerType $serverType
     * @param array $virtualMachines
     * @return int
     * @throws Exception
     */
    public function calculate(ServerType $serverType, array $virtualMachines)
    {
        if (empty($virtualMachines)) {
            return $this->countAndFlushServers();
        }

        $server = new Server($serverType);
        $this->servers[] = $server;

        foreach ($virtualMachines as $virtualMachine) {
            if (!$server->canFit($virtualMachine)) {
                throw new Exception('This virtual machine does not fit to server of the given type.');
            }

            if ($server->hasResourcesFor($virtualMachine)) {
                $server->addVirtualMachine($virtualMachine);
                array_shift($virtualMachines);
            } else {
                return $this->calculate($serverType, $virtualMachines);
            }
        }

        return $this->countAndFlushServers();
    }

    /**
     * @return int
     */
    private function countAndFlushServers()
    {
        $count = count($this->servers);
        $this->servers = [];

        return $count;
    }
}
