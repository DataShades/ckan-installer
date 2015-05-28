# CKAN Installer script
A script that helps to preconfigure CKAN config file before installation. If CKAN already installed it helps to configure params and create SysAdmin user.

## Requirements
Configured php and web server.

## About
1.  checks requirements for CKAN
    * Python
    * PostgreSQL
    * pip
    * virtualenv
    * Git
    * OpenJDK
2.  Change main CKAN configs like _Site logo, Site Title_ etc.
3.  Enable and configure S3 connector it needed
4.  If CKAN installed ability to create Sys admin user

## Usage
This instruction describe how to run installer.
For Ubuntu or Debian OS

1.  Run _sudo apt-get install php5 apache2_
2.  Download source code of Installer
3.  Create apache vhost conf file in folder /etc/apache/sites-enabled using manual https://httpd.apache.org/docs/2.2/vhosts/examples.html and point host to the CKAN installer folder
4.  Run created host in browser and follow instructions.


### Note
Installer script does not install CKAN instance and it dependencies.

## Copying and License
This material is copyright © 2015 Link Web Services Pty Ltd

It is open and licensed under the GNU Affero General Public License (AGPL) v3.0 whose full text may be found at:

http://www.fsf.org/licensing/licenses/agpl-3.0.html
