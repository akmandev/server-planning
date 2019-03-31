<?php

namespace OzanAkman\ServerPlanner;

/**
 * Class Resources describes an immutable value object that represents computational resources like CPU, HDD.
 */
class Resources
{
    /**
     * Capacity of the CPU.
     * @var int
     */
    private $cpu;

    /**
     * Capacity of the RAM.
     * @var int
     */
    private $ram;

    /**
     * Capacity of the HDD.
     * @var int
     */
    private $hdd;

    public function __construct(int $cpu, int $ram, int $hdd)
    {
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
    }

    /**
     * Returns the resource each capacity of which is reduced by amount of corresponding
     * capacity of given resource.
     * @param Resources $resources
     * @return Resources
     */
    public function reducedBy(Resources $resources)
    {
        return new Resources(
            $this->cpu - $resources->cpu,
            $this->ram - $resources->ram,
            $this->hdd - $resources->hdd
        );
    }

    /**
     * Checks if *all* capacities are greater than those of given Resource.
     * @param Resources $resources
     * @return bool
     */
    public function isGreaterOrEqualTo(Resources $resources): bool
    {
        return $this->cpu >= $resources->cpu
            && $this->ram >= $resources->ram
            && $this->hdd >= $resources->hdd;
    }
}
