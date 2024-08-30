<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    thead {
        position: sticky;
        top: 0;
        background-color: #f2f2f2;
        /* Ensure the background color is set for the sticky header */
        z-index: 1;
        /* Ensure the header stays on top of the rows */
    }
    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
    #edit, #delete{
        cursor: pointer;
    }
    #delete:hover{
        color:blueviolet;
    }
    #edit:hover{
        color:blueviolet;
    }
    .table_container{
        width: 80vw;
        height: 80vh;
        overflow: auto;

    }
    
</style>

<body>
    <?php
    include("navbar.php");

    ?>
    <div class="main">
        <div class="table_container">
            <table>
                <thead>
                    <tr>
                        <th>UserId</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>User Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="table">

                </tbody>
            </table>
        </div>

    </div>
</body>
<script src="../js/view.js"></script>

</html>