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
 *  This template has been modified from the original to format some emails for the Post-Travel form.
 *	Last Update By: Cole Cooper (colecoop@ksu.edu)
 *	Last Update Date: 7/3/2012
 *
 */
?>
Kansas State University - Computing and Information Sciences<br />
Post-Travel Form Submission<br />

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
print "<tr><td>Traveler Name</td><td>" . $submission["data"][1]["value"][0] . "</td></tr>";
print "<tr><td>Traveler Email</td><td>" . $submission["data"][8]["value"][0] .  "</td></tr>";
print "<tr><td>Travel Destination</td><td>" . $submission["data"][2]["value"][0] . "</td></tr>";
print "<tr><td>Destination Type</td><td>%value[destination_type]</td></tr>";
print "<tr><td>Is this a multi-destination or<br /> mixed business/personal trip?</td><td>" . $submission["data"][25]["value"][0] . "</td></tr>";
print "</table>";

////////////////////////////////
// Trip Dates, Times, and Length
////////////////////////////////
print "<hr />";
print "<b>Trip Dates</b>";
print "<table border=\"1\">";
print "<tr><td>Date Left</td><td>" . date('F j, Y', strtotime($submission["data"][4]["value"][0])) . "</td>";
print "<td>Time Left</td><td>" . date('g:ia', strtotime($submission["data"][5]["value"][0])) . "</td></tr>";
print "<tr><td>Date Returned</td><td>" . date('F j, Y', strtotime($submission["data"][6]["value"][0])) . "</td>";
print "<td>Time Returned</td><td>" . date('g:ia', strtotime($submission["data"][7]["value"][0])) . "</td></tr>";
print "<tr><td>Trip Length</td><td>" . $submission["data"][45]["value"][0] .  " days</td><td></td></tr>";
print "</table>";

//////////////////////
// Trip Costs
//////////////////////
print "<hr />";
print "<b>Costs</b>";
print "<table border=\"1\">";
print "<tr><td>Airfare</td><td>" . @money_format('$%i', $submission["data"][11]["value"][0]) . "</td>";
print "<td>Lodging/Hotel</td><td>" . @money_format('$%i', $submission["data"][9]["value"][0]) . "</td></tr>";
print "<tr><td>Tolls</td><td>" . @money_format('$%i', $submission["data"][10]["value"][0]) . "</td>";
print "<td>Taxi</td><td>" . @money_format('$%i', $submission["data"][12]["value"][0]) . "</td></tr>";
print "<tr><td>Rental Car</td><td>" . @money_format('$%i', $submission["data"][14]["value"][0]) . "</td>";
print "<td>Roadrunner</td><td>" . @money_format('$%i', $submission["data"][15]["value"][0]) . "</td></tr>";
print "<tr><td>Parking</td><td>" . @money_format('$%i', $submission["data"][16]["value"][0]) . "</td>";
print "<td>Registration Fees</td><td>" . @money_format('$%i', $submission["data"][17]["value"][0]) . "</td></tr>";
print "<tr><td>" . $submission["data"][27]["value"][0] . "</td><td>" . @money_format('$%i', $submission["data"][30]["value"][0]) . "</td>";
print "<td>" . $submission["data"][28]["value"][0] . "</td><td>" . @money_format('$%i', $submission["data"][31]["value"][0]) . "</td></tr>";
print "<tr><td>" . $submission["data"][29]["value"][0] . "</td><td>" . @money_format('$%i', $submission["data"][32]["value"][0]) . "</td><td></td></tr>";
print "</table>";

////////////////////////
// Vehilce and Mileage
////////////////////////
print "<hr />";
print "<b>Vehicle and Mileage</b>";
print "<table border=\"1\">";
print "<tr><td>Private Vehicle Type</td><td>%value[vehicle_type]</td></tr>";
print "<tr><td>Private Vehicle Mileage</td><td>" . $submission["data"][13]["value"][0] . " miles</td></tr>";
print "<tr><td>Private Vehicle Cost</td><td>" . @money_format('$%i', $submission["data"][49]["value"][0]) . "</td></tr>";
print "</table>";

///////////////////////
// The per-diem table 
///////////////////////
print "<hr />";
if($submission["data"][3]["value"][0] == 'Yes')
{
	print "<b>Per-diem: multi-destination or mixed  business/personal trip</b>";
}
else if($submission["data"][45]["value"][0] == 'Single Day')
{
	print "<b>Per-diem: not applicable</b>";
}
else{
	print "<b>Per-diem</b>";
	print "<table border=\"1\">";
	print "<tr><td>Per-diem breakfasts</td><td>" . $submission["data"][41]["value"][0] .  "</td>";
	print "<td>Per-diem lunches</td><td>" . $submission["data"][42]["value"][0] .  "</td>";
	print "<td>Per-diem dinners</td><td>" . $submission["data"][43]["value"][0] .  "</td></tr>";
	print "<tr><td>Paid breakfasts</td><td>" . $submission["data"][18]["value"][0] .  "</td>";
	print "<td>Paid lunches</td><td>" . $submission["data"][19]["value"][0] .  "</td>";
	print "<td>Paid dinners</td><td>" . $submission["data"][20]["value"][0] .  "</td></tr>";
	print "</table>";
	print "<b>Per-diem reimbursement</b><br />";
	print "<table border=\"1\">";
	print "<tr><th>Date</th><th>Per-diem amount</th></tr>";
	print $submission["data"][50]["value"][0];  // Per-diem table string
	print "<tr><td>Less Meals Provided</td><td>-" . @money_format('$%i', $submission["data"][47]["value"][0]) . "</td></tr>";
	print "<tr><td>Total per-diem amount</td><td>" . @money_format('$%i', $submission["data"][48]["value"][0]) . "</td></tr>";
	print "</table>";
}

///////////////////////
// Lodging
///////////////////////
print "<hr />";
print "<b>Lodging</b><br />";
print "Was the room shared with anyone other than a colleague? %value[shared_room]<br />";

//////////////////////////////
// Comments
//////////////////////////////
print "<hr />";
print "<b>Comments</b><br />"; 
print $submission["data"][22]["value"][0];

////////////////////////////////
// Estimated total reimbursement
////////////////////////////////
print "<hr />";
print "<b>Total</b><br />";
print "Estimated total reimbursement: <b>" . @money_format('$%i', $submission["data"][44]["value"][0]) . "</b><br />";
print "(Actual amount will be based on processing of submissions by accountant)<br />";

?>
