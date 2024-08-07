<!DOCTYPE html>
<html>

<head>
    <title>Update Buah</title>
</head>

<body>
    <h1>Update Buah</h1>
    <form method="post" action="/buah/update/<?php echo htmlspecialchars($buah['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($buah['name']); ?>" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($buah['description']); ?></textarea>
        <button type="submit">Update</button>
    </form>
    <a href="/buah">Back to List</a>
</body>

</html>