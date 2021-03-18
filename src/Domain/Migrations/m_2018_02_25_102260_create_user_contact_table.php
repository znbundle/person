<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnLib\Migration\Domain\Base\BaseCreateTableMigration;
use ZnLib\Migration\Domain\Enums\ForeignActionEnum;

class m_2018_02_25_102260_create_user_contact_table extends BaseCreateTableMigration
{

    protected $tableName = 'user_contact';
    protected $tableComment = 'Контакты пользователя';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('identity_id')->comment('ID учетной записи');
            $table->integer('type_id')->comment('Тип контакта (телефон, почта, телеграм, ватсап)');
            $table->boolean('is_main')->default(false)->comment('Основной');
            $table->string('value')->comment('Контакт');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->comment('Время обновления');

            $table->unique(['identity_id', 'type_id', 'value']);
            $table
                ->foreign('identity_id')
                ->references('id')
                ->on($this->encodeTableName('user_identity'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
            $table
                ->foreign('type_id')
                ->references('id')
                ->on($this->encodeTableName('user_contact_type'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
        };
    }
}
