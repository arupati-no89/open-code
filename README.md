OpenCode + ローカルLLM（Ollama）で、ブラウザからAIと対話できる最小サンプルです。

## ファイル構成

- `index.html` : チャットUI
- `chat.php` : ローカルLLMへのAPI中継
- `LOCAL_LLM_BEGINNER_GUIDE.md` : 初心者向けの進め方

## 事前準備

1. Ollama をインストール
2. モデルを取得（例）
   ```bash
   ollama pull gemma3:4b
   ```
3. Ollama を起動
   ```bash
   ollama serve
   ```

## 起動方法

```bash
php -S 127.0.0.1:8080
```

ブラウザで `http://127.0.0.1:8080/index.html` を開いてください。

## 注意

- `chat.php` は `http://127.0.0.1:11434/api/chat` を呼びます。
- モデル名を変える場合は `chat.php` の `model` を編集してください。
