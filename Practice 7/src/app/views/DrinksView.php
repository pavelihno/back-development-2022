<h4>DRINKS</h4>
<table class="table table-striped">
    <tr><th></th><th>Price</th></tr>
    <?php
    foreach ($data as $row)
    {
        $row_str = "<tr><td>{$row['title']}</td><td>{$row['price']}rub</td></tr>";
        echo $row_str;
    }
    ?>
</table>
