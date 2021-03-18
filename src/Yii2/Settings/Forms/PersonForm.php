<?php

namespace ZnBundle\Person\Yii2\Settings\Forms;

use ZnYii\Base\Forms\BaseForm;

class PersonForm extends BaseForm
{

    public $username;

    public function i18NextConfig(): array
    {
        return [
            'bundle' => 'person',
            'file' => 'person',
        ];
    }
}
