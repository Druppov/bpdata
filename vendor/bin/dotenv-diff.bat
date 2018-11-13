@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../justcoded/dotenv-sync/bin/dotenv-diff
php "%BIN_TARGET%" %*
