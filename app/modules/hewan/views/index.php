<!DOCTYPE html>
<html>

<head>
    <title>List of Hewan</title>
</head>

<body>
    <h1>List of Hewan</h1>
    <a href="/hewan/create">Add New Hewan</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hewan as $item) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['description']); ?></td>
                    <td>
                        <a href="/hewan/update/<?php echo htmlspecialchars($item['id']); ?>">Edit</a>
                        <a href="/hewan/delete/<?php echo htmlspecialchars($item['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>