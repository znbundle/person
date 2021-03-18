<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnLib\Migration\Domain\Base\BaseCreateTableMigration;

class m_2018_02_25_102160_create_person_contact_type_table extends BaseCreateTableMigration
{

    protected $tableName = 'person_contact_type';
    protected $tableComment = '';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('');
            $table->string('title')->comment('');
            $table->string('icon')->nullable()->comment('');
            $table->string('rule')->comment('');
        };
    }
}
