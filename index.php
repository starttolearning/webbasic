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
            $('#' + helpDiv + 'HelpDiv').load('get-help-text.php', {HelpTextKey: helpDiv },
                    function (response, status, xhr) {
                        if (status == 'error') {
                            var statusMessage = 'status = ' + xhr.status + '<br/>';
                            statusMessage += 'status text = ' + xhr.statusText + '<br/>';
                            statusMessage += 'response = ' + response;

                            $('#divStatus').html(statusMessage);
                        }
                    });
        });

        textBoxs.blur(function () {
            var helpDiv = $(this).attr('id') + 'HelpDiv';
            $('#' + helpDiv).html('');
        });
    });
</script>


</html>
