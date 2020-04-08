<?php  include_once('lib/header.php'); 
   if(isset($_SESSION['loggedIn'])&& !empty($_SESSION['loggedIn'])){
    if($_SESSION['role']=='Medical Team(MT)'){
        header("Location: med_team.php");
    }elseif($_SESSION['role']=='Patients'){
        header("Location: patient.php");}
}
?>


<h3>Admin Login</h3>
<form action="processAdmin.php" method="post">
        <p>
            <label for="username">Username</label>
            <input type="email" name="username" placeholder= "Username" >
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder= "Password" >
        </p>
        <p>
        <button type="submit">Login</button>
        </p>
    </form>

<h4>Login attempts to this page are monitored, any unauthorized attempt is liable to a fine of not less than #5,000,000 according to s.6 of the Cybercrimes Prohibition and Prevention Act of 2015 </h4>

<?php include_once('lib/footer.php'); ?>