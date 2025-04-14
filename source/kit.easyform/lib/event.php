<?
/**
 * Copyright (c) 2/1/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

namespace Kit\Easyform;
class event
{
    public function eventHandler(\Bitrix\Main\Entity\Event $event)
    {
        $result = new \Bitrix\Main\Entity\EventResult;
        $result->modifyFields(array('result' => true));
        return $result;
    }
}