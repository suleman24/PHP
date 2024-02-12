<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "testtt";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE testtt";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn = new mysqli($servername,$username,$password,$database);
if($conn->connect_error)
{
    die("Connection Failed: ". $conn->connect_error);
}

$sql = "CREATE TABLE categories (
    category_id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    category_name VARCHAR(255),
    description VARCHAR(255)
    )";

if ($conn->query($sql) === TRUE) {
    echo "Table Students created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO categories (category_name, description) VALUES
  ('Beverages', 'Soft drinks, coffees, teas, beers, and ales'),
  ('Condiments', 'Sweet and savory sauces, relishes, spreads, and seasonings'),
  ('Confections', 'Desserts, candies, and sweet breads'),
  ('Dairy Products', 'Cheeses'),
  ('Grains/Cereals', 'Breads, crackers, pasta, and cereal'),
  ('Meat/Poultry', 'Prepared meats'),
  ('Produce', 'Dried fruit and bean curd'),
  ('Seafood', 'Seaweed and fish')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. ";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }



$sql = "CREATE TABLE customers (
    customer_id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    customer_name VARCHAR(255),
    contact_name VARCHAR(255),
    address VARCHAR(255),
    city VARCHAR(255),
    postal_code VARCHAR(255),
    country VARCHAR(255)
  )";

