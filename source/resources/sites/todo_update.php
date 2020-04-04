<h2>Todos List</h2>
<form method="POST" action="/todos/<?php echo $todo->id ?>">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="type" class="form-control" id="name" name="name" value="<?php echo $todo->name ?>">
    </div>
    <div class="form-group">
        <label for="pwd">Start Date</label>
        <input type="type" class="form-control" id="start" placeholder="yyyy-m-d" name="start_date" value="<?php echo $todo->start_date ?>">
    </div>
    <div class="form-group">
        <label for="pwd">End Date</label>
        <input type="type" class="form-control" id="end" placeholder="yyyy-m-d" name="end_date" value="<?php echo $todo->end_date ?>">
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Status</label>
        <select class="form-control" id="exampleFormControlSelect1" name="status">
            <option value="planning" selected="<?php echo $todo->status === 'planning' ? true : ''; ?>">Planning</option>
            <option value="doing" selected="<?php echo $todo->status === 'doing' ? true : ''; ?>">Doing</option>
            <option value="complete" selected="<?php echo $todo->status === 'complete' ? true : ''; ?>">Complete</option>
        </select>
    </div>
    <button type="submit" class="btn btn-default">Update Todo</button>
</form>