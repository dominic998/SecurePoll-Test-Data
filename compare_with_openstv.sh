#!/bin/bash

while getopts "f:p:d:" o
do
    case "${o}" in
	f)
	    blt_file=${OPTARG}
	    ;;
	p)
	    php_file=${OPTARG}
	    ;;
	d)
	    directory=${OPTARG}
	    ;;
	*)
	    echo "Usage: $0 [-f <ballot file> -p <php file>] [-d <directory>]"
	    exit
	    ;;
    esac
done
if [[ ( -z $blt_file || -z $php_file ) && -z $directory ]]
then
    echo "Usage: $0 [-f <ballot file> -p <php file>] [-d <directory>]"
    exit
fi

if [[ -n $directory ]]
then
    for blt_file in $directory/*.blt
    do
	php_file=$blt_file".php"
	BLT_FILE=$blt_file PHP_FILE=$php_file php comparison.php
    done
fi

if [[ -n $blt_file && -n $php_file ]]
then
    BLT_FILE=$blt_file PHP_FILE=$php_file php comparison.php
fi

