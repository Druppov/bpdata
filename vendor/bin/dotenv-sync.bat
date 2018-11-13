@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../justcoded/dotenv-sync/bin/dotenv-sync
php "%BIN_TARGET%" %*
