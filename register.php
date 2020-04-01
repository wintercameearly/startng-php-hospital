<?php session_start(); include_once('lib/header.php');   ?> 
    <p><strong> Welcome, Please Register</strong></p>
    <p>All Fields are required</p>

    <form action="processregister.php" method="post">
    <p>
    <?php 
        if(isset($_SESSION['error'])&& !empty($_SESSION['error'])){
            echo $_SESSION['error'];
            session_destroy();
        }
    ?>
    </p>
        <p>
            <label for="first_name">First Name</label>
            <input 
                <?php 
                    if(isset($_SESSION['first_name'])){
                        echo "value=" .$_SESSION['first_name'];
                    }
                ?>
            type="text" name="first_name" placeholder= "First Name" >
        </p>
        <p>
            <label for="last_name">Last Name</label>
            <input 
            <?php 
                    if(isset($_SESSION['last_name'])){
                        echo "value=" .$_SESSION['last_name'];
                    }
                ?>
            type="text" name="last_name" placeholder= "Last Name" >
        </p>
        <p>
            <label for="email">Email</label>
            <input
            <?php 
                    if(isset($_SESSION['email'])){
                        echo "value=" .$_SESSION['email'];
                    }
                ?>
            type="email" name="email" placeholder= "Email" >
        </p>
        <p>
            <label for="gender">Gender</label >
            <select name="gender" >
                <option value="">Select One</option>
                <option 
                <?php 
                    if(isset($_SESSION['gender'])&& $_SESSION['gender']=='Male'){
                        echo "selected";
                    }
                ?>
                >Male</option>
                <option >Female</option>
            </select>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder= "Password" >
        </p>

        <p>
            <label for="designation">Designation</label >
            <select name="designation" >
                <option value="">Select One</option>
                <option >Medical Team(MT)</option>
                <option> Patients</option>
            </select>
        </p>
        <p>
            <label for="department">Department</label>
            <input 
            <?php 
                    if(isset($_SESSION['department'])){
                        echo "value=" .$_SESSION['department'];
                    }
                ?>
            type="text" name="department" placeholder="Department" >
        </p>
        <p>
        <button type="submit">Register</button>
        </p>
    </form>

<?php include_once('lib/footer.php');   ?> 