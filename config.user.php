<?php
/*! pimpmylog - 1.7.10 - 65d6f147e509133fc5f09642ba82b149ef750ef2*/
/*
 * pimpmylog
 * http://pimpmylog.com
 *
 * Copyright (c) 2015 Potsky, contributors
 * Licensed under the GPLv3 license.
 */
?>
<?php if(realpath(__FILE__)===realpath($_SERVER["SCRIPT_FILENAME"])){header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');die();}?>
{
	"globals": {
		"AUTH_LOG_FILE_COUNT"         : 3,
		"AUTO_UPGRADE"                : false,
		"CHECK_UPGRADE"               : true,
		"EXPORT"                      : true,
		"FILE_SELECTOR"               : "bs",
		"FOOTER"                      : "&copy; <a href=\"http:\/\/www.potsky.com\" target=\"doc\">Potsky<\/a> 2007-' . YEAR . ' - <a href=\"http:\/\/pimpmylog.com\" target=\"doc\">Pimp my Log<\/a>",
		"FORGOTTEN_YOUR_PASSWORD_URL" : "http:\/\/support.pimpmylog.com\/kb\/misc\/forgotten-your-password",
		"GEOIP_URL"                   : "http:\/\/www.geoiptool.com\/en\/?IP=%p",
		"GOOGLE_ANALYTICS"            : "UA-XXXXX-X",
		"HELP_URL"                    : "http:\/\/pimpmylog.com",
		"LOCALE"                      : "gb_GB",
		"LOGS_MAX"                    : 50,
		"LOGS_REFRESH"                : 0,
		"MAX_SEARCH_LOG_TIME"         : 5,
		"NAV_TITLE"                   : "",
		"NOTIFICATION"                : true,
		"NOTIFICATION_TITLE"          : "New logs [%f]",
		"PIMPMYLOG_ISSUE_LINK"        : "https:\/\/github.com\/potsky\/PimpMyLog\/issues\/",
		"PIMPMYLOG_VERSION_URL"       : "http:\/\/demo.pimpmylog.com\/version.js",
		"PULL_TO_REFRESH"             : true,
		"SORT_LOG_FILES"              : "default",
		"TAG_DISPLAY_LOG_FILES_COUNT" : true,
		"TAG_NOT_TAGGED_FILES_ON_TOP" : true,
		"TAG_SORT_TAG"                : "default | display-asc | display-insensitive | display-desc | display-insensitive-desc",
		"TITLE"                       : "Pimp my Log",
		"TITLE_FILE"                  : "Pimp my Log [%f]",
		"UPGRADE_MANUALLY_URL"        : "http:\/\/pimpmylog.com\/getting-started\/#update",
		"USER_CONFIGURATION_DIR"      : "config.user.d",
		"USER_TIME_ZONE"              : "Europe\/Paris"
	},

	"badges": {
		"severity": {
			"debug"       : "success",
			"info"        : "success",
			"notice"      : "default",
			"Notice"      : "info",
			"warn"        : "warning",
			"error"       : "danger",
			"crit"        : "danger",
			"alert"       : "danger",
			"emerg"       : "danger",
			"Notice"      : "info",
			"Fatal error" : "danger",
			"Parse error" : "danger",
			"Warning"     : "warning"
		},
		"http": {
			"1" : "info",
			"2" : "success",
			"3" : "default",
			"4" : "warning",
			"5" : "danger"
		}
	},

	"files": {
		"syslog": {
			"display" : "Drupal",
			"path"    : "\/var\/log\/syslog", //set your Drupal syslog file path
			"refresh" : 5,
			"max"     : 10,
			"notify"  : true,
            "order"     : -1,//set order you want
            "sort"      : "Date",
            "thinit" : [ "Date", "Site", "Type", "Request", "Referer", "UID", "Message" ],
			"format"  : {
				"regex"        : "|^.*drupal: (.*)\\|(.*)\\|(.*)\\|(.*)\\|(.*)\\|(.*)\\|(.*)\\|(.*)\\|(.*)$|U",
				"export_title" : "Drupal",
				"match"        : {
                    "Site"     : 1,
                    "Date"     : {
                      "U" : 2
                    },
                    "Type"     : 3,
                    "IP"       : 4,
                    "Request"  : 5,
                    "Referer"  : 6,
                    "UID"      : 7,
                    "Link"     : 8,
                    "Message"  : 9
				},
				"types": {
					"Site"     : "link",
                    "Date"     : "date:Y-m-d H:i:s",
                    "Type"     : "txt",
                    "IP"       : "ip:http",
                    "Request"  : "txt",
                    "Referer"  : "link",
                    "UID"      : "txt",
                    "Link"     : "link",
                    "Message"  : "pre"
                },
				"exclude": {
				}
			}
		},
		"apache1": {
			"display"   : "Apache Error #1",
			"path"      : "\/var\/log\/apache2\/error.log",
			"refresh"   : 5,
			"max"       : 10,
			"notify"    : true,
			"multiline" : "",
			"format"    : {
				"regex"        : "|^\\[(.*)\\] \\[(.*)\\] (\\[client (.*)\\] )*((?!\\[client ).*)(, referer: (.*))*$|U",
				"export_title" : "Log",
				"match"        : {
					"Date"     : 1,
					"IP"       : 4,
					"Log"      : 5,
					"Severity" : 2,
					"Referer"  : 7
				},
				"types": {
					"Date"     : "date:H:i:s",
					"IP"       : "ip:http",
					"Log"      : "pre",
					"Severity" : "badge:severity",
					"Referer"  : "link"
				},
				"exclude": {
					"Log": ["\/PHP Stack trace:\/", "\/PHP *[0-9]*\\. \/"]
				}
			}
		},
		"apache2": {
			"display"   : "Apache Access #2",
			"path"      : "\/var\/log\/apache2\/access.log",
			"refresh"   : 0,
			"max"       : 10,
			"notify"    : false,
			"multiline" : "",
			"format"    : {
				"regex"        : " |^(.*) (.*) (.*) \\[(.*)\\] \"(.*) (.*) (.*)\" ([0-9]*) (.*) \"(.*)\" \"(.*)\"( [0-9]*\/([0-9]*))*$|U",
				"export_title" : "URL",
				"match"        : {
					"Date"    : 4,
					"IP"      : 1,
					"CMD"     : 5,
					"URL"     : 6,
					"Code"    : 8,
					"Size"    : 9,
					"Referer" : 10,
					"UA"      : 11,
					"User"    : 3,
					"\u03bcs" : 13
				},
				"types": {
					"Date"    : "date:H:i:s",
					"IP"      : "ip:geo",
					"URL"     : "txt",
					"Code"    : "badge:http",
					"Size"    : "numeral:0b",
					"Referer" : "link",
					"UA"      : "ua:{os.name} {os.version} | {browser.name} {browser.version}\/100",
					"\u03bcs" : "numeral:0,0"
				},
				"exclude": {
					"URL": ["\/favicon.ico\/", "\/\\.pml\\.php.*$\/"],
					"CMD": ["\/OPTIONS\/"]
				}
			}
		}
	}
}
