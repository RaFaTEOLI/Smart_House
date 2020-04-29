#!/bin/bash

# Script de Instalação e Configuração do PHP, MySQL

echo " _______  __   __  _______  ______    _______    __   __  _______  __   __  _______  _______ "
echo "|       ||  |_|  ||   _   ||    _ |  |       |  |  | |  ||       ||  | |  ||       ||       |"
echo "|  _____||       ||  |_|  ||   | ||  |_     _|  |  |_|  ||   _   ||  | |  ||  _____||    ___|"
echo "| |_____ |       ||       ||   |_||_   |   |    |       ||  | |  ||  |_|  || |_____ |   |___ "
echo "|_____  ||       ||       ||    __  |  |   |    |       ||  |_|  ||       ||_____  ||    ___|"
echo " _____| || ||_|| ||   _   ||   |  | |  |   |    |   _   ||       ||       | _____| ||   |___ "
echo "|_______||_|   |_||__| |__||___|  |_|  |___|    |__| |__||_______||_______||_______||_______|"
echo ""

echo "============================================================================================="
echo "=============================== Iniciando Script de Instalação =============================="
echo "============================================================================================="

DBUSER="USER"
DBPASS="PASSWORD"
CONN="-u$DBUSER -p$DBPASS"
IPCONN="$IP -u$DBUSER -p$DBPASS"
SCRIPTPATH="/"

function rodarMysql() {
    sudo apt-get install mysql-server
    sudo apt-get install php-mysql
    echo "Rodando Script MySQL..."
    mysql $CONN smart_house < /smart_house/sql/ScriptSQL.sql
}

rodarMysql