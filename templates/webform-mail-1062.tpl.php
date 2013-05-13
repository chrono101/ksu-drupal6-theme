<?php
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
 *  This template has been modified from the original to format some emails for the Pre-Travel form.
 *	Last Update By: Cole Cooper (colecoop@ksu.edu)
 *	Last Update Date: 7/12/2012
 *
 */
?>
Kansas State University - Computing and Information Sciences<br />
Pre-Travel Form Submission<br />

<?php print "Submitted on: " . format_date(time(), 'small') ?><br />
<?php if ($user->uid): ?>
<?php print "Submitted by user: " . $user->name  . " at IP address %ip_address" ?><br />
<?php else: ?>
<?php print "Submitted by an anonymous user at IP address %ip_address" ?><br />
<?php endif; ?>


<?php $submission = (array) $submission ?>

<?php  
/////////////////////
// General Trip Info
/////////////////////
print "<hr />";
print "<b>General Trip Info</b>";
print "<table border=\"1\">";
print "<tr><td>Traveler Name</td><td>" . $submission["data"][2]["value"][0] . "</td></tr>";
print "<tr><td>Position Title</td><td>%value[position_title]</td></tr>";
print "<tr><td>Traveler Email</td><td>" . $submission["data"][5]["value"][0] .  "</td></tr>";
print "<tr><td>Travel Destination</td><td>" . $submission["data"][3]["value"][0] . "</td></tr>";
print "<tr><td>Date Leaving</td><td>" . date('F j, Y', strtotime($submission["data"][7]["value"][0])) . "</td></tr>";
print "<tr><td>Date Returning</td><td>" . date('F j, Y', strtotime($submission["data"][8]["value"][0])) . "</td></tr>";
print "<tr><td>Meeting Date Beginning</td><td>" . date('F j, Y', strtotime($submission["data"][9]["value"][0])) . "</td></tr>";
print "<tr><td>Meeting Date Ending</td><td>" . date('F j, Y', strtotime($submission["data"][16]["value"][0])) . "</td></tr>";
print "<tr><td>Purpose of Travel</td><td>" . $submission["data"][6]["value"][0] . "</td></tr>";
print "<tr><td>Financial Justification</td><td>" . $submission["data"][55]["value"][0] . "</td></tr>";
print "<tr><td>Other KSU Travelers</td><td>" . $submission["data"][49]["value"][0] . "</td></tr>";
print "</table>";

//////////////////////////////
// KSU Account(s) Funding Travel
//////////////////////////////
print "<hr />";
print "<b>KSU Account(s) Funding Travel</b>";
print "<table border=\"1\">";
print "<tr><td>Account 1</td><td>" . $submission["data"][37]["value"][0] . "</td>";
print "<tr><td>Account 2</td><td>" . $submission["data"][38]["value"][0] . "</td>";
print "<tr><td>Account 3</td><td>" . $submission["data"][39]["value"][0] . "</td>";
print "<tr><td>Account 4</td><td>" . $submission["data"][40]["value"][0] . "</td>";
print "</table>";

//////////////////////
// Transportation Expenses
//////////////////////
print "<hr />";
print "<b>Transportation Expenses</b>";
print "<table border=\"1\">";
// Vehicles
print "<tr><td>Vehicle: %value[vehicle_fieldset][vehicle_type]</td><td>Destination: %value[vehicle_fieldset][vehicle_destination]</td></tr>";
// Airfare
print "<tr><td>Airfare Cost</td><td>" . @money_format('$%i', $submission["data"][12]["value"][0]) . "</td></tr>";
print "<tr><td>Purchased w/ Dept. Credit Card</td><td>%value[airfare_fieldset][using_department_credit_card]</td></tr>";
print "<tr><td>Departing Airport</td><td>" . $submission["data"][52]["value"][0]. "</td></tr>";
// Rental Car
print "<tr><td>Rental Car Cost</td><td>" . @money_format('$%i', $submission["data"][13]["value"][0]) . "</td></tr>";
print "</table>";

////////////////////////
// Other Expenses / Information
////////////////////////
print "<hr />";
print "<b>Other Expenses / Information </b>";
print "<table border=\"1\">";
print "<tr><td>Conference URL</td><td><a href=" . $submission["data"][27]["value"][0] . ">" . $submission["data"][27]["value"][0] . "</a></td></tr>";
print "<tr><td>Registration Fees</td><td>" . @money_format('$%i', $submission["data"][17]["value"][0]) . "</td></tr>";
print "<tr><td>Misc Costs: " . $submission["data"][25]["value"][0] . "</td><td>" . @money_format('$%i', $submission["data"][21]["value"][0]) . "</td></tr>";
print "<tr><td>Lodging Days</td><td>" . $submission["data"][14]["value"][0] . "</td></tr>";
print "<tr><td>Lodging Rate</td><td>" . @money_format('$%i', $submission["data"][15]["value"][0]) . "/night</td></tr>";
print "</table>";



//////////////////////////////
// Comments
//////////////////////////////
print "<hr />";
print "<b>Comments</b><br />";
 
print $submission["data"][29]["value"][0];

?>
