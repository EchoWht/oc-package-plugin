<?php namespace Blskye\Package\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Url extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController',        'Backend\Behaviors\ReorderController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'blskye.package.url_manage' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Blskye.Package', 'main-menu-item', 'side-menu-item');
    }
}
