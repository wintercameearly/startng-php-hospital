<?php 
include_once('lib/header.php');  
require_once('functions/alert.php');


if(isset($_SESSION['loggedIn'])){
    //redirect to dashboard
    header("Location: dashboard.php");
}
?> 


<p><strong> Welcome, Please Register</strong></p>
<p>All Fields are required</p>


<h3>Register</h3>
    <form action="processregister.php" method="post">
        <?php print_alert();?>
        <p>
            <label for="first_name">First Name</label>
            <input 
                <?php 
                    if(isset($_SESSION['first_name'])){
                        echo "value=" .$_SESSION['first_name'];
                    }
                ?>
            type="text" name="first_name"  placeholder= "First Name" minlength="2" required >
        </p>
        <p>
            <label for="last_name">Last Name</label>
            <input 
                <?php 
                    if(isset($_SESSION['last_name'])){
                        echo "value=" .$_SESSION['last_name'];
                    }
                ?>
            type="text" name="last_name"  placeholder= "Last Name" >
        </p>
        <p>
            <label for="email">Email</label>
            <input
                <?php 
                        if(isset($_SESSION['email'])){
                            echo "value=" .$_SESSION['email'];
                        }
                    ?>
            type="email" name="email" minlength="5" placeholder= "Email" required >
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
                <option 
                    <?php 
                        if(isset($_SESSION['gender'])&& $_SESSION['gender']=='Male'){
                            echo "selected";
                        }
                    ?>
                >Female</option>
            </select>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password"  placeholder= "Password" required >
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
            type="text" name="department"  placeholder="Department" >
        </p>
        <p>
        <button type="submit">Register</button>
        </p>
    </form>

<?php include_once('lib/footer.php');   ?> 
