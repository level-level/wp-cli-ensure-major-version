# Introduction

WP-CLI currently only has the possibility to either update minor versions
based on the currently installed version, or forcing a specific version.

Sometime you want to force a certain major version in order to stay compatible,
while still profiting from security patches and bugfixes in minor versions.

This extension inherits the core functionality and adds and `ensure` command.
The command allows the user to force a certain major version to be installed,
while still updating to the latest minor release which is compatible.

# Examples

`wp ensure_major_version ensure 4.7` would install the latest minor version
within the 4.7 major version. At the time of writing this command would install
version 4.7.1 of WordPress.

`wp ensure_major_version ensure 4.3` will install force WordPress to the latest
minor release within the 4.3 major. At the time of writing this command would
install version 4.3.7 of WordPress.