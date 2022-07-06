<?php

namespace ZnBundle\Person\Domain\Interfaces\Services;

use ZnBundle\Person\Domain\Entities\PersonEntity;
use ZnCore\Validation\Exceptions\UnprocessibleEntityException;

interface PersonServiceInterface
{

    /**
     * @param PersonEntity $personEntity
     * @throws UnprocessibleEntityException
     */
    public function update(PersonEntity $personEntity);
}
