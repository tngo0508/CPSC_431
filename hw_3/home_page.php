<!DOCTYPE html>
<html>
  <head>
    <title>CPSC 431 HW-3</title>
  </head>
  <body>
    <h1 style="text-align:center">Cal State Fullerton Basketball Statistics</h1>

    <?php
      require_once('Address.php');
      require_once('PlayerStatistic.php');

      // Connect to database
      @$db = new mysqli('localhost', 'thomas', 'me123', 'CPSC_431_HW3');

      if (mysqli_connect_errno()) {
        echo "<p>Error: Could not connects to database.<br/>
              Please try again later.</p>";
        exit;
      }

      // if connection was successful
      // Build query to retrieve player's name, address, and averaged statistics from the joined Team Roster and Statistics tables
      $query =
      "SELECT
      TeamRoster.ID,
      TeamRoster.Name_First,
      TeamRoster.Name_Last,
      TeamRoster.Street,
      TeamRoster.City,
      TeamRoster.State,
      TeamRoster.Country,
      TeamRoster.ZipCode,
      COUNT(Statistics.Player) AS Avg_Game_Played,
      AVG(Statistics.PlayingTimeMin) AS Avg_Min,
      AVG(Statistics.PlayingTimeSec) AS Avg_Sec,
      AVG(Statistics.Points) AS Avg_Points,
      AVG(Statistics.Assists) AS Avg_Assists,
      AVG(Statistics.Rebounds) AS Avg_Rebounds
      FROM TeamRoster LEFT JOIN Statistics ON TeamRoster.ID = Statistics.Player
      GROUP BY TeamRoster.Name_Last, TeamRoster.Name_First
      ORDER BY TeamRoster.Name_Last, TeamRoster.Name_First";

      // Prepare, execute, store results, and bind results to local variables
      $stmt = $db->prepare($query);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($id, $first_name, $last_name, $street, $city, $state, $country, $zipCode, $avg_game_played, $avg_min, $avg_sec, $avg_points, $avg_assists, $avg_rebounds);
    ?>

    <table style="width: 100%; border:0px solid black; border-collapse:collapse;">
      <tr>
        <th style="width: 40%;">Name and Address</th>
        <th style="width: 60%;">Statistics</th>
      </tr>
      <tr>
        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter Name and Address -->
          <form action="processAddressUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">First Name</td>
                <td><input type="text" name="firstName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Last Name</td>
               <td><input type="text" name="lastName" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Street</td>
               <td><input type="text" name="street" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">City</td>
                <td><input type="text" name="city" value="" size="35" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">State</td>
                <td><input type="text" name="state" value="" size="35" maxlength="100"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Country</td>
                <td><input type="text" name="country" value="" size="20" maxlength="250"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Zip</td>
                <td><input type="text" name="zipCode" value="" size="10" maxlength="10"/></td>
              </tr>

              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Add Name and Address" /></td>
              </tr>
            </table>
          </form>
        </td>

        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter game statistics for a particular player -->
          <form action="processStatisticUpdate.php" method="post">
            <table style="margin: 0px auto; border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
