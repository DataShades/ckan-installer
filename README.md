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

1.  Run command _sudo apt-get install php5 apache2_
2.  Download source code of Installer
3.  Create apache vhost conf file in folder /etc/apache/sites-enabled using manual https://httpd.apache.org/docs/2.4/vhosts/examples.html and point host to the CKAN installer folder
4.  Run command _sudo service apache2 restart_
5.  Run created host in browser and follow instructions.

For Mac OS

1.  Run command _vi /etc/apache2/httd.conf_
2.  Uncomment the following line (remove #): _LoadModule php5_module libexec/apache2/libphp5.so_
3.  Find the following line:

    _#Include /private/etc/apache2/extra/httpd-vhosts.conf_

    Below it, add the following line:
    
    _Include /private/etc/apache2/vhosts/*.conf_

4.  Run command _mkdir /etc/apache2/vhosts; cd /etc/apache2/vhosts_
5.  Create apache vhost conf file in this folder  using manual https://httpd.apache.org/docs/2.4/vhosts/examples.html and point host to the CKAN installer folder
6.  Run created host in browser and follow instructions.


### Note
Installer script does not install CKAN instance and it dependencies.

## Copying and License
This material is copyright © 2015 Link Web Services Pty Ltd

It is open and licensed under the GNU Affero General Public License (AGPL) v3.0 whose full text may be found at:

http://www.fsf.org/licensing/licenses/agpl-3.0.html
