<?php
$session = session();
session()->getFlashdata('error');
service('validation')->listErrors(); 

if($session->logged_in == TRUE){
    echo "<h2>Nice to see you again, $session->firstname</h2>";

    
    echo "<div><h1 style='margin:auto; padding:20px'>My dashboard</h1>";
    echo "<p>Your actual BMI is $session->BMI</p>";
    echo "<p>My summary of the week :";
    echo $arrayWeekly;
    echo "</div>";
} else {
?>


<div id="login">
    <h1>Sign In</h1>
    <form action="/home" method="post">
        <?= csrf_field() ?>
        <p>
            <label for="email">Email : </label>
            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" size="30" name="email" required>
        </p>

        <p>
            <label for="password">Password :</label>
            <input type="password" name="password" required>
        </p>
        <input type="submit" value="Log In">
    </form>
    <div style="color:red">
    <?php
    if(isset($data)) {echo $data;}
    ?>
    </div>
    <p><a href="/signUp">Sign Up</a></p>
</div>
<?php 
}
?>
