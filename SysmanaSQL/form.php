<?php
// Opening HTML tags with embedded CSS styles
echo "<html><head><title>Formulario</title><style>        
    body {
        background-color: black;
        color: green;
    }

    a {
        color: green;
    }

    h3 {
        color: red;
    }
</style></head>";

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "retosysmanapasswords";

// Creating a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking if the connection was successful
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Handling the form submission using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving user inputs from the form
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $favColor = $_POST['favColor'];

    // Constructing a SQL query to check if the user-entered credentials exist in the database
    $sql = "SELECT * FROM possiblepasswords WHERE user = '$user' AND favColor = '$favColor' AND password = '$pass'";
    
    // Executing the SQL query
    $result = $conn->query($sql);

    // Checking if any rows were returned from the query
    if ($result->num_rows > 0) {
        // Displaying a link to go back to the form
        echo '<a href="index.html">Volver al formulario</a><br><br>';

        // Checking for a specific user and color combination
        if ($user == "MAA" && $favColor == "skyblue") {
            $sql = "SELECT * FROM possiblepasswords WHERE user = 'MAA' AND favColor = 'skyblue'";
        } else {
            $sql = "SELECT * FROM possiblepasswords WHERE user = '$user' AND favColor = '$favColor' AND password = '$pass'";
        }

        // Executing the new SQL query
        $result = $conn->query($sql);

        // Displaying the retrieved information from the database
        while ($row = $result->fetch_assoc()) {
            echo "user: " . $row["user"] . " - password: " . $row["password"] . " - favColor: " . $row["favColor"] . "<br>";
        }

        // Displaying a message
        echo '<h3>Hay muchos colores, ¿cual será mi favorito?</div>';
    } else {
        // Displaying a link to go back to the form and an error message
        echo '<a href="index.html">Volver al formulario</a><br><br>';
        echo "0 resultados";
    }

    // Closing the database connection
    $conn->close();
}
