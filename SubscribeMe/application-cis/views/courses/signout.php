<table class="default_table"> 
    <tr>
        <th>Vak</th>
        <th>Jaar</th>
        <th>Periode</th>
        <th>toets</th>
    </tr>
    <?php foreach ($xml as $xml_list): ?>
        <?php
            $course_name = $xml_list['course_name'];
            $year = $xml_list['year'];
            $period = $xml_list['period'];
            $test = $xml_list['test'];
            $id = $xml_list['id'];


            echo "<tr>";
            echo "<td>". $course_name."</td>";
            echo "<td>". $year ."</td>";
            echo "<td>". $period."</td>";
            echo "<td>". $test."</td>";
            echo "</tr>";
            echo form_open_multipart('subscribe/unroll/'.$this->uri->segment(3))
        ?>
    <?php endforeach?>
</table>
</br>
<center>
<?php echo "<input type=\"submit\" class=\"button\"  value=\"schrijf uit\" onClick=\"return confirm('Weet u zeker dat u zich wilt uitschrijven voor : $course_name, $test')\">"?>
</center>