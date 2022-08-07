<?php

use Morilog\Jalali\Jalalian;

/**
 * @param $date
 * @param $format
 * @return void
 *
 * Jalali calendar is a solar calendar that was used in Persia, variants of which today are still in use in Iran as well as Afghanistan. Read more on Wikipedia or see Calendar Converter.
 * Calendar conversion is based on the algorithm provided by Kazimierz M. Borkowski and has a very good performance.
 * CalendarUtils class was ported from jalaali/jalaali-js
 *
 * Jalalian::forge('today')->format('%A, %d %B %y'); // جمعه، 23 اسفند 97
 *
 */
function jalaliDate($date = 'today', $format = '%A, %d %B %Y', $ago = false) {
    if ($ago = true)
        return Jalalian::forge($date)->ago();
    else
        return Jalalian::forge($date)->format($format);
}

function convertPersianToEnglish($number) {
    $number = str_replace('۰', '0', $number);
    $number = str_replace('١', '1', $number);
    $number = str_replace('۲', '2', $number);
    $number = str_replace('۳', '3', $number);
    $number = str_replace('۴', '4', $number);
    $number = str_replace('۵', '5', $number);
    $number = str_replace('۶', '6', $number);
    $number = str_replace('۷', '7', $number);
    $number = str_replace('۸', '8', $number);
    $number = str_replace('۹', '9', $number);

    return $number;
}

function convertArabicToEnglish($number) {
    $number = str_replace('۰', '0', $number);
    $number = str_replace('١', '1', $number);
    $number = str_replace('۲', '2', $number);
    $number = str_replace('۳', '3', $number);
    $number = str_replace('۴', '4', $number);
    $number = str_replace('۵', '5', $number);
    $number = str_replace('۶', '6', $number);
    $number = str_replace('۷', '7', $number);
    $number = str_replace('۸', '8', $number);
    $number = str_replace('۹', '9', $number);

    return $number;
}

function convertEnglishToPersian($number) {

    $number = str_replace('0', '۰', $number);
    $number = str_replace('1', '۱', $number);
    $number = str_replace('2', '۲', $number);
    $number = str_replace('3', '۳', $number);
    $number = str_replace('4', '۴', $number);
    $number = str_replace('5', '۵', $number);
    $number = str_replace('6', '۶', $number);
    $number = str_replace('7', '۷', $number);
    $number = str_replace('8', '۸', $number);
    $number = str_replace('9', '۹', $number);

    return $number;
}

function priceFormat($price) {
    $price = number_format($price, 0, '/', ',');
    $price = convertEnglishToPersian($price);
    $price .= ' تومان';
    return $price;
}

function discountFormat($percentage) {
    $percentage = convertEnglishToPersian($percentage);
    $percentage .= '٪';
    return $percentage;
}




