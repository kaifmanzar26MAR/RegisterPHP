<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logs</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
    }

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

    thead tr{
        color:black;
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
        border: 1px solid gray;
    }

    th {
        background-color: #f2f2f2;
    }

    tr {
        height: 20px;
        color:white;
        font-weight: bold;
    }

    .log {
        height: 80vh;
        overflow-y: auto;
        overflow-x: hidden;
        width: 80vw;
        background-color: black;
        /* color:white;
        font-weight: bold; */
    }
    #viewUpdate{
        padding: 5px;
    }
    #viewUpdate button{
        padding: 5px;
        background-color: gray;
        border-radius: 5px;
        color: white;
        cursor: pointer;
    }
   
</style>

<body>
    <?php include("navbar.php"); ?>
    <div class="main">
        <div class="log">
            <table>
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Infor Log</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table">
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="../js/logs.js"></script>

</html>