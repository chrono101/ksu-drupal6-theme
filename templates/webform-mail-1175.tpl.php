<?php
// $Id: webform-mail.tpl.php,v 1.1.2.5 2009/11/06 00:59:47 quicksketch Exp $

/**
 * " . @file
 * Customize the e-mails sent by Webform after successful submission.
 *
 * This file may be renamed "webform-mail-[nid].tpl.php" to target a
 * specific webform e-mail on your site. Or you can leave it
 * "webform-mail.tpl.php" to affect all webform e-mails on your site.
 *
 * Available variables:
 * - $form_values: The values submitted by the user.
 * - $node: The node object for this webform.
 * - $user: The current user submitting the form.
 * - $ip_address: The IP address of the user submitting the form.
 * - $sid: The unique submission ID of this submission.
 * - $cid: The component for which this e-mail is being sent.
 *
 * The $cid can be used to send different e-mails to different users, such as
 * generating a reciept-type e-mail to send to the user that filled out the
 * form. Each form element in a webform is assigned a CID, by doing special
 * logic on CIDs you can customize various e-mails.
 * 
 *  This template has been modified from the original to format some emails for the Faculty Leave Report form.
 *	Last Update By: Cole Cooper (colecoop@ksu.edu)
 *	Last Update Date: 11/5/2010
 *
 */
?>
Kansas State University - Computing and Information Sciences<br />
Faculty Leave Report Form Submission<br />

<?php print "Submitted on: " . format_date(time(), 'small') ?><br />
<?php if ($user->uid): ?>
<?php print "Submitted by user: " . $user->name  . " at IP address %ip_address" ?>
<?php else: ?>
<?php print "Submitted by an anonymous user at IP address %ip_address" ?><br /><br />
<?php endif; ?>

<?php $submission = (array) $submission ?>

<?php  
print "<hr />";
print "<b>Faculty Leave Report Info</b>";
print "<table border=\"1\">";
print "<tr><td>Traveler Name</td><td>" . $submission["data"][1]["value"][0] . "</td></tr>";
print "<tr><td>Traveler Email</td><td>" . $submission["data"][2]["value"][0] .  "</td></tr>";
print "<tr><td>Travel Destination</td><td>" . $submission["data"][3]["value"][0] . "</td></tr>";
print "<tr><td>Purpose of Travel</td><td>" . $submission["data"][4]["value"][0] . "</td></tr>";
print "<tr><td>From Date</td><td>" . date('F j, Y', strtotime($submission["data"][5]["value"][0])) . "</td></tr>";
print "<tr><td>To Date</td><td>" . date('F j, Y', strtotime($submission["data"][6]["value"][0])) . "</td></tr>";
print "<tr><td>Total Hours Requested</td><td>" . $submission["data"][8]["value"][0] . "</td></tr>";
print "<tr><td>Leave Type</td><td>%value[leave_type]</td></tr>";
print "<tr><td>Other</td><td>" . $submission["data"][9]["value"][0] . "</td></tr>";
print "</table>";

print "<br /><br />       Traveler: __________________________________________    Date: " . format_date(time(), 'small');
print "<br /><br />Department Head: __________________________________________    Date: " . format_date(time(), 'small');

?>
