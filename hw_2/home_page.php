<!DOCTYPE html>
<html>
  <head>
    <title>CPSC 431 HW-2</title>
  </head>
  <body>
    <h1 align="center">Cal State Fullerton Basketball Statistics</h1>

    <table style="width: 100%; border:0px solid black; border-collapse:collapse;">
      <tr>
        <th style="width: 40%;">Name and Address</th>
        <th style="width: 60%;">Statistics</th>
      </tr>
      <tr>
        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter Name and Address -->
          <form action="processAddressUpdate.php" method="post">
            <table align="center" style="border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">First Name</td>
                <td><input type="text" name="firstName" size="35" maxlength="250"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Last Name</td>
               <td><input type="text" name="lastName" size="35" maxlength="250"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Street</td>
               <td><input type="text" name="street" size="35" maxlength="250"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">City</td>
                <td><input type="text" name="city" size="35" maxlength="250"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">State</td>
                <td><input type="text" name="state" size="35" maxlength="100"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Zip</td>
                <td><input type="text" name="zipCode" size="10" maxlength="10"</td>
              </tr>

              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Add/Update Name and Address" /></td>
              </tr>
            </table>
          </form>
        </td>

        <td style="vertical-align:top; border:1px solid black;">
          <!-- FORM to enter game statistics for a particular player -->
          <form action="processStatisticUpdate.php" method="post">
            <table align="center" style="border: 0px; border-collapse:separate;">
              <tr>
                <td style="text-align: right; background: lightblue;">Name (Last, First)</td>
                <td><input type="text" name="name" size="50" maxlength="500"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Playing Time (min:sec)</td>
               <td><input type="text" name="time" size="5" maxlength="5"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Points Scored</td>
               <td><input type="text" name="points" size="3" maxlength="3"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Assists</td>
                <td><input type="text" name="assists" size="2" maxlength="2"</td>
              </tr>

              <tr>
                <td style="text-align: right; background: lightblue;">Rebounds</td>
                <td><input type="text" name="rebounds" size="2" maxlength="2"</td>
              </tr>

              <tr>
               <td colspan="2" style="text-align: center;"><input type="submit" value="Add/Update Statistic" /></td>
              </tr>
            </table>
          </form>
        </td>
      </tr>
    </table>

    <h2 align="center">Team Roster</h2>
    <?php
      $document_root = $_SERVER['DOCUMENT_ROOT'];
      $dataRecords = file("$document_root/data/teamRoster.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      echo "Number of Records:  ".count($dataRecords)."<br/>";
    ?>
    <table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Player's Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Street</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">City</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">State</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Zip</th>
      </tr>
      <?php
        foreach($dataRecords as $row=>$record )
        {
          echo '<tr>';
          $values = explode("\t", $record);
          echo '<td  style="vertical-align:top; border:1px solid black;">'."$row</td>";
          foreach( $values as $value)  echo '<td style="vertical-align:top; border:1px solid black;">'."$value</td>";
          echo '</tr>';
        }
      ?>
    </table>

    <h2 align="center">Player Statistics</h2>
    <?php
      $document_root = $_SERVER['DOCUMENT_ROOT'];
      $dataRecords = file("$document_root/data/statistics.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      echo "Number of Records:  ".count($dataRecords)."<br/>";
    ?>
    <table style="border:1px solid black; border-collapse:collapse;">
      <tr>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;"></th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Player's Name</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Time on Court</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Points Scored</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Assists</th>
        <th style="vertical-align:top; border:1px solid black; background: lightgreen;">Number of Rebounds</th>
      </tr>
      <?php
        foreach($dataRecords as $row=>$record )
        {
          echo '<tr>';
          $values = explode("\t", $record);
          echo '<td  style="vertical-align:top; border:1px solid black;">'."$row</td>";
          foreach( $values as $value)  echo '<td style="vertical-align:top; border:1px solid black;">'."$value</td>";
          echo '</tr>';
        }
      ?>
    </table>

  </body>
</html>
