<?php
CModule::IncludeModule("iblock");

AddEventHandler("iblock", "OnAfterIBlockElementAdd", array("IBlockElementAddHandler", "OnAfterIBlockElementAddHandler"));

class IBlockElementAddHandler
{
  function OnAfterIBlockElementAddHandler(&$arFields)
  {
    if ($arFields['IBLOCK_ID'] != '7') {
      $ib_res = CIBlock::GetByID($arFields['IBLOCK_ID'])->Fetch();
      require_once($_SERVER['DOCUMENT_ROOT'] . "/local/modules/test_module/classes/section_handler.php");
      $sHandler = new section_handler;
      if (($logSection = $sHandler->getSection($ib_res['NAME'], $ib_res['CODE'])) != true) {
        $cSection = $sHandler->createSection($ib_res['NAME'], $ib_res['CODE']);
        if ($cSection == true) {
          echo "Секция создана успешно!";
        }
      }

      $el = new CIBlockElement;
      $arLoadProductArray = array(
        "IBLOCK_SECTION_ID" => $logSection['ID'],
        "IBLOCK_ID"      => 7,
        "NAME"           => $arFields['ID'],
        "ACTIVE"         => "Y",            // активен
        "PREVIEW_TEXT"   => "текст для элемента лога",
        "ACTIVE_FROM"    => $arFields["DATE_CREATE"],
        "PREVIEW_TEXT"   => $ib_res['NAME'] . "->" .
          CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID'])->GetNext()['NAME'] . "->" .
          $arFields['NAME']

      );

      if ($PRODUCT_ID = $el->Add($arLoadProductArray))
        echo "New ID: " . $PRODUCT_ID;
      else
        echo "Error: " . $el->LAST_ERROR;;
    }
  }
}


AddEventHandler("iblock", "OnAfterIBlockElementUpdate", array("IBlockElementUpdateHandler", "OnAfterIBlockElementUpdateHandler"));

class IBlockElementUpdateHandler
{
  // создаем обработчик события "OnAfterIBlockElementUpdate"
  function OnAfterIBlockElementUpdateHandler(&$arFieldsUp)
  {
    if ($arFieldsUp['IBLOCK_ID'] != '7') {
      $ib_res = CIBlock::GetByID($arFieldsUp['IBLOCK_ID'])->Fetch();
      require_once($_SERVER['DOCUMENT_ROOT'] . "/local/modules/test_module/classes/section_handler.php");
      $sHandler = new section_handler;
      if (($logSection = $sHandler->getSection($ib_res['NAME'], $ib_res['CODE'])) != true) {
        $cSection = $sHandler->createSection($ib_res['NAME'], $ib_res['CODE']);
        if ($cSection == true) {
          echo "Секция создана успешно!";
        }
      }

      $el = new CIBlockElement;
      $arLoadProductArray = array(
        "IBLOCK_SECTION_ID" => $logSection['ID'],
        "IBLOCK_ID"      => 7,
        "NAME"           => $arFieldsUp['ID'],
        "ACTIVE"         => "Y",            // активен
        "PREVIEW_TEXT"   => "текст для элемента лога",
        "ACTIVE_FROM"    => $arFieldsUp["TIMESTAMP_X"],
        "PREVIEW_TEXT"   => $ib_res['NAME'] . "->" .
          CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID'])->GetNext()['NAME'] . "->" .
          $arFields['NAME']
      );

      if ($PRODUCT_ID = $el->Add($arLoadProductArray))
        echo "New ID: " . $PRODUCT_ID;
      else
        echo "Error: " . $el->LAST_ERROR;;
    }
  }
}
