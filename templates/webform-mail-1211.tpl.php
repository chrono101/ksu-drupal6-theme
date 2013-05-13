<?php

/**
 * @file
 * Customize the e-mails sent by Webform after successful submission.
 *
 * This file may be renamed "webform-mail-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-mail.tpl.php" to affect all webform e-mails on your site.
 *
 * Available variables:
 * - $node: The node object for this webform.
 * - $submission: The webform submission.
 * - $email: The entire e-mail configuration settings.
 * - $user: The current user submitting the form.
 * - $ip_address: The IP address of the user submitting the form.
 *
 * The $email['email'] variable can be used to send different e-mails to different users
 * when using the "default" e-mail template.
 *
 * This template has been modified to enable custom email formatting on Purchase Requisition Form
 * Last Update By: Cole Cooper (colecoop@ksu.edu)
 * Last Update Date: 7/3/2012
 *
 */
?>
Kansas State University - Computing and Information Sciences<br />
Purchase Requisition Form Submission<br />

<?php print "Submitted on: " . format_date(time(), 'small') ?><br />
<?php if ($user->uid): ?>
<?php print "Submitted by user: " . $user->name  . " at IP address %ip_address" ?><br />
<?php else: ?>
<?php print "Submitted by an anonymous user at IP address %ip_address" ?><br />
<?php endif; ?>

<?php $submission = (array)$submission; ?>

<?php
///////////////////////
// General Information
///////////////////////
print "<hr />";
print "<table border=\"1\" style=\"border-collapse:collapse;\">";
print "<tr><td>Requestor's Name</td><td>" . "%value[name]" . "</td><td>Is this purchase part of a larger system valued over $5,000?</td><td>" . "%value[is_this_purchase_part_of_a_larger_system_valued_over_5000]" . "</td></tr>";
print "<tr><td>Requestor's Email</td><td>" . "%value[email]" . "</td><td>Property Number</td><td>" . "%value[property_number]" . "</td></tr>";
print "<tr><td>Project Funding #</td><td>" . "%value[project_funding_number]" . "</td><td>Is this purchase to be charged to a grant account?</td><td>" . "%value[is_this_purchase_to_be_charged_to_a_grant_account]" . "</td></tr>";
print "<tr><td>State Contract #</td><td>" . "%value[state_contract_number]" . "</td><td>Are these items included in your budget justification for the grant?</td><td>" . "%value[are_these_items_included_in_your_budget_justification_for_the_grant]" . "</td></tr>";
print "<tr><td></td><td></td><td>Please include a 2-3 sentence justification to explain how these items will be used in support of this grant.</td><td>" . "%value[grant_justification]" . "</td></tr>";
print "<tr><td>Item(s) to be purchased by</td><td>" . "%value[items_to_be_purchased_by]" . "</td><td>Special Instructions / Notes</td><td>" . "%value[special_instructions___notes]" . "</td></tr>";
print "</table>";

///////////////
// Items Table
///////////////
print "<hr />";
print $submission["data"][15]["value"][0];

?>