if ($conn->query($sql) === TRUE) {
echo "Table Students created successfully";
} else {
echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO customers (customer_name, contact_name, address, city, postal_code, country)
VALUES
  ('Alfreds Futterkiste', 'Maria Anders', 'Obere Str. 57', 'Berlin', '12209', 'Germany'),
  ('Ana Trujillo Emparedados y helados', 'Ana Trujillo', 'Avda. de la Constitucion 2222', 'Mexico D.F.', '05021', 'Mexico'),
  ('Antonio Moreno Taquera', 'Antonio Moreno', 'Mataderos 2312', 'Mexico D.F.', '05023', 'Mexico'),
  ('Around the Horn', 'Thomas Hardy', '120 Hanover Sq.', 'London', 'WA1 1DP', 'UK'),
  ('Berglunds snabbkoep', 'Christina Berglund', 'Berguvsvegen 8', 'Lulea', 'S-958 22', 'Sweden'),
  ('Blauer See Delikatessen', 'Hanna Moos', 'Forsterstr. 57', 'Mannheim', '68306', 'Germany'),
  ('Blondel pere et fils', 'Frederique Citeaux', '24, place Kleber', 'Strasbourg', '67000', 'France'),
  ('Bolido Comidas preparadas', 'Martin Sommer', 'C/ Araquil, 67', 'Madrid', '28023', 'Spain'),
  ('Bon app', 'Laurence Lebihans', '12, rue des Bouchers', 'Marseille', '13008', 'France'),
  ('Bottom-Dollar Marketse', 'Elizabeth Lincoln', '23 Tsawassen Blvd.', 'Tsawassen', 'T2F 8M4', 'Canada'),
  ('Bs Beverages', 'Victoria Ashworth', 'Fauntleroy Circus', 'London', 'EC2 5NT', 'UK'),
  ('Cactus Comidas para llevar', 'Patricio Simpson', 'Cerrito 333', 'Buenos Aires', '1010', 'Argentina'),
  ('Centro comercial Moctezuma', 'Francisco Chang', 'Sierras de Granada 9993', 'Mexico D.F.', '05022', 'Mexico'),
  ('Chop-suey Chinese', 'Yang Wang', 'Hauptstr. 29', 'Bern', '3012', 'Switzerland'),
  ('Comercio Mineiro', 'Pedro Afonso', 'Av. dos Lusiadas, 23', 'Sao Paulo', '05432-043', 'Brazil'),
  ('Consolidated Holdings', 'Elizabeth Brown', 'Berkeley Gardens 12 Brewery ', 'London', 'WX1 6LT', 'UK'),
  ('Drachenblut Delikatessend', 'Sven Ottlieb', 'Walserweg 21', 'Aachen', '52066', 'Germany'),
  ('Du monde entier', 'Janine Labrune', '67, rue des Cinquante Otages', 'Nantes', '44000', 'France'),
  ('Eastern Connection', 'Ann Devon', '35 King George', 'London', 'WX3 6FW', 'UK'),
  ('Ernst Handel', 'Roland Mendel', 'Kirchgasse 6', 'Graz', '8010', 'Austria'),
  ('Familia Arquibaldo', 'Aria Cruz', 'Rua Oros, 92', 'Sao Paulo', '05442-030', 'Brazil'),
  ('FISSA Fabrica Inter. Salchichas S.A.', 'Diego Roel', 'C/ Moralzarzal, 86', 'Madrid', '28034', 'Spain'),
  ('Folies gourmandes', 'Martine Rance', '184, chaussee de Tournai', 'Lille', '59000', 'France'),
  ('Folk och fe HB', 'Maria Larsson', 'Akergatan 24', 'Brecke', 'S-844 67', 'Sweden'),
  ('Frankenversand', 'Peter Franken', 'Berliner Platz 43', 'Munchen', '80805', 'Germany'),
  ('France restauration', 'Carine Schmitt', '54, rue Royale', 'Nantes', '44000', 'France'),
  ('Franchi S.p.A.', 'Paolo Accorti', 'Via Monte Bianco 34', 'Torino', '10100', 'Italy'),
  ('Furia Bacalhau e Frutos do Mar', 'Lino Rodriguez ', 'Jardim das rosas n. 32', 'Lisboa', '1675', 'Portugal'),
  ('Galeria del gastronomo', 'Eduardo Saavedra', 'Rambla de Cataluna, 23', 'Barcelona', '08022', 'Spain'),
  ('Godos Cocina Tipica', 'Jose Pedro Freyre', 'C/ Romero, 33', 'Sevilla', '41101', 'Spain'),
  ('Gourmet Lanchonetes', 'Andre Fonseca', 'Av. Brasil, 442', 'Campinas', '04876-786', 'Brazil'),
  ('Great Lakes Food Market', 'Howard Snyder', '2732 Baker Blvd.', 'Eugene', '97403', 'USA'),
  ('GROSELLA-Restaurante', 'Manuel Pereira', '5th Ave. Los Palos Grandes', 'Caracas', '1081', 'Venezuela'),
  ('Hanari Carnes', 'Mario Pontes', 'Rua do Paco, 67', 'Rio de Janeiro', '05454-876', 'Brazil'),
  ('HILARION-Abastos', 'Carlos Hernandez', 'Carrera 22 con Ave. Carlos Soublette #8-35', 'San Cristobal', '5022', 'Venezuela'),
  ('Hungry Coyote Import Store', 'Yoshi Latimer', 'City Center Plaza 516 Main St.', 'Elgin', '97827', 'USA'),
  ('Hungry Owl All-Night Grocers', 'Patricia McKenna', '8 Johnstown Road', 'Cork', '', 'Ireland'),
  ('Island Trading', 'Helen Bennett', 'Garden House Crowther Way', 'Cowes', 'PO31 7PJ', 'UK'),
  ('Koniglich Essen', 'Philip Cramer', 'Maubelstr. 90', 'Brandenburg', '14776', 'Germany'),
  ('La corne d abondance', 'Daniel Tonini', '67, avenue de l Europe', 'Versailles', '78000', 'France'),
  ('La maison d Asie', 'Annette Roulet', '1 rue Alsace-Lorraine', 'Toulouse', '31000', 'France'),
  ('Laughing Bacchus Wine Cellars', 'Yoshi Tannamuri', '1900 Oak St.', 'Vancouver', 'V3F 2K1', 'Canada'),
  ('Lazy K Kountry Store', 'John Steel', '12 Orchestra Terrace', 'Walla Walla', '99362', 'USA'),
  ('Lehmanns Marktstand', 'Renate Messner', 'Magazinweg 7', 'Frankfurt a.M. ', '60528', 'Germany'),
  ('Lets Stop N Shop', 'Jaime Yorres', '87 Polk St. Suite 5', 'San Francisco', '94117', 'USA'),
  ('LILA-Supermercado', 'Carlos Gonzalez', 'Carrera 52 con Ave. Bolivar #65-98 Llano Largo', 'Barquisimeto', '3508', 'Venezuela'),
  ('LINO-Delicateses', 'Felipe Izquierdo', 'Ave. 5 de Mayo Porlamar', 'I. de Margarita', '4980', 'Venezuela'),
  ('Lonesome Pine Restaurant', 'Fran Wilson', '89 Chiaroscuro Rd.', 'Portland', '97219', 'USA'),
  ('Magazzini Alimentari Riuniti', 'Giovanni Rovelli', 'Via Ludovico il Moro 22', 'Bergamo', '24100', 'Italy'),
  ('Maison Dewey', 'Catherine Dewey', 'Rue Joseph-Bens 532', 'Bruxelles', 'B-1180', 'Belgium'),
  ('Mere Paillarde', 'Jean Fresniere', '43 rue St. Laurent', 'Montreal', 'H1J 1C3', 'Canada'),
  ('Morgenstern Gesundkost', 'Alexander Feuer', 'Heerstr. 22', 'Leipzig', '04179', 'Germany'),
  ('North/South', 'Simon Crowther', 'South House 300 Queensbridge', 'London', 'SW7 1RZ', 'UK'),
  ('Oceano Atlantico Ltda.', 'Yvonne Moncada', 'Ing. Gustavo Moncada 8585 Piso 20-A', 'Buenos Aires', '1010', 'Argentina')";


if ($conn->query($sql) === TRUE) {
echo "New record created successfully. ";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "<br>";



$sql = "CREATE TABLE products (
    product_id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    product_name VARCHAR(255),
    category_id INT,
    unit VARCHAR(255),
    price FLOAT
  )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO products (product_id, product_name, category_id, unit, price)
VALUES
  (1, 'Chais', 1, '10 boxes x 20 bags', 18),
  (2, 'Chang', 1, '24 - 12 oz bottles', 19),
  (3, 'Aniseed Syrup', 2, '12 - 550 ml bottles', 10),
  (4, 'Chef Antons Cajun Seasoning', 2, '48 - 6 oz jars', 22),
  (5, 'Chef Antons Gumbo Mix', 2, '36 boxes', 21.35),
  (6, 'Grandmas Boysenberry Spread', 2, '12 - 8 oz jars', 25),
  (7, 'Uncle Bobs Organic Dried Pears', 7, '12 - 1 lb pkgs.', 30),
  (8, 'Northwoods Cranberry Sauce', 2, '12 - 12 oz jars', 40),
  (9, 'Mishi Kobe Niku', 6, '18 - 500 g pkgs.', 97),
  (10, 'Ikura', 8, '12 - 200 ml jars', 31),
  (11, 'Queso Cabrales', 4, '1 kg pkg.', 21),
  (12, 'Queso Manchego La Pastora', 4, '10 - 500 g pkgs.', 38),
  (13, 'Konbu', 8, '2 kg box', 6),
  (14, 'Tofu', 7, '40 - 100 g pkgs.', 23.25),
  (15, 'Genen Shouyu', 2, '24 - 250 ml bottles', 15.5),
  (16, 'Pavlova', 3, '32 - 500 g boxes', 17.45),
  (17, 'Alice Mutton', 6, '20 - 1 kg tins', 39),
  (18, 'Carnarvon Tigers', 8, '16 kg pkg.', 62.5),
  (19, 'Teatime Chocolate Biscuits', 3, '10 boxes x 12 pieces', 9.2)";


if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. ";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }










  $sql = "CREATE TABLE orders (
    order_id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    customer_id INT,
    order_date DATE
  )";

