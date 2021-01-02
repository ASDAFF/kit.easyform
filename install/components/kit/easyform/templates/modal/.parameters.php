<?
/**
 * Copyright (c) 2/1/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arTemplateParameters['NAME_MODAL_BUTTON'] = Array(
    'NAME' => Loc::getMessage('KIT_EASYFORM_NAME_MODAL_BUTTON'),
    'TYPE' => 'STRING',
    'DEFAULT' =>  Loc::getMessage('KIT_EASYFORM_DEFAULT_NAME_MODAL_BUTTON'),
    'PARENT' => 'BASE',
);
?>