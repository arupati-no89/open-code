#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
RUN_DIR="$ROOT_DIR/.run"
PHP_PID_FILE="$RUN_DIR/php.pid"
OLLAMA_PID_FILE="$RUN_DIR/ollama.pid"

stop_from_pid_file() {
  local label="$1"
  local file="$2"
  if [[ -f "$file" ]]; then
    local pid
    pid="$(cat "$file")"
    if kill -0 "$pid" 2>/dev/null; then
      kill "$pid" 2>/dev/null || true
      echo "[DONE] $label を停止しました (PID: $pid)"
    else
      echo "[INFO] $label はすでに停止しています"
    fi
    rm -f "$file"
  fi
}

stop_from_pid_file "PHPサーバー" "$PHP_PID_FILE"
stop_from_pid_file "Ollama(このアプリが起動した分)" "$OLLAMA_PID_FILE"

echo "[DONE] 停止処理が完了しました。"