if ($conn->query($sql) === TRUE) {
    echo "Table Students created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO orders (order_id, customer_id, order_date)
VALUES
  (10248, 90, '2021-07-04'),
  (10249, 81, '2021-07-05'),
  (10250, 34, '2021-07-08'),
  (10251, 84, '2021-07-08'),
  (10252, 76, '2021-07-09'),
  (10253, 34, '2021-07-10'),
  (10254, 14, '2021-07-11'),
  (10255, 68, '2021-07-12'),
  (10256, 88, '2021-07-15'),
  (10257, 35, '2021-07-16'),
  (10258, 20, '2021-07-17'),
  (10259, 13, '2021-07-18'),
  (10260, 55, '2021-07-19'),
  (10261, 61, '2021-07-19'),
  (10262, 65, '2021-07-22'),
  (10263, 20, '2021-07-23'),
  (10264, 24, '2021-07-24'),
  (10265, 7, '2021-07-25'),
  (10266, 87, '2021-07-26'),
  (10267, 25, '2021-07-29'),
  (10268, 33, '2021-07-30'),
  (10269, 89, '2021-07-31'),
  (10270, 87, '2021-08-01'),
  (10271, 75, '2021-08-01'),
  (10272, 65, '2021-08-02'),
  (10273, 63, '2021-08-05'),
  (10274, 85, '2021-08-06'),
  (11074, 73, '2023-05-06'),
  (11075, 68, '2023-05-06'),
  (11076, 9, '2023-05-06')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. ";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }





















  $sql = "CREATE TABLE order_details (
    order_detail_id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT
  )";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO order_details (order_id, product_id, quantity)
