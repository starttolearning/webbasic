<!DOCTYPE html>
<html>
    <head>
        <meta charset="GBK">
        <title>jQuery Learning</title>
        <style>
            .divContainer{
                font-size: 24px;
                color: #ccc;
                font-weight: 200;
            }
        </style>
    </head>
    <body>
        <?php
        ?>

<!--        Skills: <input type="checkbox" name="skills" value="javascript"/> JavaScript
 <input type="checkbox" name="skills" value="jquery"/> jQuery
 <input type="checkbox" name="skills" value="php"/> PHP
 <input type="checkbox" name="skills" value="html"/> HTML
 <input type="checkbox" name="skills" value="css"/> CSS<br/><br/>
 
 Prefered Cities: <input type="checkbox" name="skills" value="New York"/> New York
 <input type="checkbox" name="cities" value="Beijing"/> Beijing
 <input type="checkbox" name="cities" value="Shanghai"/> Shanghai
 <input type="checkbox" name="cities" value="Hong Kong"/> Hong Kong
 <input type="checkbox" name="cities" value="Chengdu"/> Chengdu<br/><br/>
 
 <input type="submit" value="Get skills" id="btn1" />
 <input type="submit" value="Get cities" id="btn2" />-->

        <input type="button" value="Click me" id="btn" />    
        <input type="button" value="Undelegate" id="btn1" />    
        <span id="myspan"> Country in the world.</span>
        <ul>
            <li>United States</li>
            <li>United Kingdom</li>
            <li>China</li>
            <li>Japan</li>
            <li>Canada</li>
        </ul>   
        First Name : <input id="firstName" value=""/> <br/>
        Country: 
        <select id="selectCountry" >
            <option value="USA">United State</option>
            <option value="UK">United Kindom</option>
            <option value="cn">China</option>
            <option value="jp">Japan</option>
        </select>
        <div title="div" id="resultDiv"></div>
    </body>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('body').on('contextmenu',function ( e ) {
                e.preventDefault();
                $('#resultDiv').append('Right click are disable');
                
            })
        });
    </script>


</html>
