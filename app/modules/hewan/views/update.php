<!DOCTYPE html>
<html>

<head>
    <title>Update Hewan</title>
</head>

<body>
    <h1>Update Hewan</h1>
    <form method="post" action="/hewan/update/<?php echo htmlspecialchars($hewan['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($hewan['name']); ?>" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($hewan['description']); ?></textarea>
        <button type="submit">Update</button>
    </form>
    <a href="/hewan">Back to List</a>
</body>

</html>