VALUES
  (10248, 11, 12),
  (10248, 42, 10),
  (10248, 72, 5),
  (10249, 14, 9),
  (10249, 51, 40),
  (10250, 41, 10),
  (10250, 51, 35),
  (10250, 65, 15),
  (10251, 22, 6),
  (10251, 57, 15),
  (10251, 65, 20),
  (10252, 20, 40),
  (10252, 33, 25),
  (10252, 60, 40),
  (10253, 31, 20),
  (10253, 39, 42),
  (10253, 49, 40),
  (10254, 24, 15),
  (10254, 55, 21),
  (10254, 74, 21),
  (10255, 2, 20),
  (10255, 16, 35),
  (10255, 36, 25),
  (10255, 59, 30),
  (10256, 53, 15),
  (10256, 77, 12),
  (10257, 27, 25),
  (10257, 39, 6),
  (10257, 77, 15),
  (10258, 2, 50),
  (10258, 5, 65),
  (10258, 32, 6),
  (10259, 21, 10),
  (10259, 37, 1),
  (10260, 41, 16),
  (10260, 57, 50),
  (10260, 62, 15),
  (10260, 70, 21),
  (10261, 21, 20),
  (10261, 35, 20),
  (10262, 5, 12),
  (10262, 7, 15),
  (10262, 56, 2),
  (10263, 16, 60),
  (10263, 24, 28),
  (10263, 30, 60),
  (10263, 74, 36),
  (10264, 2, 35),
  (10264, 41, 25),
  (10265, 17, 30),
  (10265, 70, 20),
  (10266, 12, 12),
  (10267, 40, 50),
  (10267, 59, 70),
  (10267, 76, 15),
  (10268, 29, 10),
  (10268, 72, 4),
  (10269, 33, 60),
  (10269, 72, 20),
  (10270, 36, 30),
  (10270, 43, 25),
  (10271, 33, 24),
  (10272, 20, 6),
  (10272, 31, 40),
  (10272, 72, 24),
  (10273, 10, 24),
  (10273, 31, 15),
  (10273, 33, 20),
  (10273, 40, 60),
  (10273, 76, 33),
  (10274, 71, 20),
  (10274, 72, 7),
  (10275, 24, 12),
  (10275, 59, 6),
  (10276, 10, 15),
  (10276, 13, 10),
  (10277, 28, 20),
  (10277, 62, 12),
  (10278, 44, 16),
  (10278, 59, 15),
  (10278, 63, 8),
  (10278, 73, 25),
  (10279, 17, 15)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. ";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }




$conn->close();



?>