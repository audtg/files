<html>
<head><title>Event Results</title></head>
<body>
<?php
include_once('getresults.php');
$results = getResults();
foreach ($results as $event) {
    ?>
    <h1><?php echo($event['name']) ?></h1>
    <table>
        <?php
        foreach ($event['games'] as $game) {
            $s1 = (int)$game['score1'];
            $s2 = (int)$game['score2'];
            ?>
            <tr>
                <td style="font-weight:<?php echo(($s1 > $s2) ? 'bold' : 'normal') ?>">
                    <?php echo($game['team1']) ?></td>
                <td><?php echo($s1) ?></td>
                <td style="font-weight:<?php echo(($s2 > $s1) ? 'bold' : 'normal') ?>">
                    <?php echo($game['team2']) ?></td>
                <td><?php echo($s2) ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>
</body>
</html>