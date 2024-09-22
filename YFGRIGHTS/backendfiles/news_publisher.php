<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publish Newsletter</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap 4 CSS -->
</head>
<body>

<div class="container">
    <h2 class="my-4 text-center">Publish Newsletter</h2>

    <form action="publish_newsletter.php" method="POST" enctype="multipart/form-data">
        <!-- Title -->
        <div class="form-group">
            <label for="title">Newsletter Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
        </div>

        <!-- Author -->
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Enter author name" required>
        </div>

        <!-- Date -->
        <div class="form-group">
            <label for="date">Publish Date:</label>
            <input type="date" class="form-control" id="date" name="publish_date" required>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Newsletter Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter a short description" required></textarea>
        </div>

        <!-- Content -->
        <div class="form-group">
            <label for="content">Newsletter Content:</label>
            <textarea class="form-control" id="content" name="content" rows="6" placeholder="Write your newsletter content here..." required></textarea>
        </div>

        <!-- Category -->
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category">
                <option value="General">General</option>
                <option value="Events">Events</option>
                <option value="News">News</option>
                <option value="Updates">Updates</option>
            </select>
        </div>

        <!-- Image Upload -->
        <div class="form-group">
            <label for="image">Upload Cover Image (Optional):</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Publish Newsletter</button>
    </form>
</div>

<!-- Optional: Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
