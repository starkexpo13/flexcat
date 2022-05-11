<?php


namespace Engine\Helper;


class RoleSudir
{
    public static function getRoleSigma($roleSUDIR)
    {
        $prefix = \Core_Settings::getSettings()['PREFIX'];
        $postfix = \Core_Settings::getSettings()['POSTFIX'];
        $role = false;

//        Читатель (индекс 0):
        $readerRoles = [
            $prefix . 'PRBR_Boss' . $postfix,
            $prefix . 'PRBR_Reader_GOSB_helper' . $postfix,
            $prefix . 'PRBR_Pred' . $postfix,
            $prefix . 'PRBR_Writer_TB_all' . $postfix,
            $prefix . 'PRBR_Writer_TB_invest' . $postfix,
            $prefix . 'PRBR_Writer_TB_PRBR' . $postfix,
            $prefix . 'PRBR_Reader_GOSB_boss' . $postfix,
            $prefix . 'PRBR_Findir_GOSB' . $postfix,
            $prefix . 'PRBR_Reader_GOSB' . $postfix,
            $prefix . 'PRBR_Reader_TB' . $postfix,
            $prefix . 'PRBR_Reader' . $postfix
        ];

//        Редактор ЦА (индекс 1):
        $writerRoles = [
            $prefix . 'PRBR_Writer_CA' . $postfix
        ];

//        Поль. МЦТП (индекс 2):
        $mctpRoles = [
            $prefix . 'PRBR_MCTP' . $postfix
        ];

//        Админ АС (индекс 3):
        $adminsRoles = [
            $prefix . 'PRBR_ADMINISTRATOR_AS' . $postfix
        ];

        if (in_array($roleSUDIR, $readerRoles)) {
            $role = 0;
        }
        if (in_array($roleSUDIR, $writerRoles)) {
            $role = 1;
        }
        if (in_array($roleSUDIR, $mctpRoles)) {
            $role = 2;
        }
        if (in_array($roleSUDIR, $adminsRoles)) {
            $role = 3;
        }

        return $role;
    }

    public static function getRoleTitleSigma($roleSUDIR)
    {
        $roleSigma = self::getRoleSigma($roleSUDIR);

        switch ($roleSigma) {
            case "3":
                $userRole = 'Администратор АС';
                break;
            case "2":
                $userRole = 'Пользователь МЦТП';
                break;
            case "1":
                $userRole = 'Редактор ЦА';
                break;
            case "0":
                $userRole = 'Читатель ЦА';
                break;
        }

        return $roleSigma !== false ? $userRole : $roleSigma;
    }

}