<?php

/**
 * @file
 * Customize the display of a complete webform.
 *
 * This file may be renamed "webform-form-[nid].tpl.php" to target a specific
 * webform on your site. Or you can leave it "webform-form.tpl.php" to affect
 * all webforms on your site.
 *
 * Available variables:
 * - $form: The complete form array.
 * - $nid: The node ID of the Webform.
 *
 * The $form array contains two main pieces:
 * - $form['submitted']: The main content of the user-created form.
 * - $form['details']: Internal information stored by Webform.
 *
 * This template has been modified to insert some custom jQuery to implement
 * the requested behaviors for the Purchase Requisition form
 * Last Update By: Cole Cooper (colecoop@ksu.edu)
 * Last Update Date: 8/13/2012
 *
 */
?>
<?php
  drupal_add_js('
  $(document).ready(function() {
        // Copy the current table value to the hidden field value
        $("#edit-submitted-items-table-values").val($("#webform-component-items-table").html());

        // Hide some fields initially.
        $("#webform-component-property-number").hide();
        $("#webform-component-are-these-items-included-in-your-budget-justification-for-the-grant").hide();
        $("#webform-component-grant-justification").hide();

        // Show/Hide fields based on answers to some questions.
        // System more than $5,000 - Yes
        $("#edit-submitted-is-this-purchase-part-of-a-larger-system-valued-over-5000-1").click(function() {
          if ($("#edit-submitted-is-this-purchase-part-of-a-larger-system-valued-over-5000-1").attr("checked")) {
              $("#webform-component-property-number").show();
          }
        });

        // System more than $5,000 - No
        $("#edit-submitted-is-this-purchase-part-of-a-larger-system-valued-over-5000-2").click(function() {
          if ($("#edit-submitted-is-this-purchase-part-of-a-larger-system-valued-over-5000-2").attr("checked")) {
              $("#webform-component-property-number").hide();
          }
        });

        // Charge to grant account - Yes
        $("#edit-submitted-is-this-purchase-to-be-charged-to-a-grant-account-1").click(function() {
          if ($("#edit-submitted-is-this-purchase-to-be-charged-to-a-grant-account-1").attr("checked")) {
              $("#webform-component-are-these-items-included-in-your-budget-justification-for-the-grant").show();
          }
        });

        // Charge to grant account - No
        $("#edit-submitted-is-this-purchase-to-be-charged-to-a-grant-account-2").click(function() {
          if ($("#edit-submitted-is-this-purchase-to-be-charged-to-a-grant-account-2").attr("checked")) {
              $("#webform-component-are-these-items-included-in-your-budget-justification-for-the-grant").hide();

              $("#edit-submitted-grant-justification").val("");
              $("#webform-component-grant-justification").hide();

          }
        });

        // Included in Budget Justification - Yes
        $("#edit-submitted-are-these-items-included-in-your-budget-justification-for-the-grant-1").click(function () {
          if ($("#edit-submitted-are-these-items-included-in-your-budget-justification-for-the-grant-1").attr("checked")) {
              $("#webform-component-grant-justification").hide();
              $("#edit-submitted-grant-justification").val("");
          }
        });

        // Included in Budget Justification - No
        $("#edit-submitted-are-these-items-included-in-your-budget-justification-for-the-grant-2").click(function () {
          if ($("#edit-submitted-are-these-items-included-in-your-budget-justification-for-the-grant-2").attr("checked")) {
              $("#webform-component-grant-justification").show();
          }
        });

        // Remove commas from numeric inputs
        $("#itemQty").blur(function() {
          $("#itemQty").val(stripMoneyFormat($("#itemQty").val()));
        });

        $("#itemUnitPrice").blur(function() {
            $("#itemUnitPrice").val(stripMoneyFormat($("#itemUnitPrice").val()));
        });

    });

    // Used to generate unique row ID
    var curRowId = 0;

    /*
     * function addItem() - Adds Items to the Item Table
     * Parameters: none
     * Returns: nothing
     * This function fires off after the "addItem" button is pressed. Reads in 
     * values from several input fields with the given IDs, then adds that item
     * to the item table (both the markup and the hidden field)
     */
    function addItem() {
        // Get the item information from the fields
        var qty = parseFloat($("#itemQty").val());
        var vendor = $("#itemVendor").val();
        var desc = $("#itemDesc").val();
        var laymanDesc = $("#itemLaymanDesc").val();
        var unitPrice = parseFloat($("#itemUnitPrice").val());
        var amount = (qty * unitPrice).toFixed(2);

        // Do some error handling on the numeric inputs (qty and unitPrice)
        if(isNaN(qty)) {
            alert("Error: Qty must be a number!");
            $("#itemQty").addClass("error");
            return;
        }
        if(isNaN(unitPrice)) {
            alert("Error: Unit Price must be a number!");
            $("#itemUnitPrice").addClass("error");
            return;
        }

        // Clear the fields after we have the info
        $("#itemQty").val("").removeClass("error");
        $("#itemVendor").val("");
        $("#itemDesc").val("");
        $("#itemLaymanDesc").val("");
        $("#itemUnitPrice").val("").removeClass("error");
        
        // Generate a new rowID
        var rowId = "item-" + curRowId;
        // Construct the table row variable
        var row = "<tr id=\"" + rowId + "\"><td>" + qty + "</td><td>" + vendor + "</td><td>" + desc + "<br /><hr />"+ laymanDesc + "</td><td>" + addMoneyFormat(unitPrice) + "</td><td>" + addMoneyFormat(amount) + "</td><td><input type=\"button\" value=\"Delete Item\" onclick=\"delItem(\'" + rowId + "\')\" /></td></tr>";
        // Increment the rowId counter;
        curRowId++;

        // Add it to the item table
        $("#itemsTableHeader").after(row);

        // Update the total
        var oldTotal = parseFloat(stripMoneyFormat($("#totalCost").html()));
        var newTotal = addMoneyFormat(oldTotal + parseFloat(amount));
        $("#totalCost").html(newTotal);

        // Copy the current table value to the hidden field value
        $("#edit-submitted-items-table-values").val($("#webform-component-items-table").html());
    }

    /*
     * function delItem() - Deletes Items from the Item Table
     * Parameters: id - The ID of the row to delete
     * Returns: nothing
     * This function is called by the links in the Item Table that say
     * "delete item". This function finds the current <tr> that was 
     * passed in via parameter updates the totalCost, and then removes 
     * the <tr> from the DOM.
     */
    function delItem(rowId) {
        // Remove the row amount from the total
        var oldTotal = parseFloat(stripMoneyFormat($("#totalCost").html()));
        var amount = parseFloat(stripMoneyFormat($("#" + rowId + " td:nth-child(5)").html()));
        var newTotal = addMoneyFormat((oldTotal - amount).toFixed(2));
        $("#totalCost").html(newTotal);
        // Remove the row from the DOM
        $("#" + rowId).remove();
    }

    /*
     * function stripMoneyFormat() - Strips commas from a numeric string
     * Example: "1,234,567.89" becomes "1234567.89"
     * Parameters: str - The string to strip commas from
     * Returns: string, with the commas removed
     *
     * Example taken from: http://www.josscrowcroft.com/2011/code/format-unformat-money-currency-javascript/
     */
    function stripMoneyFormat(str) {
      return str.replace(/[^0-9-.]/g, "");
    }

    /*
     * function addMoneyFormat() - Formats a string like money
     * Example: "123456.89" becomes "$1,234,567.89"
     * Parameters: number   - the number to format
     *             places   - the number of decimal places to take it out to
     *             symbol   - the monetary symbol, e.g. $
     *             thousand - the thousands seperator, e.g. ,
     *             decimal  - the decimal seperator, e.g. .
     *  Returns: string, formatted like money
     *
     *  Example taken from: http://www.josscrowcroft.com/2011/code/format-unformat-money-currency-javascript/
     */
    function addMoneyFormat(number, places, symbol, thousand, decimal) {
        number = number || 0;
        places = !isNaN(places = Math.abs(places)) ? places : 2;
        symbol = symbol !== undefined ? symbol : "$";
        thousand = thousand || ",";
        decimal = decimal || ".";
        var negative = number < 0 ? "-" : "",
            i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
        return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
    }
  ',
  'inline'
  );
  
  // Print out the main part of the form.
  // Feel free to break this up and move the pieces within the array.
  print drupal_render($form['submitted']);

  // Always print out the entire $form. This renders the remaining pieces of the
  // form that haven't yet been rendered above.
  print drupal_render($form);
