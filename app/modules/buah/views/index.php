<!DOCTYPE html>
<html>

<head>
    <title>List of Buah</title>
</head>

<body>
    <h1>List of Buah</h1>
    <a href="/buah/create">Add New Buah</a>
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
            <?php foreach ($buah as $item) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['description']); ?></td>
                    <td>
                        <a href="/buah/update/<?php echo htmlspecialchars($item['id']); ?>">Edit</a>
                        <a href="/buah/delete/<?php echo htmlspecialchars($item['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>