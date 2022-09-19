<?= session()->getFlashdata('error');
service('validation')->listErrors(); ?>
<fieldset>
    <legend>Sign Up</legend>
    <form action="/signUp" method="post">
        <?= csrf_field() ?>
        <label for="email">Email :</label>
        <input type="email" name="email" size="50"/>

        <label for="password">Password</label>
        <input type="password" name="password" size="50"/>

        <label for="pass_confirm">Password again</label>
        <input type="password" name="pass_confirm" size="50"/>

        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" size="50"/>

        <label for="name">Name</label>
        <input type="text" name="name" size="50"/>

        <label for="phone">Enter your phone number:</label>
        <input type="tel" name="phone" pattern="^(\+33|0033|0)(6|7)[0-9]{8}$" required>
<br>

        <div>
            <input type="radio" id="manform" name="sex" value="man">
            <label for="manform">Man</label>

            <input type="radio" id="womenform" name="sex" value="women">
            <label for="womenform">Women</label>      
        </div>
<br>        


        <label for="birthday">Birthday :</label>
        <input type="date" name="birthday" min="1920-01-01" max="<?= date("Y-m-d"); ?>">

        <br><br><br>

        <label for="Cweight">Current weight</label>
        <input type="number" name="weight" min="0" max="250">

        <label for="Tweight">Target weight</label>
        <input type="number" name="Tweight" min="0" max="250">

        <label for="size">Your size (cm)    </label>
        <input type="number" name="size" min="0" max="250">
        
        <input type="submit" name="btnSubmit" value="Sign Up"/>
    </form>
    <span style="color:red">
    <?php
    if(isset($registration)) {echo $registration;}
    ?>
    </span>
</fieldset>