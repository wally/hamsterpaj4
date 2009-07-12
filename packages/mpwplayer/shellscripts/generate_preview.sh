#!/bin/bash
# this script creates a a thumbnail from a flv file

if [ $#  = '3' ]; then
	destfile=`basename $1`
	destfile=`echo ${destfile%%.*}`
	ffmpeg -i $1 -an -ss $2 -an -r 1 -vframes 1 -y -f mjpeg $3
else
	echo you have to provide 3 parameters Video Name and The Image Time 00.00.00 format and then destination
fi
