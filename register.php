<?php 
include_once('lib/header.php');  
require_once('functions/alert.php');


if(isset($_SESSION['loggedIn'])){
    //redirect to dashboard
    header("Location: dashboard.php");
}
?> 



<div class="container">
        <div >
        <div class = "row col-6"><strong> Register</strong></div>
        <div class = "row col-6">Welcome, Please Register</div>
        <div class = "row col-6">All Fields are required</div>
        </div>
        <div class= "row col-6 ">
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
                    type="text" class="form-control" name="first_name"  placeholder= "First Name" minlength="2" required >
                </p>
                <p>
                    <label for="last_name">Last Name</label>
                    <input 
                        <?php 
                            if(isset($_SESSION['last_name'])){
                                echo "value=" .$_SESSION['last_name'];
                            }
                        ?>
                    type="text" class="form-control" name="last_name"  placeholder= "Last Name" >
                </p>
                <p>
                    <label for="email">Email</label>
                    <input
                        <?php 
                                if(isset($_SESSION['email'])){
                                    echo "value=" .$_SESSION['email'];
                                }
                            ?>
                    type="email"  class="form-control" name="email" minlength="5" placeholder= "Email" required >
                </p>
                <p>
                    <label for="gender">Gender</label >
                    <select class="form-control" name="gender" >
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
                    <input class="form-control" type="password" name="password"  placeholder= "Password" required >
                </p>

                <p>
                    <label for="designation">Designation</label >
                    <select  class="form-control" name="designation" >
                        <option value="">Select One</option>
                        <option >Medical Team(MT)</option>
                        <option> Patients</option>
                    </select>
                </p>
                <p>
                    <label for="department">Department</label >
                    <select  required class="form-control" name="department" >
                        <option value="">Select One</option>
                        <option>General Health</option>
                        <option>Laboratory</option>
                        <option>Paediatrics</option>
                        <option>Obsteatrics and Gyneacology</option>
                        <option>Urology</option>
                        <option>Surgery</option>
                    </select>
                </p>
                <p>
                <button class="btn btn-success" type="submit">Register</button>
                </p>
                <p>
                    <a href="forgot.php">Forgot Password?</a> |
                    <a href="login.php">Already have an account? Login</a>
                </p>
            </form>
                            
        </div>
</div>
<?php include_once('lib/footer.php');   ?> 
