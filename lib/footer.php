

  <p>
    <a href="index.php">Home</a> |
        <?php if(!isset($_SESSION['loggedIn'])){ ?>

        <a href="login.php">Login</a> |
        <a href="register.php">Register</a> |

        <?php }elseif(isset($_SESSION['loggedIn'])&& $_SESSION['role'] == 'Medical Team(MT)'){ ?>
        <a href="dashboard.php">Dashboard</a> |
        <a href="med_team.php">Medical Team Page</a> |
        <a href="logout.php">Logout</a> |
        <?php }elseif(isset($_SESSION['loggedIn'])&& $_SESSION['role'] == 'Patients'){ ?>
        <a href="dashboard.php">Dashboard</a> |
        <a href="patients.php">Patients</a> |
        <a href="logout.php">Logout</a> |
        <?php } ?>
    <a href="forgot.php">Forgot Password</a> |    
    
    </p>
</body>



</html>