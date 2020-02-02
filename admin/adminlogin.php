<html>
    <head>
        <meta charset="UTF-8">
        <title>Login stuff</title>
        <style>
            input[type=text], select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type=password], select {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }

            div {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
                margin: auto;
                width: 60%;
                padding: 10px;
            }
        </style>
        <script>
            function loginfilled() {
                name = document.getElementById('username').value;
                password = document.getElementById('password').value;
                loginFilled = true;
                if (name == "") {
                    document.getElementById('username').style.borderColor = "red"
                    loginFilled = false;
                }
                if (password == "") {
                    document.getElementById('password').style.borderColor = "red"
                    loginFilled = false;
                }
                return loginFilled
            }
            
        </script>
    </head>
    <body>
        <div>
            <form name="form1" method="post" action="login.php" >
                <table align = "center" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">

                    <tr>
                        <td colspan="3"><strong>Member Login </strong></td>
                        

                    </tr>
                    <tr>
                        <td width="78">Username</td>
                        <td width="6">:</td>
                        <td width="294"><input name="username" type="text" id="username" class="error"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input name="password" type="password" id="password">
                                                    </td>

                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="Submit" value="Login" onclick="return loginfilled();"></td>
                    </tr>

                    <tr>
                        <td>

                            <a href="form.php">Create an Account</a>

                        </td>
                    </tr>
                </table>
                <?php
                if ($bad)
                        ?>
            </form>
        </div>
    </body>
</html>

