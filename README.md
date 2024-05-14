# Incomplete Payment Alerts

Send email alerts to admins(or custom email) for incomplete & failed payments recorded in last 1 day.

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.4+
* CiviCRM 5.27+

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

- Install the extension. This will create a new scheduled job `Send Incomplete/Failed Payment Alerts` configured to be sent daily.
- Edit the job and enter values for `toName`, `toEmail`, and `cc`. Save the changes.
- This will trigger an email to be sent for payments that are incomplete or failed within the last day.