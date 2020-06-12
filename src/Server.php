<?php

namespace OzanAkman\ServerPlanner;

use LogicException;

/**
 * Class Server represents a server of specific type.
 */
class Server
{
    /**
     * @var ServerType
     */
    private ServerType $serverType;

    /**
     * Current available resources.
     * @var Resources
     */
    private Resources $currentResources;

    public function __construct(ServerType $serverType)
    {
        $this->serverType = $serverType;
        $this->currentResources = $serverType->getResources();
    }

    /**
     * Checks if the given virtual machine can fit into
     * @param VirtualMachine $virtualMachine
     * @return bool
     */
    public function canFit(VirtualMachine $virtualMachine): bool
    {
        return $this->serverType->getResources()->isGreaterOrEqualTo($virtualMachine->getResources());
    }

    /**
     * Checks if current resources allow to add the given virtual machine.
     * @param VirtualMachine $virtualMachine
     * @return bool
     */
    public function hasResourcesFor(VirtualMachine $virtualMachine): bool
    {
        return $this->currentResources->isGreaterOrEqualTo($virtualMachine->getResources());
    }

    /**
     * Reduces current resources by the amount required by the given virtual machine.
     * @param VirtualMachine $virtualMachine
     * @throws LogicException
     */
    public function addVirtualMachine(VirtualMachine $virtualMachine): void
    {
        // If this method is invoked without prior check for available resources,
        // we should not allow to add virtual machine.
        // This exception is expected to be thrown only when a developer messes with the code,
        // hence no need to catch it.
        if (!$this->hasResourcesFor($virtualMachine)) {
            throw new LogicException('Not allowed to add virtual machine: not enough resources.');
        }

        $this->currentResources = $this->currentResources->reducedBy($virtualMachine->getResources());
    }

    public function getCurrentResources(): Resources
    {
        return $this->currentResources;
    }
}
