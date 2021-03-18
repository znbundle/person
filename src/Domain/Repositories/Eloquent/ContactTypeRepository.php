<?php

namespace ZnBundle\Person\Domain\Repositories\Eloquent;

use ZnBundle\Person\Domain\Entities\ContactTypeEntity;
use ZnBundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use ZnLib\Db\Base\BaseEloquentCrudRepository;

class ContactTypeRepository extends BaseEloquentCrudRepository implements ContactTypeRepositoryInterface
{

    public function tableName(): string
    {
        return 'person_contact_type';
    }

    public function getEntityClass(): string
    {
        return ContactTypeEntity::class;
    }
}
