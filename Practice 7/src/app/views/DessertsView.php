<table class="table table-striped">
    <tr><th><h4>Desserts</h4></th><th>Price</th><th>Calories</th></tr>
    <?php
    foreach ($data as $row)
    {
        $row_str = "<tr><td>{$row['title']}</td><td>{$row['price']}rub</td><td>{$row['calories']}kcal</td></tr>";
        echo $row_str;
    }
    ?>
</table>
