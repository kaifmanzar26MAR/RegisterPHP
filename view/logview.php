<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        /* color:white; */
        font-weight: bold;
    }

    .log {
        height: 80vh;
        overflow-y: auto;
        overflow-x: hidden;
        width: 80vw;
        /* background-color: black; */
        /* color:white;
        font-weight: bold; */
    }
    .danger{
        background-color: red;
        color: white;
    }
    .success{
        background-color: green;
        color: white;
    }

    
</style>
<body>
    <?php include("navbar.php"); ?>
    <div class="main">
        <div class="log">
            <h2 id="info"></h2>
            <table>
                <thead>
                    <tr>
                        <th>Keys</th>
                        <th>Previous value</th>
                        <th>Updated value</th>
                    </tr>
                </thead>
                <tbody id="table">
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="../js/logview.js"></script>

</html>