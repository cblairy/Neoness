<?php
if(uri_string() == 'create'){
  ?>
  <form action="create/form" method="post">
  <?= csrf_field() ?>
  <fieldset>
    <legend>Walking</legend>
    <div>
      <input type="checkbox" name="walking_time_3km" value="Walk at 3km/h">
      <label for="walk3">3km/h</label>
    </div>
    <div>
      <input type="checkbox" name="walking_time_6km" value="Walk at 6km/h">
      <label for="walk6">6km/h</label>
    </div>
    </fieldset>
    <br><br>
    <fieldset>
    <legend>Running</legend>
    <div>
      <input type="checkbox" name="running_time_8km" value="Run at 8km/h">
      <label for="run8">8km/h</label>
    </div>
    <div>
      <input type="checkbox" name="running_time_10km" value="Run at 10km/h">
      <label for="run10">10km/h</label>
    </div>
    <div>
      <input type="checkbox" name="running_time_13km" value="Run at 13km/h">
      <label for="run12">12km/h</label>
    </div>
    <div>
      <input type="checkbox" name="running_time_15km" value="Run at 15km/h">
      <label for="run">15km/h</label>
    </div>
    </fieldset>
    <br><br>
    <fieldset>
    <legend>Indoors</legend>
    <div>
      <input type="checkbox" name="swimming_time" value="Swimming">
      <label for="swimming">Swimming</label>
    </div>
    <div>
      <input type="checkbox" name="bodybuilding_time" value="BodyBuilding">
      <label for="body">Bodybuilding</label>
    </div>
    <div>
      <input type="checkbox" name="fitness_time" value="Fitness">
      <label for="fitness">Fitness</label>
    </div>
    </fieldset>
    <br><br>
    <fieldset>
    <legend>Outdoors</legend>
    <div>
      <input type="checkbox" name="bike_time" value="Ride a bike">
      <label for="bike">Biking</label>
    </div>
  </fieldset>
  <input type="submit" value="Go !">
  </form>
  <?php 


} elseif (uri_string() == 'create/form'){
  ?>
    <h1>How much time practice activities</h1>
  <form method='post' action='/detail'>
  <?= csrf_field() ?>
  <?php
  foreach($data as $key => $activity)
  {
      echo "<p>$activity : <input type='number' name='$key'></p>";
  }
  echo "<p>Weight (optional): <input type='number' name='current_weight'></p>";
  ?>
  <input type="submit" value="Validate my activities">
  </form>
  <?php
}
