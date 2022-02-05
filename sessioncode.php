<?php
    if(isset($_POST['code'])) {
        $sess_code = $_POST['code'];
        // json_encode($code);
        // var_dump($code);
        // echo "<h1>sssssss</h1>".$code;
        // $model = null;
        // if(is_null($model)) {
        //     echo "<script>alert('Hello World');var editor = ace.edit('editor');editor.getSession().setValue('".$code."');</script>";
        // }

?>
    <script>
    //     $(function() {
    //     alert("Inside the jQuery ready");
    // });
        // var editor = ace.edit('editor');
        var res_code = <?php echo json_encode($sess_code); ?>;
        // alert(res_code);
        editor.getSession().setValue(res_code);
    </script>
<?php
    }
?>