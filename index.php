<!DOCTYPE html>
<html>
    <head>
        <meta charset="GBK">
        <title>jQuery Learning</title>
    </head>
    <body>
        <?php include_once './parts/part-insert-employee.php'; ?>
    </body>
    <!-- include the local jquery library-->
    <script type="text/javascript" src="js/jquery3.1.1.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#btnInsert').click(function () {
                var employee = {};
                employee.name = $('#txtName').val();
                employee.gender = $('#txtGender').val();
                employee.salary = $('#txtSalary').val();
                
                $.ajax({
                   url: "inc/insert-employee.php",
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
                   url: "inc/insert-employee.php",
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