osTicket-Zulip
==============
An plugin for [osTicket](https://osticket.com) which posts notifications to a [Slack](https://slack.com) channel.

Forked from: [https://github.com/clonemeagain/osticket-slack](https://github.com/clonemeagain/osticket-slack)
Which was originally forked from: [https://github.com/thammanna/osticket-slack](https://github.com/thammanna/osticket-slack).

Install
--------
Clone this repo or download the zip file and place the contents into your `include/plugins` folder.

Info
------
This plugin uses CURL and tested on osTicket-1.10.1

## Requirements
- php_curl
- A Zulip bot account configured to be a incoming webhook

## To Install into zulip 
- Access your Zulip system in a web browser
- Click the gear in the upp, right-hand corner, select 'Settings'
- Select 'Your Bots'
- Select 'Add a new bot'
- Select "Incoming Webook", Give a name to your bot and record your settings to be added to the osTicket configuration.
- Click "Create Bot"

## Adding the plugin to osTicket
- Copy the osticket-zulip directory to <osticker base directory>/include/plugins (maintaining acceptable file permissions)
- From the osTicket Admin Panel, click "Manage", "Plugins", and "Add New Plugin". Add the new plugin.
- From the Plugins panel, click your plugin name and enter the credentials and other details such as stream name.


## Test!
Create a ticket!

You should see something like the following appear in your Slack channel:

(add link to screenshot)

When a user replies, you'll get something like:

(add link to screenshot)

