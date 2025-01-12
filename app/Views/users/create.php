<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h1>Create New User</h1>

    <form action="<?= base_url('index.php/users/store') ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= old('name') ?>"><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['name'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['name'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= old('email') ?>"><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['email'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['email'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?= old('phone') ?>"><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['phone'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['phone'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="desc">Description:</label>
        <textarea name="desc" id="desc" rows="4"><?= old('desc') ?></textarea><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['desc'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['desc'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="profile">Profile Picture:</label>
        <input type="file" name="profile" id="profile" accept="image/*"><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['profile'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['profile'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="">Select Gender</option>
            <option value="male" <?= old('gender') == 'male' ? 'selected' : '' ?>>Male</option>
            <option value="female" <?= old('gender') == 'female' ? 'selected' : '' ?>>Female</option>
            <option value="other" <?= old('gender') == 'other' ? 'selected' : '' ?>>Other</option>
        </select><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['gender'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['gender'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="skills">Skills:</label><br>
        <input type="checkbox" name="skills[]" value="HTML" <?= in_array('HTML', old('skills', [])) ? 'checked' : '' ?>> HTML<br>
        <input type="checkbox" name="skills[]" value="CSS" <?= in_array('CSS', old('skills', [])) ? 'checked' : '' ?>> CSS<br>
        <input type="checkbox" name="skills[]" value="JavaScript" <?= in_array('JavaScript', old('skills', [])) ? 'checked' : '' ?>> JavaScript<br>
        <input type="checkbox" name="skills[]" value="PHP" <?= in_array('PHP', old('skills', [])) ? 'checked' : '' ?>> PHP<br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['skills'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['skills'] ?></span><br>
        <?php endif; ?>
        <br>

        <button type="submit">Create User</button>
    </form>
</body>
</html>
