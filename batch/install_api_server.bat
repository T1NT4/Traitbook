REM Caminho para o diretório do projeto
@echo off
cd /d ../
git clone https://github.com/T1NT4/16personalities-api

cd .\16personalities-api\
npm.cmd install
exit