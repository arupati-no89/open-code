OpenCode + ローカルLLM（Ollama）で、ブラウザからAIと対話できる最小サンプルです。

## ファイル構成

- `index.html` : チャットUI
- `chat.php` : ローカルLLMへのAPI中継
- `bin/start.sh` : 初心者向けワンコマンド起動
- `bin/stop.sh` : 停止スクリプト
- `bin/uninstall.sh` : 停止 + 一時ファイル削除
- `LOCAL_LLM_BEGINNER_GUIDE.md` : 初心者向けの進め方

## 事前準備

1. Ollama をインストール
2. モデルを取得（例）
   ```bash
   ollama pull gemma3:4b
   ```

## 起動方法（初心者向け）

```bash
./bin/start.sh
```

ブラウザで `http://127.0.0.1:8080/index.html` を開いてください。

## 停止方法

```bash
./bin/stop.sh
```

## アンインストール/削除方法

1. まず停止と一時ファイル削除
   ```bash
   ./bin/uninstall.sh
   ```
2. アプリ本体は **このプロジェクトのディレクトリごと削除**
   ```bash
   rm -rf /path/to/open-code
   ```

> このプロジェクトは「1ディレクトリ完結」にしているため、後から丸ごと消しやすい構成です。

## 注意

- `chat.php` は `http://127.0.0.1:11434/api/chat` を呼びます。
- モデル名を変える場合は `chat.php` の `model` を編集してください。
