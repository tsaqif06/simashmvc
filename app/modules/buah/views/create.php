<!DOCTYPE html>
<html>

<head>
    <title>Create Buah</title>
</head>

<body>
    <h1>Create Buah</h1>
    <form method="post" action="/buah/create">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <button type="submit">Create</button>
    </form>
    <a href="/buah">Back to List</a>
</body>

</html>