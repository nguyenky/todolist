<h2>Todos List</h2>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Work Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($todos as $todo) { ?>
            <tr>
                <td><?php echo $todo->id; ?></td>
                <td><?php echo $todo->name; ?></td>
                <td><?php echo $todo->start_date; ?></td>
                <td><?php echo $todo->end_date; ?></td>
                <td><?php echo $todo->status; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>