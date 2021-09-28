#!/bin/bash

unit_test_file=extensions/SecurePoll/tests/phpunit/unit/STVTallierTest_drw.php
helpstr="Usage: $0 [-f <ballot file>] [-d <directory] [-u]"

while getopts "f:d:u" o
do
    case "${o}" in
	f)
	    blt_file=${OPTARG}
	    ;;
	u)
	    update=1
	    ;;
	d)
	    directory=${OPTARG}
	    ;;
	*)
	    echo $helpstr
	    exit
	    ;;
    esac
done
if [[ -z $blt_file && -z $directory ]]
then
    echo $helpstr
    exit
fi

# https://raw.githubusercontent.com/dominic998/SecurePoll-Test-Data/main/STVTallierTest_drw.php
# Download unit test if it does not exist
if [[ ! -f $unit_test_file || -n $update ]]
then
    wget -r https://raw.githubusercontent.com/dominic998/SecurePoll-Test-Data/main/STVTallierTest_drw.php -O $unit_test_file
fi

if [[ -n $directory ]]
then
    for blt_file in $directory/*.blt
    do
	FILE=$blt_file php tests/phpunit/phpunit.php $unit_test_file
    done
fi

if [[ -n $blt_file ]]
then
    FILE=$blt_file php tests/phpunit/phpunit.php $unit_test_file
fi
