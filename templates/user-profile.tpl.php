<div class="profile">
  <style type="text/css">
    .userpic {
      float: right;
      right: 5px;
      top: 0px;
      padding: 5px 5px 5px 5px;
    }
  </style>
  <?php drupal_set_title(check_plain($account->profile_name)) ?>
  <div class="userpic">
    <?php  if ($account->picture): ?>
      <img src="/<?php print $account->picture; ?>" alt="<?php print $account->profile_name; ?>" />
    <?php endif; ?>
  </div>
  <div class="fields">
    <?php if($account->profile_prof_title): ?>
      <b><?php print $account->profile_prof_title ?></b><br />
      <br />
    <?php endif ?>
    <?php if($account->profile_office_location): ?>
      Office: <?php print $account->profile_office_location; ?> (<a href="/map?rc=<?php print $account->profile_office_location; ?>">map</a>)<br />
    <?php endif ?>
    <?php if($account->profile_phone_number): ?>
      Phone: <?php print $account->profile_phone_number ?><br />
    <?php endif ?>
    <?php if($account->profile_fax_number): ?>
      Fax: <?php print $account->profile_fax_number ?><br />
    <?php endif; ?>
    Email: <?php print $account->mail ?><br />
    <?php if ($account->profile_show_webpage == '1'): ?>
      Webpage: <a href="http://people.cis.ksu.edu/~<?php print $account->name ?>">http://people.cis.ksu.edu/~<?php print $account->name ?></a>
    <?php endif; ?>
    <?php if ($account->profile_show_webpage == '0'): ?>
      <br />
    <?php endif; ?>
  </div>

  <?php if($account->profile_education): ?>
    <h2>Education</h2>
    <?php print check_markup($account->profile_education) ?>
  <?php endif; ?>

  <?php if($account->profile_schedule): ?>
    <h2>Schedule</h2>
    <?php print check_markup($account->profile_schedule) ?>
  <?php endif; ?>

  <?php if($account->profile_courses_taught): ?>
    <h2>Courses Taught</h2>
    <?php print check_markup($account->profile_courses_taught) ?>
  <?php endif; ?>

  <?php if($account->profile_research_interests): ?>
    <h2>Research Interests</h2>
    <?php print check_markup($account->profile_research_interests) ?>
  <?php endif; ?>

  <?php if($account->profile_selected_publications): ?>
    <h2>Selected Publications</h2>
    <?php print check_markup($account->profile_selected_publications) ?>
  <?php endif; ?>

  <?php if($account->profile_service): ?>
    <h2>Service</h2>
    <?php print check_markup($account->profile_service) ?>
  <?php endif; ?>

  <?php if($account->profile_awards): ?>
    <h2>Awards</h2>
    <?php print check_markup($account->profile_awards) ?>
  <?php endif; ?>

  <?php if($account->profile_other_notable_achievements): ?>
    <h2>Other Notable Achievements</h2>
    <?php print check_markup($account->profile_other_notable_achievements) ?>
  <?php endif; ?>
  <?php
    $view = views_get_view('Grants');
    if($view) {
      print $view->execute_display('Default', array($account->name));
    }
  ?>
</div>
