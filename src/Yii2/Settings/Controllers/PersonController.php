<?php

namespace ZnBundle\Person\Yii2\Settings\Controllers;

use DomainException;
use ZnBundle\Person\Domain\Entities\PersonEntity;
use ZnBundle\Person\Domain\Interfaces\Services\PersonServiceInterface;
use ZnBundle\Person\Yii2\Settings\Forms\PersonForm;
use Yii;
use yii\base\Module;
use yii\helpers\Url;
use ZnBundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface;
use ZnBundle\User\Domain\Interfaces\Services\AuthServiceInterface;
use ZnBundle\UserSettings\Yii2\Admin\Controllers\BaseSettingsController;
use ZnCore\Base\Libs\I18Next\Facades\I18Next;
use ZnCore\Domain\Exceptions\UnprocessibleEntityException;
use ZnCore\Domain\Helpers\EntityHelper;
use ZnLib\Web\Widgets\BreadcrumbWidget;
use ZnYii\Base\Helpers\FormHelper;

class PersonController extends BaseSettingsController
{

    private $authService;
    private $personService;
    public $viewAlias = '@vendor/znbundle/person/src/Yii2/Settings/views/person/index.php';

    public function __construct(
        string $id,
        Module $module, array $config = [],
        BreadcrumbWidget $breadcrumbWidget,
        AuthServiceInterface $authService,
        PersonServiceInterface $personService,
        ToastrServiceInterface $toastrService
    )
    {
        parent::__construct($id, $module, $config);
        $this->authService = $authService;
        $this->personService = $personService;
        //$this->service = $service;
        $this->breadcrumbWidget = $breadcrumbWidget;
        $this->toastrService = $toastrService;
        $this->breadcrumbWidget->add(I18Next::t('person', 'person.title'), Url::to(['/' . $this->route]));
    }

    public function actionIndex()
    {
        $model = new PersonForm();
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post($model->formName());
            FormHelper::setAttributes($model, $postData);
            try {
                $data = FormHelper::extractAttributesForEntity($model, PersonEntity::class);
                $entity = EntityHelper::createEntity(PersonEntity::class, $data);
                $this->personService->update($entity);
                $this->toastrService->success(I18Next::t('web', 'message.save_success'));
            } catch (UnprocessibleEntityException $e) {
                $errors = FormHelper::setErrorsToModel($model, $e->getErrorCollection());
                $errorMessage = implode('<br/>', $errors);
                $this->toastrService->warning($errorMessage);
            } catch (DomainException $e) {
                $this->toastrService->warning($e->getMessage());
            }
        } else {
            $person = $this->authService->getIdentity();
            $model->username = $person->getUserName();
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [SupportCallMePermissionEnum::ALL],
                        'actions' => ['index'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [SupportCallMePermissionEnum::ONE],
                        'actions' => ['view'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [SupportCallMePermissionEnum::CREATE],
                        'actions' => ['create'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [SupportCallMePermissionEnum::IN_PROGRESS],
                        'actions' => ['in-progress'],
                    ],
                    [
                        'allow' => true,
                        'roles' => [SupportCallMePermissionEnum::COMPLETED],
                        'actions' => ['completed'],
                    ],
                ],
            ],
        ];
    }*/
}
