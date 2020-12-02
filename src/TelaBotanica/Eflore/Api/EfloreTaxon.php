<?php

namespace App\TelaBotanica\Eflore\Api;

class EfloreTaxon
{
    private $family;
    private $acceptedSciName;
    private $acceptedSciNameId;

    /**
     * @return mixed
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param mixed $family
     */
    public function setFamily($family): void
    {
        $this->family = $family;
    }

    /**
     * @return mixed
     */
    public function getAcceptedSciName()
    {
        return $this->acceptedSciName;
    }

    /**
     * @param mixed $acceptedSciName
     */
    public function setAcceptedSciName($acceptedSciName): void
    {
        $this->acceptedSciName = $acceptedSciName;
    }

    /**
     * @return mixed
     */
    public function getAcceptedSciNameId()
    {
        return $this->acceptedSciNameId;
    }

    /**
     * @param mixed $acceptedSciNameId
     */
    public function setAcceptedSciNameId($acceptedSciNameId): void
    {
        $this->acceptedSciNameId = $acceptedSciNameId;
    }
}
