# Script to backup mysql databases
# Current databases: check phpmyadmin for dbnames
# in example using folowing:
# db Name Discription
# ------------ --------------- 
#	limesurvey - Lime Survey
#
# Each database will be backed up into a .sql file then ziped.
# The date will be added to the file.
# the www data will be copied into a zip file
#
#
# Starting Script
# Set Date
#
dt=`date +"%d-%m-%y"`
#
#	Set mysql user password ** MUST BE SET
#	
DBPASS=nyuurban
#
#	Change to backup directory ** MUST BE SET
bd=/home/ns3184/backup
cd $bd

#
# Add your mysql databases to be backed up below. 
# Lime Survey - DBNAME limeSurvey
#
# UNCOMMENT LINES BELOW
#
DBNAME=nyuurban
/usr/bin/mysqldump --opt -u root -p$DBPASS $DBNAME > $DBNAME$dt.sql
# Copy www data
# Data paths:
#	lime survey /home/username/path
#
# Change File names as desired below: 
# zip -r $bd/survey_data /home/ooz/www/survey/
tar -cf sql_backup$dt.tar ./*.sql 
#
# now copy to dated folder
mkdir $dt
cp -rf ./*.tar $dt
#
# Clean up
rm ./*.sql
rm ./*.tar
# end of script
