<?php

if (file_exists($_SERVER['DOCUMENT_ROOT']. "/local/modules/test_module/include/event_handler.php")) {
   include_once($_SERVER['DOCUMENT_ROOT']. "/local/modules/test_module/include/event_handler.php");
   
}

function testAgent()
{
    CModule::IncludeModule("iblock");
    $get_log = CIBlockElement::GetList(
        array("timestamp_x" => "DESC"),
        array("IBLOCK_ID" => 7),
        false,
        false,
        array("ID")
    );
    $counter = 0;
    while ($log_ids = $get_log->NavNext()) {
        if ($counter > 9) {
            echo $log_ids['ID'] . "<br>";
            CIBlockElement::Delete($log_ids['ID']);
        }
        $counter++;
    }
    return "testAgent();";
}
