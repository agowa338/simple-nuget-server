<?php
require __DIR__ . '/../inc/core.php';

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Simple NuGet Server Status Page</title>
    <script>
    </script>
    <style>
      #tablePackages, #tableVersions {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          border: 0;
      }

      #tablePackages td, #tablePackages th, #tableVersions td, #tableVersions th {
          border: 1px solid #ddd;
          padding: 8px;
      }

      #tablePackages tr:nth-child(even), #tableVersions tr:nth-child(even){background-color: #f2f2f2;}

      #tablePackages tr:hover, #tableVersions tr:hover {background-color: #ddd;}

      #tablePackages th, #tableVersions th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #4CAF50;
          color: white;
      }
    </style>
  </head>
  <body>
    <table id="tableVersions">
        <?php
        //$resultVersions = DB::$conn->query('SELECT * FROM versions');
        $resultVersions = DB::dumpDatabase();

        $RowPackageId    = "<th>PackageId</th>";

        $RowVersionId    = "<th>VersionId</th>";
        $RowTitle        = "<th>Title</th>";
        $RowDescription  = "<th>Description</th>";
        $RowCreated      = "<th>Created</th>";
        $RowVersion      = "<th>Version</th>";
        $RowPackageHash  = "<th>PackageHash</th>";
        $RowPackageHashAlgorithm = "<th>PackageHashAlgorithm</th>";
        $RowDependencies = "<th>Dependencies</th>";
        $RowPackageSize  = "<th>PackageSize</th>";
        $RowReleaseNotes = "<th>ReleaseNotes</th>";
        $RowVersionDownloadCount = "<th>VersionDownloadCount</th>";
        $RowTags         = "<th>Tags</th>";
        $RowLicenseUrl   = "<th>LicenseUrl</th>";
        $RowProjectUrl   = "<th>ProjectUrl</th>";
        $RowIconUrl      = "<th>IconUrl</th>";
        $RowAuthors      = "<th>Authors</th>";
        $RowOwners       = "<th>Owners</th>";
        $RowRequireLicenseAcceptance = "<th>RequireLicenseAcceptance</th>";
        $RowCopyright    = "<th>Copyright</th>";
        $RowIsPrerelease = "<th>IsPrerelease</th>";
        $RowDownloadCount = "<th>DownloadCount</th>";
        $RowLatestVersion = "<th>LatestVersion</th>";

        //while ($row=$resultVersions->fetch()) {
        foreach ($resultVersions as $row) {
            $RowPackageId .= "<th>" . $row["PackageId"] . "</th>";

            $RowVersionId .= "<td>" . $row["VersionId"] . "</td>";
            $RowTitle .= "<td>" . $row["Title"] . "</td>";
            $RowDescription .= "<td>" . $row["Description"] . "</td>";
            $RowCreated .= "<td>" . $row["Created"] . "</td>";
            $RowVersion .= "<td>" . $row["Version"] . "</td>";
            $RowPackageHash .= "<td>" . $row["PackageHash"] . "</td>";
            $RowPackageHashAlgorithm .= "<td>" . $row["PackageHashAlgorithm"] . "</td>";
            $RowDependencies .= "<td>" . $row["Dependencies"] . "</td>";
            $RowPackageSize .= "<td>" . $row["PackageSize"] . "</td>";
            $RowReleaseNotes .= "<td>" . $row["ReleaseNotes"] . "</td>";
            $RowVersionDownloadCount .= "<td>" . $row["VersionDownloadCount"] . "</td>";
            $RowTags .= "<td>" . $row["Tags"] . "</td>";
            $RowLicenseUrl .= "<td>" . $row["LicenseUrl"] . "</td>";
            $RowProjectUrl .= "<td>" . $row["ProjectUrl"] . "</td>";
            $RowIconUrl .= "<td>" . $row["IconUrl"] . "</td>";
            $RowAuthors .= "<td>" . $row["Authors"] . "</td>";
            $RowOwners .= "<td>" . $row["Owners"] . "</td>";
            $RowRequireLicenseAcceptance .= "<td>" . $row["RequireLicenseAcceptance"] . "</td>";
            $RowCopyright .= "<td>" . $row["Copyright"] . "</td>";
            $RowIsPrerelease .= "<td>" . $row["IsPrerelease"] . "</td>";
            $RowDownloadCount .= "<td>" . $row["DownloadCount"] . "</td>";
            $RowLatestVersion .= "<td>" . $row["LatestVersion"] . "</td>";
        }

        echo "<tr>" . $RowPackageId . "</tr>";
        echo "<tr>" . $RowVersionId . "</tr>";
        echo "<tr>" . $RowTitle . "</tr>";
        echo "<tr>" . $RowDescription . "</tr>";
        echo "<tr>" . $RowCreated . "</tr>";
        echo "<tr>" . $RowVersion . "</tr>";
        echo "<tr>" . $RowPackageHash . "</tr>";
        echo "<tr>" . $RowPackageHashAlgorithm . "</tr>";
        echo "<tr>" . $RowDependencies . "</tr>";
        echo "<tr>" . $RowPackageSize . "</tr>";
        echo "<tr>" . $RowReleaseNotes . "</tr>";
        echo "<tr>" . $RowVersionDownloadCount . "</tr>";
        echo "<tr>" . $RowTags . "</tr>";
        echo "<tr>" . $RowLicenseUrl . "</tr>";
        echo "<tr>" . $RowProjectUrl . "</tr>";
        echo "<tr>" . $RowIconUrl . "</tr>";
        echo "<tr>" . $RowAuthors . "</tr>";
        echo "<tr>" . $RowOwners . "</tr>";
        echo "<tr>" . $RowRequireLicenseAcceptance . "</tr>";
        echo "<tr>" . $RowCopyright . "</tr>";
        echo "<tr>" . $RowIsPrerelease . "</tr>";
        echo "<tr>" . $RowDownloadCount . "</tr>";
        echo "<tr>" . $RowLatestVersion . "</tr>";
        ?>
    </table>
  </body>
</html>
