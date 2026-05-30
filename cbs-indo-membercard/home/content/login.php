<?php
function login()
{
?>
  <br>
  <br>
  <br>
  <center>
    <h3>
      Masuk Halaman Member
    </h3>
    Silahkan daftar jika belum memiliki akun <a href="index.php?p=daftar">Daftar disini</a>
  </center>
  <br>
  <style>
    body {
      font-family: "Asap", sans-serif;
    }

    .juju {
      overflow: hidden;
      background-color: white;
      padding: 40px 30px 30px 30px;
      border-radius: 10px;
      position: relative;
      margin-top: 8%;
      left: 50%;
      width: 400px;
      -webkit-transform: translate(-50%, -50%);
      -moz-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      -o-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      -webkit-transition: -webkit-transform 300ms, box-shadow 300ms;
      -moz-transition: -moz-transform 300ms, box-shadow 300ms;
      transition: transform 300ms, box-shadow 300ms;
      box-shadow: 5px 10px 10px rgba(2, 128, 144, 0.2);
    }

    .juju::before,
    .juju::after {
      content: '';
      position: absolute;
      width: 600px;
      height: 600px;
      border-top-left-radius: 40%;
      border-top-right-radius: 45%;
      border-bottom-left-radius: 35%;
      border-bottom-right-radius: 40%;
      z-index: -1;
    }

    .juju::before {
      left: 40%;
      bottom: -130%;
      background-color: rgba(69, 105, 144, 0.15);
      -webkit-animation: wawes 6s infinite linear;
      -moz-animation: wawes 6s infinite linear;
      animation: wawes 6s infinite linear;
    }

    .juju::after {
      left: 35%;
      bottom: -125%;
      background-color: rgba(2, 128, 144, 0.2);
      -webkit-animation: wawes 7s infinite;
      -moz-animation: wawes 7s infinite;
      animation: wawes 7s infinite;
    }

    .juju>input {
      font-family: "Asap", sans-serif;
      display: block;
      border-radius: 5px;
      font-size: 16px;
      background: white;
      width: 100%;
      border: 0;
      padding: 10px 10px;
      margin: 15px -10px;
    }

    select {
      font-family: "Asap", sans-serif;
      display: block;
      border-radius: 5px;
      font-size: 16px;
      background: white;
      width: 100%;
      border: 0;
      padding: 10px 10px;
      margin: 15px -10px;
    }

    .juju>button {
      font-family: "Asap", sans-serif;
      cursor: pointer;
      color: #fff;
      font-size: 16px;
      text-transform: uppercase;
      width: 80px;
      border: 0;
      padding: 10px 0;
      margin-top: 10px;
      margin-left: -5px;
      border-radius: 5px;
      background-color: #f45b69;
      -webkit-transition: background-color 300ms;
      -moz-transition: background-color 300ms;
      transition: background-color 300ms;
    }

    .juju>button:hover {
      background-color: #f24353;
    }

    @-webkit-keyframes wawes {
      from {
        -webkit-transform: rotate(0);
      }

      to {
        -webkit-transform: rotate(360deg);
      }
    }

    @-moz-keyframes wawes {
      from {
        -moz-transform: rotate(0);
      }

      to {
        -moz-transform: rotate(360deg);
      }
    }

    @keyframes wawes {
      from {
        -webkit-transform: rotate(0);
        -moz-transform: rotate(0);
        -ms-transform: rotate(0);
        -o-transform: rotate(0);
        transform: rotate(0);
      }

      to {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }

    a {}
  </style>

  <form class="juju" method="post" action="">

    <?php if (isset($_GET['code'])) {

      $id_member = decrypt($_GET['code']);
      $username = baca_database("", "username", "select * from data_member where id_member ='$id_member'");
    ?>
      <input type="text" value="<?php echo $username; ?>" name="username" placeholder="Username">
    <?php
    } else {
    ?>
      <input type="text" name="username" placeholder="Username">
    <?php
    }
    ?>



    <input type="password" name="password" placeholder="Password">
    <button name="login" type="submit">Login</button>
  </form>






  <!--
    <div class="container">

        <form class="form-signin" method="post" action="">
            <h3>Form Login</h3>
            Jika belum mimiliki akun silahkan Daftar : <a href="index.php?p=juju&action=daftar">Form Pendaftaran</a>
            <br>
            Username : <input
                type="text"
                name="username"
                class="input-block-level"
                placeholder="Username">
                <br>
                Password : 
            <input
                type="password"
                name="password"
                class="input-block-level"
                placeholder="Password">
                <br>
            <button class="btn btn-large btn-success" name="juju" type="submit">Login</button>
        </form>
    </div>
-->
<?php
}
?>