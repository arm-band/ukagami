<?php
namespace Slim\App\Model;

//ディレクトリ一覧を取得
class getDirList {
    protected $settings;

    public function __construct($settings)
    {
        $this->settings = $settings;
    }

    //ディレクトリ一覧の配列を返す
    public function getDirArray() {
        $dirs = scandir($this->settings['dataPath'], SCANDIR_SORT_DESCENDING);
        $array = array();

        foreach($dirs as $dir) {
            if(in_array($dir, $this->settings['excludes'])) { //除外リストに含まれているものは処理しない
                continue;
            }
            else {
                if(preg_match('/^[\d]{4}$/i', $dir)) { //yyyy形式のもののみリストに含む
                    $subDirs = scandir($this->settings['dataPath'] . $dir . '/', SCANDIR_SORT_DESCENDING);
                    foreach ($subDirs as $subDir) {
                        if(in_array($subDir, $this->settings['excludes'])) { //除外リストに含まれているものは処理しない
                            continue;
                        }
                        else {
                            if(preg_match('/^[\d]{2}$/i', $subDir)) { //yyyy/mm形式のもののみリストに含む
                                $array[] = $dir . $subDir;
                            }
                        }
                    }
                }
            }
        }

        return $array;
    }
}