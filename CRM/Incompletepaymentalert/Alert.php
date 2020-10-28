<?php

class CRM_Incompletepaymentalert_Alert {

  /**
   * Send notification for incomplete payments.
   */
  public static function sendNotification($params) {
    $incompletePayments = civicrm_api3('Contribution', 'get', [
      'sequential' => 1,
      'return' => ["contribution_page_id", "total_amount", "contact_id", "receive_date", "contribution_status_id"],
      'is_pay_later' => 0,
      'contribution_status_id' => ['IN' => ["Pending", "Failed"]],
      'receive_date' => ['>=' => date('Y-m-d H:i:s', strtotime("-1 day"))],
      'options' => ['limit' => 0],
    ]);
    if (empty($incompletePayments['count'])) {
      return;
    }
    $html = '<html><head></head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
    <body>
    <table style="font-family: Arial, Verdana, sans-serif; text-align: left; width:100%; max-width:700px; padding:0; margin:0; border:0px;">
      <tbody>
        <tr>
          <th  style="text-align: left; padding: 4px; border-bottom: 1px solid #999; background-color: #eee;">Display Name</th>
          <th  style="text-align: left; padding: 4px; border-bottom: 1px solid #999; background-color: #eee;">Contribution Amount</th>
          <th  style="text-align: left; padding: 4px; border-bottom: 1px solid #999; background-color: #eee;">Contribution Page</th>
          <th  style="text-align: left; padding: 4px; border-bottom: 1px solid #999; background-color: #eee;">Received Date</th>
          <th  style="text-align: left; padding: 4px; border-bottom: 1px solid #999; background-color: #eee;">Status</th>
        </tr>';

    foreach ($incompletePayments['values'] as $payments) {
      $url = CRM_Utils_System::url('civicrm/contact/view',
        "reset=1&cid={$payments['contact_id']}", TRUE
      );
      $total = empty($payments['total_amount']) ? ' - ' : $payments['total_amount'];
      $pageID = empty($payments['contribution_page_id']) ? ' - ' : $payments['contribution_page_id'];
      $receiveDate = empty($payments['receive_date']) ? ' - ' : $payments['receive_date'];
      $status = empty($payments['contribution_status']) ? ' - ' : $payments['contribution_status'];

      $row = "<tr>";
      $row .= "<td style='padding: 4px; border-bottom: 1px solid #999;'><a href='{$url}'>" .  CRM_Contact_BAO_Contact::displayName($payments['contact_id']) . "</a></td>";
      $row .= "<td style='padding: 4px; border-bottom: 1px solid #999;'>" . CRM_Utils_Money::format($total) . "</td>";
      $row .= "<td style='padding: 4px; border-bottom: 1px solid #999;'>" . $pageID . "</td>";
      $row .= "<td style='padding: 4px; border-bottom: 1px solid #999;'>" . CRM_Utils_Date::customFormat($receiveDate) . "</td>";
      $row .= "<td style='padding: 4px; border-bottom: 1px solid #999;'>" . $status . "</td>";
      $row .= "</tr>";
      $html .= $row;
    }

    $html .= '
      </tbody>
    </table>
    </body>
    </html>';

    $mailParams = [
      'from' => CRM_Core_BAO_Domain::getNoReplyEmailAddress(),
      'toName' => $params['toName'] ?? '',
      'toEmail' => $params['toEmail'],
      'subject' => 'Incomplete Payment Alert',
    ];
    if (!empty($params['cc'])) {
      $mailParams['cc'] = $params['cc'];
    }
    $mailParams['html'] = $html;
    $result = CRM_Utils_Mail::send($mailParams);
    if (!$result || is_a($result, 'PEAR_Error')) {
      return ['email_fail' => 'Failed to send message'];
    }
  }

}