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

## 起動方法（初心者向け・Windows でこのフォルダに保存した場合）

このプロジェクトの保管場所（例）:

`D:\Users\m_tam\15_ツール\open-code-main\open-code-main`

以下は「初めてでも迷いにくい手順」です。

### 1) ターミナルを開く

- **おすすめ**: VS Code の「ターミナル」
- もしくは **PowerShell** / **Git Bash**

> `bin/start.sh` はシェルスクリプトなので、PowerShell だけだと実行しづらい場合があります。  
> その場合は **Git Bash** を使うのが簡単です。

### 2) プロジェクトフォルダへ移動

Git Bash では次を実行:

```bash
cd "/d/Users/m_tam/15_ツール/open-code-main/open-code-main"
```

> Windows の `D:\` は、Git Bash では `/d/` と表記します。

### 3) 起動スクリプトを実行

```bash
./bin/start.sh
```

### 4) ブラウザで開く

起動後に次のURLを開いてください。

- `http://127.0.0.1:8080/index.html`

### 5) うまく動かない時の確認ポイント

1. Ollama が起動しているか
2. モデルを pull 済みか（`ollama list` で確認）
3. `chat.php` のモデル名が実際のモデル名と一致しているか

---

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
