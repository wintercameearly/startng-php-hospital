<?php include_once('lib/header.php');   ?> 
    <p><strong> Welcome, Please Register</strong></p>
    <p>All Fields are required</p>

    <form action="processregister.php" method="post">
        <p>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" placeholder= "First Name" required >
        </p>
        <p>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" placeholder= "Last Name" required>
        </p>
        <p>
            <label for="email">Email</label>
            <input type="email" name="email" placeholder= "Email" required>
        </p>
        <p>
            <label for="gender">Gender</label required>
            <select name="gender" >
                <option value="">Select One</option>
                <option >Male</option>
                <option >Female</option>
            </select>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder= "Password" required>
        </p>

        <p>
            <label for="designation">Designation</label required>
            <select name="designation" >
                <option value="">Select One</option>
                <option >Medical Team(MT)</option>
                <option> Patients</option>
            </select>
        </p>
        <p>
            <label for="department">Department</label>
            <input type="text" name="department" placeholder="Department" required>
        </p>
        <p>
        <button type="submit">Register</button>
        </p>
    </form>

<?php include_once('lib/footer.php');   ?> 