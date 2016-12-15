<!DOCTYPE html>
<html>
    <head>
        <meta charset="GBK">
        <title>jQuery Learning</title>
    </head>
    <body>
        <?php
        ?>
        <table border="1" style="border-collapse:collapse;">
            <tr>
                <td>Name</td>
                <td><input type="text" id="txtName"/></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><input type="text" id="txtGender"/></td>
            </tr>
            <tr>
                <td>Salary</td>
                <td><input type="text" id="txtSalary"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="button" id="btnInsert" value="Insert Employee" /></td>
            </tr>
        </table>
        
        <br/><br/>
        <table id="tblEmployees" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>


        <div id="divResult"></div>
    </body>
    <!-- include the local jquery library-->
    <script type="text/javascript" src="jquery3.1.1.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#btnInsert').click(function () {
                var employee = {};
                employee.name = $('#txtName').val();
                employee.gender = $('#txtGender').val();
                employee.salary = $('#txtSalary').val();
                
                $.ajax({
                   url: "insert-employee.php",
                   method : 'post',
                   data: {
                       employee : JSON.stringify(employee),
                       action : 'insert_employee'
                   },
                   success: function () {
                        getAllEmployees();
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });
            
            function getAllEmployees(){
                $.ajax({
                   url: "insert-employee.php",
                   method : 'post',
                   dataType: 'json',
                   data: { action : 'get_all_employees' },
                   success: function (data) {
                       var employeeTable =  $('#tblEmployees tbody');
                       console.log(JSON.stringify( data));
                        $(data).each( function (index, emp) {
                            employeeTable.append(
                                    '<tr><td>'+emp.id+'</td>'+
                                    '<td>'+emp.name+'</td>'+
                                    '<td>'+emp.gender+'</td>'+
                                    '<td>'+emp.salary+'</td></tr>'
                                );
                        });
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
                
            });
    </script>


</html>