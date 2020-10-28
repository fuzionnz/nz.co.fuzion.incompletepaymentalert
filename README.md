# nz.co.fuzion.incompletepaymentalert

Send email alerts to admins(or custom email) for incomplete & failed payments recorded in last 1 day.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.4+
* CiviCRM (*FIXME: Version number*)

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl nz.co.fuzion.incompletepaymentalert@https://github.com/fuzionnz/nz.co.fuzion.incompletepaymentalert/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/fuzionnz/nz.co.fuzion.incompletepaymentalert.git
cv en incompletepaymentalert
```

## Usage

- Install the extension. This creates a new scheduled job "Send Incomplete/Failed payment alerts" configured to send daily.
- Edit the job and enter toName, toEmail, cc value. Save.
- This should send an email for the payments which are incomplete and failed from last 1 day.
