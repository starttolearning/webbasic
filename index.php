<!DOCTYPE html>
<html>
    <head>
        <meta charset="GBK">
        <title>jQuery Learning</title>
        <style>

        </style>
    </head>
    <body>
        <?php
        ?>
        First Name:<br/><input type="text" id="firstName" /> <span id="firstNameHelpDiv" ></sapn> <br/>
        Last Name:<br/><input type="text" id="lastName" /> <span id="lastNameHelpDiv" ></span> <br/>
        Email:<br/><input type="text" id="email" /><span id="emailHelpDiv" ></span>  <br/>
        Income:<br/><input type="text" id="income" /><span id="incomeHelpDiv" ></span>  <br/>

        <div id="divStatus"></div>
</body>
<!-- include the local jquery library-->
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var textBoxs = $('input[type="text"]');

        textBoxs.focus(function () {
            var helpDiv = $(this).attr('id');
            // Using get() other than load()
            $.get('get-help-text.php', {HelpTextKey: helpDiv}, function ( response ) {
                $('#' + helpDiv + 'HelpDiv').html(response);
            })
        });

        textBoxs.blur(function () {
            var helpDiv = $(this).attr('id') + 'HelpDiv';
            $('#' + helpDiv).html('');
        });
    });
</script>


</html>
