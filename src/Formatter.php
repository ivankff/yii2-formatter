<?php

namespace ivankff\yii2Formatter;

/**
 * @inheritdoc
 */
class Formatter extends \yii\i18n\Formatter {
    
    /**
     * Converts phone number to international format
     *
     * @param string $phone
     * @param string $format
     * @return string
     */
    public static function asPhone($phone, $format = '+7 (%s) %s-%s-%s'){
        $phone = preg_replace('/[^0-9]+/', '', $phone);
        if (mb_strlen($phone) == 11) $phone = ltrim($phone, '78');
        $a0 = mb_substr($phone, 0, -10);
        $a1 = mb_substr($phone, -10, 3);
        $a2 = mb_substr($phone, -7, 3);
        $a3 = mb_substr($phone, -4, 2);
        $a4 = mb_substr($phone, -2, 2);
        $blocksCount = mb_substr_count($format, '%');
        switch($blocksCount) {
            case 5: return sprintf($format, $a0, $a1, $a2, $a3, $a4); break;
            case 2: return sprintf($format, $a1, $a2.$a3.$a4); break;
            case 1: return sprintf($format, $a1.$a2.$a3.$a4); break;
        }
        return sprintf($format, $a1, $a2, $a3, $a4);
    }
    
}