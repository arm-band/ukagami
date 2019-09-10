<?php
namespace Slim\App\Model;

//yyyymmディレクトリを走査して画像のパスを連想配列に格納。日付=>[0 or 1 or 2]=>{画像1, 画像2, ...}、日=>時（朝昼晩の3つ）=>画像一覧、の三次元配列を返すクラス
class getImgList {
    protected $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    //引数)$ym：キー'year','month'の2つを持つ連想配列
    public function getImg($ym, $getImgList) {
        $photo_path = $this->settings['dataPath'][0] . $ym['year'] . '/' . $ym['month'] . '/*'; //パスを組み立てる //./img/yyyy/mm/*

        $files = glob($photo_path); //「./photo/*」を探す
        $list = [];
        foreach($files as $file) { //$file = 実際にディレクトリに存在するファイルへのパス
            if(is_file($file)) {
                if(preg_match('/\.(jpg|jpeg|JPG|JPEG)$/i', $file)) {
                    if(getimagesize($file) != false) { //画像情報取得できたならば
                        $imgMeta = exif_read_data($file, 'EXIF', true);
                        if(isset($imgMeta['EXIF']['DateTimeOriginal'])) { //EXIF情報のオリジナル画像の撮影日時を取得 //$imgMeta['EXIF']['DateTimeOriginal'] = 'yyyy:MM:dd hh:ii:ss'
                            $datetime = explode(' ', $imgMeta['EXIF']['DateTimeOriginal']);
                            $date = explode(':', $datetime[0]); //'yyyy:MM:dd'
                            $time = explode(':', $datetime[1]); //'hh:ii:ss'
                            if(!array_key_exists($date[2] - 1, $list)) { //日付のキーが存在しない場合
                                $list[$date[2] - 1] = [
                                        0 => [],
                                        1 => [],
                                        2 => []
                                    ]; //日付のキーに朝昼晩の3つのキーを追加
                            }

                            $hour = (int)$time[0];
                            $timeZone = 2;

                            if($hour >= $this->settings['mealTimeZone'][0] && $hour < $this->settings['mealTimeZone'][1]) { //0時～11時まで
                                $timeZone = 0;
                            }
                            else if($hour >= $this->settings['mealTimeZone'][1] && $hour < $this->settings['mealTimeZone'][2]) { //11時～17時まで
                                $timeZone = 1;
                            }
                            else { //17～24時まで
                                $timeZone = 2;
                            }
                            //サーバ内の絶対パスではなく、URLの相対パスに変換
                            $filename = explode('/', $file);
                            $filepath = $this->settings['dataPath'][1] . $ym['year'] . '/' . $ym['month'] . '/' . $filename[count($filename) - 1];
                            array_push($list[$date[2] - 1][$timeZone], $filepath); //判定された日・時の配列に追加
                        }
                    }
                }
            }
            if (is_dir($file)) { //$list = array_merge($list, getImageList($file)); //ディレクトリの場合は、再帰してファイルを検索、結果を現在のリストの末尾にマージする
                $list = array_merge($list, $getImgList->getImg($ym, $getImgList)); //ディレクトリの場合は、再帰してファイルを検索、結果を現在のリストの末尾にマージする
            }
        }

        return $list;
    }
}