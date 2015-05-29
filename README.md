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

The simplest way to run the Installer is using PHP 5.4+'s embedded web server:

1.  $ git clone https://github.com/DataShades/ckan-installer.git
2.  $ cd ckan-installer
3.  $ php -S localhost:8000
4.  Then open http://localhost:8000/ in your web browser.


### Note

a.  Installer script does not install CKAN instance and it dependencies.

b.  It is strongly not recommended to use PHP embedded web server on a public network.

## Copying and License
This material is copyright © 2015 Link Web Services Pty Ltd

It is open and licensed under the GNU Affero General Public License (AGPL) v3.0 whose full text may be found at:

http://www.fsf.org/licensing/licenses/agpl-3.0.html
