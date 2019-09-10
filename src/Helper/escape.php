<?php
namespace Slim\App\Helper;

//エスケープ処理を行うクラス
class escape {
    //C
    //引数)$str：文字列
    public function escHtml($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8', true);
    }
}