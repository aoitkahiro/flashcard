## 以下実行手順
リポジトリをclone
```
git clone https://github.com/hash52/flashcard.git
```

cloneしたリポジトリに移動
```
cd flashcard
```

イメージを構築
```
docker-compose build
```

コンテナの起動
```
docker up -d
```

起動したコンテナに入る
```
docker-compose exec app bash
```

composer install
```
cd flashcard_app
composer install
```

flashcard_app/.envの下記の項目についてdocker-compose.ymlの設定値を記述
```
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=db（←コンテナ名）
DB_PORT=3306（←コンテナ側のポート番号）
DB_DATABASE=db_name
DB_USERNAME=db_user
DB_PASSWORD=db_password
```

[https://localhost:8000](https://localhost:8000)でプレビュー

## 資料
- [ER図](https://lucid.app/lucidchart/de10090f-3b8d-4512-885a-e91803ae5ba2/edit?invitationId=inv_d1693898-7147-4f83-8437-7bbb3508271f)
- [DockerでLaravel環境を構築](https://qiita.com/shimotaroo/items/29f7878b01ee4b99b951)
