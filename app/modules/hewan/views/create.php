<!DOCTYPE html>
<html>

<head>
    <title>Create Hewan</title>
</head>

<body>
    <h1>Create Hewan</h1>
    <form method="post" action="/hewan/create">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <button type="submit">Create</button>
    </form>
    <a href="/hewan">Back to List</a>
</body>

</html>