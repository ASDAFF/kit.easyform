<?php

namespace d7\easyform;

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\Json;
use Bitrix\Main\Config\Option;
use CBitrixComponent;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class EasyForm extends CBitrixComponent
{

    /**
     * Подключает языковые файлы
     */

    public function onIncludeComponentLang()
    {
        $this->includeComponentLang(basename(__FILE__));
        Loc::loadMessages(__FILE__);
    }

    /**
     * Обработка входных параметров
     *
     * @param mixed[] $arParams
     * @return mixed[] $arParams
     */

    public function onPrepareComponentParams($arParams)
    {

        $context = Application::getInstance()->getContext();
        $request = $context->getRequest();
        $server = $context->getServer();

        // время кэширования

        $arParams["CACHE_TIME"] = (int)$arParams["CACHE_TIME"];

        $arParams['OLD_PARAMS'] = array_merge($arParams);
        foreach ($arParams['OLD_PARAMS'] as $key => $val) {
            if ($key[0] != '~') {
                if (is_array($val)) {
                    $val[] = false;
                    $arParams['OLD_PARAMS'][$key] = implode('-array-', $val);
                }
            } else {
                unset($arParams['OLD_PARAMS'][$key]);
            }
        }

        $arParams['FORM_ID'] = $arParams['FORM_ID'] ? trim($arParams['FORM_ID']) : $this->GetEditAreaId($this->__currentCounter);

        $arParams['HTTP_PROTOCOL'] = $request->isHttps() ? 'https://' : 'http://';
        $arParams['HTTP_HOST'] = $arParams['HTTP_PROTOCOL'] . $server->getHttpHost();
        $arParams['EVENT_NAME'] = 'KIT_EASYFORM';
        $arParams['USE_FORM_MASK_JS'] = 'N';

        if ($request['AJAX']) {
            $arParams['SEND_AJAX'] = 'Y';
        }

        TrimArr($arParams['DISPLAY_FIELDS']);
        TrimArr($arParams['REQUIRED_FIELDS']);

        $arParams['DISPLAY_FIELDS'] = array_diff((array)($arParams['DISPLAY_FIELDS']), array(''));
        $arParams['REQUIRED_FIELDS'] = array_diff((array)($arParams['REQUIRED_FIELDS']), array(''));

        $arParams['DISPLAY_FIELDS_ARRAY'] = $arParams['DISPLAY_FIELDS'];


        $arSortField = explode(',', $arParams['FIELDS_ORDER']);
        if (!empty($arSortField) && count($arSortField) == count($arParams['DISPLAY_FIELDS'])) {
            $arParams['DISPLAY_FIELDS_ARRAY'] = $arSortField;
        }

        $arParams['TEMPLATE_FOLDER'] = $this->GetPath() . '/ajax.php';
        $arParams['TEMPLATE_NAME'] = $this->GetTemplateName();

        $this->captchaKey();

        $arParams["USE_CAPTCHA"] = $arParams["USE_CAPTCHA"] == 'Y' && strlen($arParams["CAPTCHA_KEY"]) > 1 && strlen($this->arResult["CAPTCHA_SECRET_KEY"]) > 1;

        $this->arResult['FORM_FIELDS'] = array();
        foreach ($arParams['DISPLAY_FIELDS_ARRAY'] as $fieldCode) {


            if (in_array($fieldCode, $arParams['REQUIRED_FIELDS'])) {
                $isReq = true;
            } else {
                $isReq = false;
            }

            if (!empty($arParams['CATEGORY_' . $fieldCode . '_PLACEHOLDER'])) {
                $placeHolder = $arParams['CATEGORY_' . $fieldCode . '_PLACEHOLDER'];
            } else {
                $placeHolder = false;
            }

            if (!empty($arParams['CATEGORY_' . $fieldCode . '_TYPE'])) {
                $typeInput = $arParams['CATEGORY_' . $fieldCode . '_TYPE'];
            } else {
                $typeInput = 'text';
            }

            $this->arResult['FORM_FIELDS'][$fieldCode] = array(
                'ID' => trim($arParams['FORM_ID']) . '_FIELD_' . $fieldCode,
                'TITLE' => !empty($arParams['CATEGORY_' . $fieldCode . '_TITLE']) ? htmlspecialcharsBack($arParams['CATEGORY_' . $fieldCode . '_TITLE']) : $fieldCode,
                'TYPE' => $typeInput,
                'NAME' => 'FIELDS[' . $fieldCode . ']',
                'CODE' => $fieldCode,
                'REQUIRED' => $isReq,
                'REQ_STR' => $isReq ? ($arParams['USE_FORMVALIDATION_JS'] == 'Y' ? (' required data-bv-message="' . $arParams['CATEGORY_' . $fieldCode . '_VALIDATION_MESSAGE'] . '"') . htmlspecialcharsBack($arParams['CATEGORY_' . $fieldCode . '_VALIDATION_ADDITIONALLY_MESSAGE']) : ' required') : ' ' . htmlspecialcharsBack($arParams['CATEGORY_' . $fieldCode . '_VALIDATION_ADDITIONALLY_MESSAGE']),
                'VALUE' => !empty($arParams['CATEGORY_' . $fieldCode . '_VALUE']) ? $arParams['CATEGORY_' . $fieldCode . '_VALUE'] : '',
                'PLACEHOLDER' => $placeHolder,
                'PLACEHOLDER_STR' => $placeHolder ? 'placeholder="' . $arParams['CATEGORY_' . $fieldCode . '_PLACEHOLDER'] . '"' : '',
            );

            if ($typeInput == 'select_email') {
                $selectEmailField = $fieldCode;
            }

            if ($arParams['CATEGORY_' . $fieldCode . '_INPUTMASK_TEMP']) {
                $this->arResult['FORM_FIELDS'][$fieldCode]['MASK_STR'] = 'data-inputmask-mask="' . $arParams['CATEGORY_' . $fieldCode . '_INPUTMASK_TEMP'] . '" data-mask="' . $arParams['CATEGORY_' . $fieldCode . '_INPUTMASK_TEMP'] . '"';
            }

            if ($typeInput == 'file') {
                $this->arResult['FORM_FIELDS'][$fieldCode]['DROPZONE_INCLUDE'] = $arParams["CATEGORY_" . $fieldCode . "_DROPZONE_INCLUDE"] == 'Y';
                $this->arResult['FORM_FIELDS'][$fieldCode]['FILE_MAX_SIZE'] = $arParams["CATEGORY_" . $fieldCode . "_FILE_MAX_SIZE"];
                $this->arResult['FORM_FIELDS'][$fieldCode]['FILE_EXTENSION'] = $arParams["CATEGORY_" . $fieldCode . "_FILE_EXTENSION"];
            }

            if ($typeInput == 'radio' || $typeInput == 'checkbox') {
                $this->arResult['FORM_FIELDS'][$fieldCode]['SHOW_INLINE'] = $arParams["CATEGORY_" . $fieldCode . "_SHOW_INLINE"] == "Y";
            }

            if ($typeInput == 'checkbox') {
                $isMultiple = true;
            } else {
                $isMultiple = false;
            }

            if ($typeInput == 'select') {
                $isMultiSelect = $arParams['CATEGORY_' . $fieldCode . '_MULTISELECT'] == 'Y';
                $this->arResult['FORM_FIELDS'][$fieldCode]['MULTISELECT'] = $isMultiSelect ? 'Y' : 'N';
                if ($isMultiSelect) {
                    $isMultiple = true;
                } else {
                    if (strlen(trim($arParams['CATEGORY_' . $fieldCode . "_ADD_VAL"])) > 0) {
                        $this->arResult['FORM_FIELDS'][$fieldCode]['SET_ADDITION_SELECT_VAL'] = true;
                        $this->arResult['FORM_FIELDS'][$fieldCode]['SET_ADDITION_SELECT_ID'] = $this->arResult['FORM_FIELDS'][$fieldCode]['ID'] . '_add';
                        $this->arResult['FORM_FIELDS'][$fieldCode]['ADDITION_SELECT_VAL'] = $arParams['CATEGORY_' . $fieldCode . "_ADD_VAL"];
                        $this->arResult['FORM_FIELDS'][$fieldCode]['ADDITION_SELECT_NAME'] = 'FIELDS[' . $fieldCode . '_ADD]';
                    }
                }
            }

            if ($isMultiple) {
                $this->arResult['FORM_FIELDS'][$fieldCode]['NAME'] .= '[]';
            }

            if ($arParams['USE_IBLOCK_WRITE'] == 'Y') {
                $arParams['WRITE_FIELDS'][$fieldCode] = !empty($arParams['CATEGORY_' . $fieldCode . '_IBLOCK_FIELD']) ? $arParams['CATEGORY_' . $fieldCode . '_IBLOCK_FIELD'] : '';
            }

            if (strlen(trim($arParams['CATEGORY_' . $fieldCode . "_INPUTMASK_TEMP"])) > 0) {
                $arParams['USE_FORM_MASK_JS'] = 'Y';
            }
        }

        $arParams['USER_EMAIL'] = '';
        $arParams['EMAIL_TO'] = trim($arParams['EMAIL_TO']) ? trim($arParams['EMAIL_TO']) : Option::get("kit.easyform", "EMAIL", "", SITE_ID);
        $arParams['BCC'] = trim($arParams['BCC']);

        $arParams['OK_TEXT'] = $arParams['OK_TEXT'] ? htmlspecialcharsback(trim($arParams['OK_TEXT'])) : Loc::getMessage('KIT_EASYFORM_MESS_OK_TEXT');
        $arParams['ERROR_TEXT'] = $arParams['ERROR_TEXT'] ? htmlspecialcharsback(trim($arParams['ERROR_TEXT'])) : Loc::getMessage('KIT_EASYFORM_MESS_ERROR_TEXT');

        $arParams['MAIL_SUBJECT_ADMIN'] = trim($arParams['MAIL_SUBJECT_ADMIN']);
        $arParams['MAIL_SUBJECT_SENDER'] = trim($arParams['MAIL_SUBJECT_SENDER']);
        $arParams['MAIL_SEND_USER'] = $arParams['MAIL_SEND_USER'] == 'Y';

        $arParams['ENABLE_SEND_MAIL'] = $arParams['ENABLE_SEND_MAIL'] === 'Y';
        $arParams['EMAIL_FILE'] = $arParams['EMAIL_FILE'] === 'Y';

        $arParams['USE_JQUERY'] = $arParams['USE_JQUERY'] === 'Y';

        $arParams['HIDE_FIELD_NAME'] = $arParams['HIDE_FIELD_NAME'] === 'Y';
        $arParams['HIDE_ASTERISK'] = $arParams['HIDE_ASTERISK'] === 'Y';
        $arParams['FORM_AUTOCOMPLETE'] = $arParams['FORM_AUTOCOMPLETE'] === 'Y';
        $arParams['FORM_SUBMIT_VALUE'] = htmlspecialcharsback($arParams['FORM_SUBMIT_VALUE']);
        $arParams['SEND_AJAX'] = $arParams['SEND_AJAX'] === 'Y';
        $arParams['FORM_SUBMIT'] = false;


        return $arParams;
    }


    public function captchaKey()
    {
        $captchaKey = "";

        if (Loader::IncludeModule("kit.easyform")) {
            $captchaKey = Option::get("kit.easyform", "CAPTCHA_KEY", "", SITE_ID);
        }

        if (strlen($captchaKey) > 0) {
            $this->arParams["CAPTCHA_KEY"] = trim($captchaKey);
        } else {
            $this->arParams["CAPTCHA_KEY"] = trim($this->arParams["CAPTCHA_KEY"]);
        }
    }

    public function captchaSecretKey()
    {
        $captchaSecretKey = "";
        if (Loader::IncludeModule("kit.easyform")) {
            $captchaSecretKey = Option::get("kit.easyform", "CAPTCHA_SECRET_KEY", "", SITE_ID);
        }

        if (strlen($captchaSecretKey) > 0) {
            $this->arResult["CAPTCHA_SECRET_KEY"] = trim($captchaSecretKey);
        } else {
            $this->arResult["CAPTCHA_SECRET_KEY"] = $this->arParams["CAPTCHA_SECRET_KEY"];
        }
    }


    /**
     * Получение результатов
     *
     * @return void
     */

    protected function getResult()
    {
        $arResult = array();

        $arResult['FORM_FIELDS'] = array();
        foreach ($this->arParams['DISPLAY_FIELDS_ARRAY'] as $fieldCode) {
            $isReq = in_array($fieldCode, $this->arParams['REQUIRED_FIELDS']) ? true : false;
            $placeHolder = !empty($this->arParams['CATEGORY_' . $fieldCode . '_PLACEHOLDER']) ? $this->arParams['CATEGORY_' . $fieldCode . '_PLACEHOLDER'] : false;
            $typeInput = !empty($this->arParams['CATEGORY_' . $fieldCode . '_TYPE']) ? $this->arParams['CATEGORY_' . $fieldCode . '_TYPE'] : 'text';
            $isMultiple = $typeInput == 'checkbox' ? true : false;

            $arResult['FORM_FIELDS'][$fieldCode] = array(
                'ID' => trim($this->arParams['FORM_ID']) . '_FIELD_' . $fieldCode,
                'TITLE' => !empty($this->arParams['CATEGORY_' . $fieldCode . '_TITLE']) ? htmlspecialcharsBack($this->arParams['CATEGORY_' . $fieldCode . '_TITLE']) : $fieldCode,
                'TYPE' => $typeInput,
                'NAME' => 'FIELDS[' . $fieldCode . ']',
                'CODE' => $fieldCode,
                'REQUIRED' => $isReq,
                'REQ_STR' => $isReq ? ($this->arParams['USE_FORMVALIDATION_JS'] == 'Y' ? (' required data-bv-message="' . $this->arParams['CATEGORY_' . $fieldCode . '_VALIDATION_MESSAGE'] . '"') . htmlspecialcharsBack($this->arParams['CATEGORY_' . $fieldCode . '_VALIDATION_ADDITIONALLY_MESSAGE']) : ' required') : ' ' . htmlspecialcharsBack($this->arParams['CATEGORY_' . $fieldCode . '_VALIDATION_ADDITIONALLY_MESSAGE']),
                'VALUE' => !empty($this->arParams['CATEGORY_' . $fieldCode . '_VALUE']) ? $this->arParams['CATEGORY_' . $fieldCode . '_VALUE'] : '',
                'PLACEHOLDER' => $placeHolder,
                'PLACEHOLDER_STR' => $placeHolder ? 'placeholder="' . $this->arParams['CATEGORY_' . $fieldCode . '_PLACEHOLDER'] . '"' : '',
            );

            if ($typeInput == 'select_email') {
                $selectEmailField = $fieldCode;
            }

            if ($this->arParams['CATEGORY_' . $fieldCode . '_INPUTMASK_TEMP']) {
                $arResult['FORM_FIELDS'][$fieldCode]['MASK_STR'] = 'data-inputmask-mask="' . $this->arParams['CATEGORY_' . $fieldCode . '_INPUTMASK_TEMP'] . '" data-mask="' . $this->arParams['CATEGORY_' . $fieldCode . '_INPUTMASK_TEMP'] . '"';
            }

            if ($typeInput == 'file') {
                $arResult['FORM_FIELDS'][$fieldCode]['DROPZONE_INCLUDE'] = $this->arParams["CATEGORY_" . $fieldCode . "_DROPZONE_INCLUDE"] == 'Y';
                $arResult['FORM_FIELDS'][$fieldCode]['FILE_MAX_SIZE'] = $this->arParams["CATEGORY_" . $fieldCode . "_FILE_MAX_SIZE"];
                $arResult['FORM_FIELDS'][$fieldCode]['FILE_EXTENSION'] = $this->arParams["CATEGORY_" . $fieldCode . "_FILE_EXTENSION"];
            }

            if ($typeInput == 'radio' || $typeInput == 'checkbox') {
                $arResult['FORM_FIELDS'][$fieldCode]['SHOW_INLINE'] = $this->arParams["CATEGORY_" . $fieldCode . "_SHOW_INLINE"] == "Y";
            }

            if ($typeInput == 'select') {
                $isMultiSelect = $this->arParams['CATEGORY_' . $fieldCode . '_MULTISELECT'] == 'Y';
                $arResult['FORM_FIELDS'][$fieldCode]['MULTISELECT'] = $isMultiSelect ? 'Y' : 'N';
                if ($isMultiSelect) {
                    $isMultiple = true;
                } else {
                    if (strlen(trim($this->arParams['CATEGORY_' . $fieldCode . "_ADD_VAL"])) > 0) {
                        $arResult['FORM_FIELDS'][$fieldCode]['SET_ADDITION_SELECT_VAL'] = true;
                        $arResult['FORM_FIELDS'][$fieldCode]['SET_ADDITION_SELECT_ID'] = $arResult['FORM_FIELDS'][$fieldCode]['ID'] . '_add';
                        $arResult['FORM_FIELDS'][$fieldCode]['ADDITION_SELECT_VAL'] = $this->arParams['CATEGORY_' . $fieldCode . "_ADD_VAL"];
                        $arResult['FORM_FIELDS'][$fieldCode]['ADDITION_SELECT_NAME'] = 'FIELDS[' . $fieldCode . '_ADD]';
                    }
                }
            }

            if ($isMultiple) {
                $arResult['FORM_FIELDS'][$fieldCode]['NAME'] .= '[]';
            }

            if ($this->arParams['USE_IBLOCK_WRITE'] == 'Y') {
                $this->arParams['WRITE_FIELDS'][$fieldCode] = !empty($this->arParams['CATEGORY_' . $fieldCode . '_IBLOCK_FIELD']) ? $this->arParams['CATEGORY_' . $fieldCode . '_IBLOCK_FIELD'] : '';
            }

            if (strlen(trim($this->arParams['CATEGORY_' . $fieldCode . "_INPUTMASK_TEMP"])) > 0) {
                $this->arParams['USE_FORM_MASK_JS'] = 'Y';
            }
        }

        $this->captchaSecretKey();
    }

    /**
     * Выполняет логику работы компонента
     *
     * @return void
     */

    public function executeComponent()
    {
        try {
            if ($this->StartResultCache($this->arParams["CACHE_TIME"])) {
                $this->getResult();
                $this->includeComponentTemplate($this->page);
            }

        } catch (Exception $e) {
            ShowError($e->getMessage());
        }
    }
}

?>