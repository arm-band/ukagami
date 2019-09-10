# 伺見(Ukagami) 🦊⛩🦊

Slim v3を使った食事一覧を出力する簡易Webアプリ

## Features

- 目的: ダイエット目的ではなく単純な記録なので、カロリー計算等は不要
- 時間帯: 食事の時間帯について、個人的には開発にのめりこんだりすると時間が一般的な時間からずれる場合があるので、自動判別ではなくせめて時間帯の設定が欲しい(かといってすべて手動で登録はしたくない)
- 特定ディレクトリ下に年(`YYYY`)、月(`mm`)のディレクトリを作成し、その中に写真が入っているものとする
    - **写真のEXIF情報を読み取り**、撮影日時から朝・昼・夕晩の3つの時間帯のいずれかに振り分け(これが朝食なのか昼食なのか夕食なのかの振り分け基準となる)
- 上述の年・月のディレクトリ名から該当年月の一覧ページを生成
- 年・月を指定すると、1日から最終日まで日付を見出しとし、その下に朝・昼・夕晩の三食の写真がグリッドで表示される
    - 時間帯は上述のように設定のパラメータ(`src/settings.php`)で時間帯を調整できるように
    - 該当時間帯に複数写真がマッチする場合は最初の1枚目をサムネイルとし、右上に枚数表示、[Lightbox2](https://lokeshdhakar.com/projects/lightbox2/)で同じ時間帯の次・前の写真への切替ができるようにする
- `alt`とLightboxの`data-title`にEXIF情報の「タイトル」と撮影日時を入れて、いつの写真なのか分かりやすくする
- 日付・曜日表示で土曜日:青、日曜日:赤のところに祝日も赤く表示するように機能を追加
    - [Yasumi](https://azuyalabs.github.io/yasumi/)を使って祝日判定実施

## Usage

### First

1. `npm i -D`
2. `npm start`
3. `composer require`
4. `composer start`

## After second

`composer start`

## Directories

~~~
ROOT/
  ├ bin/                     //Ususama(フロント)用
  ├ gulp/                    //Ususama(フロント)用
  ├ logs/
  ├ public/                  //Webアクセス時ルートディレクトリ
  │  └ img/                  //画像
  │     └ storage/           //食事写真ディレクトリ
  │       ├ 2018/            //食事写真「年」ディレクトリ(例)
  │       │  ├ 11/           //食事写真「月」ディレクトリ(例)
  │       │  │  ├ hoge1.jpg  //食事写真(例)
  │       │  │  └ ...
  │       │  └ 12/
  │       │     ├ hoge2.jpg
  │       │     └ ...
  │       └ 2019/
  │          ├ 01/
  │          │  ├ piyo1.jpg
  │          │  └ ...
  │          └ 02/
  │             ├ piyo2.jpg
  │             └ ...
  ├ src/                      //Slimコード
  ├ templates/                //Slimコード(View部分)
  └ viewsrc/                  //Scss, JSコード(gulpで public ディレクトリ下にコンパイル・圧縮)
~~~

---

# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application.

    php composer.phar create-project slim/slim-skeleton [my-app-name]

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can run these commands 

	cd [my-app-name]
	php composer.phar start
	
Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:

         cd [my-app-name]
	 docker-compose up -d
After that, open `http://0.0.0.0:8080` in your browser.

Run this command in the application directory to run the test suite

	php composer.phar test

That's it! Now go build something cool.
