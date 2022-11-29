## udemy laravel講座

## ダウンロード方法

git clone
git clone http://github.com/youichifukumoto/laravel_umarche.git

git clone ブランチを指定してダウンロードする場合
git clone -b ブランド名 https://github.com/youichifukumoto/laravel_umarche.git

もしくはzipファイルでダウンロードしてください。


## インストール方法

cd laravel_umarche
composer install
npm install
npm run dev

.env.example をコピーいて .env ファイルを作成

.envファイルの中の下記をご利用の環境に合わせて変更してください。

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_umarche
DB_USERNAME=umarche
DB_PASSWORD=password123

XAMPP/MAMPまたは他の開発環境でDBを起動した後に

php artisan migrate:fresh --seed

と実行してください。（データベーステーブルとダミーデータが追加されればOK）

最後に
php artisan key:generate
と入力してキーを生成後、

php artisan serve
で簡易サーバーを立ち上げ、表示確認してください。

## インストール後の実施事項

画像ダミーデータは
public/image内にsample1.jpgから
sample6.jpgとし保存しています。

php artisan storage:linkで
storageフォルダにリンク後、
storage/app/public/productsフォルダ内
に保存すると表示されます。
(productsフォルダがない場合は作成してください。)


ブランドの画像も表示する場合は、
storage/app/public/brandsフォルダを作成し
画像を保存してください。

## section07の補足
決済のテストとしてstripeを利用します。
必要な場合は.envにstripeの情報を追記してください。
（講座内で解説しています）

## section08の補足
メールのテストとしてmailTrapを利用しています。
必要な場合は.envにmailTrapの情報を追記してください。
（講座内で解説しています）

メール処理には時間が掛かるので、
キューを使用しています。
必要な場合は、queue:workワーカーを立ち上げて
動作確認するようにしてください。
（講座内で解説しています）
