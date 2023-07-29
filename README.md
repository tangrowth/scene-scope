# Scene Scope

このプロジェクトは、中小劇団の広告とチケットの購入を目的に開発しました。
どうしても発信力の弱い劇団が、多くの人の目に止まるよう、また演劇に興味のある人が簡単に公演を探すことができるように機能を考えています。

## 実装機能

### 一般ユーザー

- 公演一覧の表示
- 劇団一覧の表示
- 公演・劇団の検索
- 劇団のお気に入り
- マイページ
- ユーザー情報の更新
- 公演予約機能
- 予約の削除機能

### 劇団ユーザー

- 公演の作成
- 公演の更新
- 公演の削除
- 公演日時の複数追加
- 公演日時の追加・削除
- 予約の一覧表示
- 予約の削除
- 劇団情報の更新
- 予約の一覧表示

### 管理者ユーザー

- 劇団の作成
- 劇団の削除

## 使用技術

- laravel
- JavaScript
- laravel breeze
- google map api
- geo cooding api
- AWS S3
- Intervention Image

## テーブル設計
![ER drawio](https://github.com/tangrowth/scene-scope/assets/101622404/789dcd87-f0e6-449b-9590-a7a282c32515)

## 環境構築方法
1. .env.exampleファイルをコピーし、名前を「.env」に変更します。
2. .envファイルに以下の内容を設定します
```
AWS_ACCESS_KEY_ID='AWSで作成したS3用ユーザーのAccess key ID'
AWS_SECRET_ACCESS_KEY='AWSで作成したS3用ユーザーのSecret access key'
AWS_DEFAULT_REGION=ap-northeast-1(東京リージョンの場合)
AWS_BUCKET='作成したバケット名'

MAIL_MAILER=smtp
MAIL_HOST=mailhog # ホスト
MAIL_PORT=1025 # ポート番号
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=from@example.com # 送信元メールアドレス
MAIL_FROM_NAME="${APP_NAME}"
```
3. 以下のコマンドを順に実行してください。
```
composer update
php artisan migrate //あたらしいデータベースを作成している場合はこちら
php arttsan migrate:fresh //すでに作成しているデータベースを使用する場合はこちら
php artisan db:seed
php artisan key:generate
php artisan storage:link
php artisan serve
```

### ログイン方法
- 管理者ユーザー
メールアドレス：admin@admin.com
パスワード：password

- 劇団ユーザー
メールアドレス： owner@owner.com
パスワード：　password

### 本番環境
http://3.115.149.109