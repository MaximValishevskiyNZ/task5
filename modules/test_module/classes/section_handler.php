<?php
class section_handler
{

    public static function getSection($name, $code)
    {
        $section_res = CIBlockSection::GetList (
            Array("ID" => "ASC"),
            Array("IBLOCK_ID" => 7, "CODE" => $code, "NAME" => $name),
            false,
            Array('NAME', 'CODE', 'ID')
         );
         return $section_res->GetNext();
    }

    public static function createSection($name, $code)
    {
        $bs = new CIBlockSection();
        $arFields = array("ACTIVE" => "Y", "CODE" => $code, "IBLOCK_ID" => 7, "NAME" => $name);
        $result_id = $bs->Add($arFields);
        return $result_id;
    }
}
?>