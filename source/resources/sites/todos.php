<h2>Todos List</h2>
<form method="POST" action="/todos">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="type" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="pwd">Start Date</label>
        <input type="type" class="form-control" id="start" placeholder="yyyy-m-d" name="start_date" required>
    </div>
    <div class="form-group">
        <label for="pwd">End Date</label>
        <input type="type" class="form-control" id="end" placeholder="yyyy-m-d" name="end_date" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Example select</label>
        <select class="form-control" id="exampleFormControlSelect1" name="status">
            <option value="planning">Planning</option>
            <option value="doing">Doing</option>
            <option value="complete">Complete</option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Add Todo</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Work Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Actions</th>
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
                <td style="display: flex;">
                    <a class="btn btn-info" href="/todos/<?php echo $todo->id; ?>" role="button">Edit</a>
                    <form method="POST" action="/todos/delete/<?php echo $todo->id; ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>