#!/bin/bash

unit_test_file=extensions/SecurePoll/tests/phpunit/unit/STVTallierTest_drw.php

while getopts "f:u" o
do
    case "${o}" in
	f)
	    blt_file=${OPTARG}
	    ;;
	u)
	    update=1
	    ;;
	*)
	    echo "Usage: $0 -f <ballot file> [-u]"
	    exit
	    ;;
    esac
done
if [ -z $blt_file ]
then
    echo "Usage: $0 -f <ballot file> [-u]"
    exit
fi

# https://raw.githubusercontent.com/dominic998/SecurePoll-Test-Data/main/STVTallierTest_drw.php
# Download unit test if it does not exist
if [[ ! -f $unit_test_file || -n $update ]]
then
    wget -r https://raw.githubusercontent.com/dominic998/SecurePoll-Test-Data/main/STVTallierTest_drw.php -O $unit_test_file
fi

FILE=$blt_file php tests/phpunit/phpunit.php $unit_test_file
