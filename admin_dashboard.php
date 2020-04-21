<?php include_once('lib/header.php') ;
if(!isset($_SESSION['isActive'])){
    header("Location: admin.php");
}
?>


<div class = "container">
    <h3>Admin Page: MD</h3>
    <h4>All Staff</h4>
    <hr>
        <?php 
            $allUsers = scandir("db/users/"); // return @array (2 filled)
            $countAllUsers = count($allUsers);

            for ($counter =2; $counter < $countAllUsers; $counter++){
                $currentUser = $allUsers[$counter];
                $userString = file_get_contents("db/users/".$currentUser);
                $userObject = json_decode($userString);
                $role = $userObject->designation;
                if($role=="Medical Team(MT)"){
                    $firstname = $userObject->first_name ;
                    $lastname = $userObject->last_name;
                    $name = $firstname ." " . $lastname;
        ?>

            <ul class="list-group">
                <li class="list-group-item"> <span class="badge badge-secondary"> Staff Name: </span>  <?php  echo $name; ; ?> |<span class="badge badge-secondary"> Role: </span>  <?php echo $userObject->designation;  ?> | <span class="badge badge-secondary">Department: </span>  <?php echo $userObject->department; ?> </li>
            </ul>
                
        <?php 
        }
        }
        ?>
    <h4>All Patients</h4>
    <hr>
        <?php
            $allUsers = scandir("db/users/"); // return @array (2 filled)
            $countAllUsers = count($allUsers);

            for ($counter =2; $counter < $countAllUsers; $counter++){
                $currentUser = $allUsers[$counter];
                $userString = file_get_contents("db/users/".$currentUser);
                $userObject = json_decode($userString);
                $role = $userObject->designation;
                if($role=="Patients"){
                    $firstname = $userObject->first_name ;
                    $lastname = $userObject->last_name;
                    $name = $firstname ." " . $lastname; 
        ?>
            <ul class="list-group">
                <li class="list-group-item"> <span class="badge badge-secondary"> Patient Name: </span>  <?php  echo $name; ; ?> |<span class="badge badge-secondary"> Role: </span>  <?php echo $userObject->designation;  ?></li>
            </ul>
        <?php 
        }
        }
        ?>
</div>

<div class="container" >
<h3>Add New User</h3>
    <form action="adminfunctions.php" method="post">
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
            class="form-control" type="text" name="first_name"  placeholder= "First Name" minlength="2" required >
        </p>
        <p>
            <label for="last_name">Last Name</label>
            <input 
                <?php 
                    if(isset($_SESSION['last_name'])){
                        echo "value=" .$_SESSION['last_name'];
                    }
                ?>
            class="form-control" type="text" name="last_name"  placeholder= "Last Name" >
        </p>
        <p>
            <label for="email">Email</label>
            <input
                <?php 
                        if(isset($_SESSION['email'])){
                            echo "value=" .$_SESSION['email'];
                        }
                    ?>
            class="form-control" type="email" name="email" minlength="5" placeholder= "Email" required >
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
            <input class="form-control" type="password" name="password"  placeholder= "Password" >
        </p>

        <p>
            <label for="designation">Designation</label >
            <select class="form-control" name="designation" >
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
                    <option>Obsteatrics and Gyneacology</option>                        <option>Urology</option>
                    <option>Surgery</option>
                </select>
        </p>
        <p>
        <button class="btn btn-sm btn-primary type="submit">Add</button>
        </p>
    </form>
    <p>
    <?php 
        if(isset($_SESSION['message'])&& !empty($_SESSION['message'])){
            echo "<span style='color:green'>".$_SESSION['message']. "<span/>";
            session_destroy();
        }
    ?>
    </p>
</div>

<a href="logout.php">Logout</a>