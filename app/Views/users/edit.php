<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <form action="<?= base_url('index.php/users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= old('name', $user['name']) ?>"><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['name'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['name'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= old('email', $user['email']) ?>"><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['email'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['email'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?= old('phone', $user['phone']) ?>"><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['phone'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['phone'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="desc">Description:</label>
        <textarea name="desc" id="desc" rows="4"><?= old('desc', $user['desc']) ?></textarea><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['desc'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['desc'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="profile">Profile Picture:</label>
        <?php if($user['profile']): ?>
            <img src="<?= base_url($user['profile']) ?>" alt="Current Profile" style="max-width: 100px;"><br>
        <?php endif; ?>
        <input type="file" name="profile" id="profile" accept="image/*"><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['profile'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['profile'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="">Select Gender</option>
            <option value="male" <?= old('gender', $user['gender']) == 'male' ? 'selected' : '' ?>>Male</option>
            <option value="female" <?= old('gender', $user['gender']) == 'female' ? 'selected' : '' ?>>Female</option>
            <option value="other" <?= old('gender', $user['gender']) == 'other' ? 'selected' : '' ?>>Other</option>
        </select><br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['gender'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['gender'] ?></span><br>
        <?php endif; ?>
        <br>

        <label for="skills">Skills:</label><br>
        <?php 
        $oldSkills = old('skills');
        $userSkills = $oldSkills !== null ? $oldSkills : explode(',', $user['skills']); 
        ?>
        <input type="checkbox" name="skills[]" value="HTML" <?= is_array($userSkills) && in_array('HTML', $userSkills) ? 'checked' : '' ?>> HTML<br>
        <input type="checkbox" name="skills[]" value="CSS" <?= is_array($userSkills) && in_array('CSS', $userSkills) ? 'checked' : '' ?>> CSS<br>
        <input type="checkbox" name="skills[]" value="JavaScript" <?= is_array($userSkills) && in_array('JavaScript', $userSkills) ? 'checked' : '' ?>> JavaScript<br>
        <input type="checkbox" name="skills[]" value="PHP" <?= is_array($userSkills) && in_array('PHP', $userSkills) ? 'checked' : '' ?>> PHP<br>
        <?php if(session()->getFlashdata('error') && isset(session()->getFlashdata('error')['skills'])): ?>
            <span style="color: red;"><?= session()->getFlashdata('error')['skills'] ?></span><br>
        <?php endif; ?>
        <br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
