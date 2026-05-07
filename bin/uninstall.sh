#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"

"$ROOT_DIR/bin/stop.sh" || true
rm -rf "$ROOT_DIR/.run"

echo "[DONE] 実行ファイルの停止と一時ファイル削除が完了しました。"
echo "このアプリを完全に削除するには、次を実行してください:"
echo "rm -rf '$ROOT_DIR'"
