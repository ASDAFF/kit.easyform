<?
/**
 * Copyright (c) 2/1/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/modules/kit.easyform/admin/kit_easyform.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/modules/kit.easyform/admin/kit_easyform.php");
} else {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/kit.easyform/admin/kit_easyform.php");
}
?>