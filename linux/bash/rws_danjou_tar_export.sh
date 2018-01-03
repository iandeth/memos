#!/bin/sh
APPDIR=`dirname $0`
APPDIR=`cd $APPDIR;pwd`
CSVDIR="$APPDIR/../../db/ready_tsv"
CREYLEDIR="$APPDIR/creyle"
TARFILE=`date +$CREYLEDIR/%Y%m%d.tar.gz`
CREYLEFILE="$CREYLEDIR/creyle.tar.gz"
mkdir -p $CREYLEDIR
cd $CSVDIR
tar czf $TARFILE schools.tsv
rm -f $CREYLEFILE
ln -s $TARFILE $CREYLEFILE
find $CREYLEDIR -name *.tar.gz -ctime +2 -exec rm {} \;
