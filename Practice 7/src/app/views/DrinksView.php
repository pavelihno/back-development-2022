<table class="table table-striped">
    <tr><th><h4>Drinks</h4></th><th>Price</th></tr>
    <?php
    foreach ($data as $row)
    {
        $row_str = "<tr><td>{$row['title']}</td><td>{$row['price']}rub</td></tr>";
        echo $row_str;
    }
    ?>
</table>