<!--            <td><input type="text" name="name" value="" size="50" maxlength="500"/></td>  -->
                <td><select name="name_ID" required>
                  <option value="" selected disabled hidden>Choose player's name here</option>
                  <?php
                    // for each row of data returned,
                    //   construct an Address object providing first and last name
                    //   emit an option for the pull down list such that
                    //     the displayed name is retrieved from the Address object
                    //     the value submitted is the unique ID for that player
                    // for example:
                        // <option value="101">Duck, Daisy</option>
                    while ($stmt->fetch()) {
                      $name = $last_name.', '.$first_name;
                      $newPlayer = new Address($name);
                      echo "<option value=\"$id\">".$newPlayer->name()."</option>";
                    }
                  ?>
                </select></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Playing Time (min:sec)</td>
               <td><input type="text" name="time" value="" size="5" maxlength="5"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Points Scored</td>
               <td><input type="text" name="points" value="" size="3" maxlength="3"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Assists</td>
                <td><input type="text" name="assists" value="" size="2" maxlength="2"/></td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Rebounds</td>
                <td><input type="text" name="rebounds" value="" size="2" maxlength="2"/></td>
              </tr>

              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Add Statistic" /></td>
              </tr>
            </table>
          </form>
        </td>
      </tr>
    </table>


    <h2 style="text-align:center">Player Statistics</h2>

    <?php
      // emit the number of rows (records) in the table
      echo "<p>Number of Records: ".$stmt->num_rows."</p>";
    ?>

    <table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th colspan="2" style="vertical-align:top; border:1px solid black; background: lightgreen;">Player</th>
        <th colspan="1" style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th colspan="4" style="vertical-align:top; border:1px solid black; background: lightgreen;">Statistic Averages</th>
      </tr>
      <tr>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Address</th>

        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Games Played</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Time on Court</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Points Scored</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Assists</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Rebounds</th>
      </tr>
      <?php
        // for each row (record) of data retrieved from the database emit the html to populate a row in the table
        // for example:
        //  <tr>
        //    <td  style="vertical-align:top; border:1px solid black;">1</td>
        //    <td  style="vertical-align:top; border:1px solid black;">Dog, Pluto</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1313 S. Harbor Blvd.<br/>Anaheim, CA 92808-3232<br/>USA</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1</td>
        //    <td  style="vertical-align:top; border:1px solid black;">10:0</td>
        //    <td  style="vertical-align:top; border:1px solid black;">18</td>
        //    <td  style="vertical-align:top; border:1px solid black;">2</td>
        //    <td  style="vertical-align:top; border:1px solid black;">4</td>
        //  </tr>
        // or if there exists no statistical data for the player
        //  <tr>
        //    <td  style="vertical-align:top; border:1px solid black;">2</td>
        //    <td  style="vertical-align:top; border:1px solid black;">Duck, Daisy</td>
        //    <td  style="vertical-align:top; border:1px solid black;">1180 Seven Seas Dr.<br/>Lake Buena Vista, FL 32830<br/>USA</td>
        //    <td  style="vertical-align:top; border:1px solid black;">0</td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //    <td  style="border:1px solid black; border-collapse:collapse; background: #e6e6e6;"></td>
        //  </tr>
        //
          // construct Address and PlayerStatistic objects supplying as constructor parameters the retrieved database columns
          // Emit table row data using appropriate getters from the Address and PlayerStatistic objects
          $stmt->data_seek(0); //used to reset to first row
          $count = 0;
          while ($stmt->fetch()) {
            $count++;
            $name = $last_name.', '.$first_name;
            $newPlayer = new Address($name, $street, $city, $state, $country, $zipCode);
            $newStat = new PlayerStatistic();
            echo "<tr>";
               echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$count."</td>";
               echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$newPlayer->name()."</td>";
               echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$newPlayer->street()."<br/>".$newPlayer->city().", ".$newPlayer->state()." ".$newPlayer->zip()."<br/>".$newPlayer->country()."</td>";
            if ($avg_game_played == 0) {
              echo "<td  style=\"vertical-align:top; border:1px solid black;\">0</td>";
              echo "<td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>";
              echo "<td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>";
              echo "<td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>";
              echo "<td  style=\"border:1px solid black; border-collapse:collapse; background: #e6e6e6;\"></td>";
            }
            else {
              $time = "$avg_min".":"."$avg_sec";
              $newPlayer = new PlayerStatistic($name, $time, $avg_points, $avg_assists, $avg_rebounds);
              echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$avg_game_played."</td>";
              echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$newPlayer->playingTime()."</td>";
              echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$newPlayer->pointsScored()."</td>";
              echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$newPlayer->assists()."</td>";
              echo "<td  style=\"vertical-align:top; border:1px solid black;\">".$newPlayer->rebounds()."</td>";
            }

            echo "</tr>";
          }

      ?>
    </table>

  </body>
</html>
