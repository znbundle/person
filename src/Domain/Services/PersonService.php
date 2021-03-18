<?php

namespace ZnBundle\Person\Domain\Services;

use ZnBundle\Person\Domain\Entities\PersonEntity;
use ZnBundle\Person\Domain\Interfaces\Services\PersonServiceInterface;
use ZnCore\Domain\Helpers\ValidationHelper;

class PersonService implements PersonServiceInterface
{

    public function update(PersonEntity $personEntity)
    {
        ValidationHelper::validateEntity($personEntity);

    }
}
