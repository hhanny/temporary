<?php


namespace app\components;


class AppLogic
{
    public static function Exceptionhtml($message)
    {
        return '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert"><span class="alert-inner--text">' . $message . '</span><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
    }

    public static function Age($date)
    {
        $birthDate = explode("/", date('Y-m-d', strtotime($date)));
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
            ? ((date("Y") - $birthDate[0]) - 1)
            : (date("Y") - $birthDate[0]));
        return $age;
    }

    public function shift()
    {
        return [1 => 'Shift 1', 2 => 'Shift 2', 3 => 'Shift 3'];
    }
}