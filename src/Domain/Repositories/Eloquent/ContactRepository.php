<?php

namespace ZnBundle\Person\Domain\Repositories\Eloquent;

use ZnBundle\Person\Domain\Entities\ContactEntity;
use ZnBundle\Person\Domain\Interfaces\Repositories\ContactRepositoryInterface;
use ZnBundle\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use ZnCore\Domain\Relations\relations\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class ContactRepository extends BaseEloquentCrudRepository implements ContactRepositoryInterface
{

    public function tableName(): string
    {
        return 'person_contact';
    }

    public function getEntityClass(): string
    {
        return ContactEntity::class;
    }

    public function relations2()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'type_id',
                'relationEntityAttribute' => 'type',
                'foreignRepositoryClass' => ContactTypeRepositoryInterface::class,
            ],
        ];
    }
}
