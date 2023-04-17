# Scene Scope

このプロジェクトは、中小劇団の広告とチケットの購入を目的に開発しました。
どうしても発信力の弱い劇団が、多くの人の目に止まるよう、また演劇に興味のある人が簡単に公演を探すことができるように、機能を考えています。

## 実装機能

-   公演の一覧表示
-   予約機能
-   ログイン・ログアウト機能
-   マイページ
-   劇団ページ
-   検索機能
-   予約の変更
-   お気に入り機能
-   ユーザーの権限分け

### 今後の実装予定

-   管理画面の実装
-   劇団の管理画面
-   決済機能
-   公演の追加・削除機能
-   メール認証

## 使用技術

-   laravel
-   jabascript

## 環境構築方法

以下の手順で実行をして下さい。

-   プロジェクト直下で「composer update」を実行
-   「.env.example」ファイルをコピーし、「.env」ファイルを作成
-   「.env」ファイルの以下の項目を、データベースに合わせて書き換える
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
-   以下のコマンドを順に実行する
    php artisan key:generate
    php artisan migrate:fresh
    php artisan db:seed
    php artisan serve
-
-
