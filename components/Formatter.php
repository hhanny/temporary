<?php
namespace app\components;

class Formatter
{
    const decimals = 0;
    const decimalSeparator = ',';
    const thousandSeparator = '.';

    public static function formatNumber($value)
    {
        global $numberFormat;
        if ($value === null)
            return null;    // new
        if ($value === '')
            return '';        // new
        return number_format($value, self::decimals, self::decimalSeparator, self::thousandSeparator);
    }

    public static function unformatNumber($formatted_number)
    {
        global $numberFormat;
        if ($formatted_number === null)
            return null;
        if ($formatted_number === '')
            return '';
        if (is_float($formatted_number))
            return $formatted_number; // only 'unformat' if parameter is not float already

        $value = str_replace(self::thousandSeparator, '', $formatted_number);
        $value = str_replace(self::decimalSeparator, '.', $value);
        return (float)$value;
    }

}

?>
