<table border ="1"> 
    <tr>
        <th>naam</th>
        <th>vak</th>
        <th>jaar</th>
        <th>periode</th>
        <th>toets</th>
    </tr>
<?php foreach ($signups as $row): ?>

<div id="main">
    <?php
        $username = substr($row['username'], 0,100);
        $course_name = substr($row['course_name'], 0,100);
        $year = substr($row['year'], 0,100);
        $period = substr($row['period'], 0,100);
        $test = substr($row['test'], 0,100);

        echo "<tr>";
        echo "<td>".$username."</td>";
        echo "<td>".$course_name."</td>";
        echo "<td>".$year."</td>";
        echo "<td>".$period."</td>";
        echo "<td>".$test."</td>";
        echo "</tr>";
        ?>
    </div>

<?php endforeach?>
</table>
<a href='/vakken/excell_export/<?php echo $course_name?>/<?php echo $year?>/<?php echo $period?>'><span style='color:green;'>Exporteer de data naar Excell</span></a>