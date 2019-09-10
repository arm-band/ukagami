<?php
namespace Slim\App\Helper;

//パラメータの処理を行うクラス
class procDate {
    //引数)$str：文字列
    public function calcYM($str) {
        $ym = [
                'year' => '',
                'month' => ''
            ];
        if(preg_match('/^[0-9]{6}$/i', $str)) { //yyyymm形式か
            $ym['year'] = mb_substr($str, 0, 4, 'UTF-8');
            $ym['month'] = mb_substr($str, 4, 2, 'UTF-8');
        }

        return $ym;
    }
    //引数)$ym：キー"year","month"の2つを持つ連想配列
    public function calcDays($ym) {
        $days = '';
        if(array_key_exists('year', $ym) && array_key_exists('month', $ym)) {
            if(preg_match('/^[0-9]{4}$/i', $ym['year']) && preg_match('/^[0-9]{2}$/i', $ym['month'])) {
                $days =  date('t', mktime(0, 0, 0, $ym['month'], 1, $ym['year']));
            }
            else {
                $days = '0';
            }
        }
        else {
            $days =  '0';
        }

        return $days;
    }
}