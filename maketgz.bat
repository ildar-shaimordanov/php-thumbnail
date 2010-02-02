@echo off


if "%~1" == "" goto help
if "%~2" == "" goto help

if not exist "%~dp0\%~1" goto help


tar -c --exclude=.svn -f - "%~1" | gzip -c -9 - > "%~1_%~2.tgz"
goto :EOF


:help
echo.Usage: %~n0 NAME VERSION
goto :EOF

