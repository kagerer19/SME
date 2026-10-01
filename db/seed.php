<?php
// Creates the SQLite DB with demo data if it does not exist yet.
$path = getenv('DB_PATH') ?: '/var/www/data/app.sqlite';
if (file_exists($path)) {
    exit(0);
}

$pdo = new PDO('sqlite:' . $path);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec(file_get_contents(__DIR__ . '/schema.sql'));

$pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)')
    ->execute(['Demo User', 'demo@example.com', password_hash('demo1234', PASSWORD_DEFAULT)]);

$clients = [
    ['Acme Bakery', 'Maria Huber', '+43 660 1234567', 'Hauptstrasse 12, Vienna'],
    ['Alpine Logistics', 'Thomas Gruber', '+43 664 2345678', 'Bahnhofstrasse 5, Graz'],
    ['Blue Harbor Cafe', 'Sophie Wagner', '+43 676 3456789', 'Seestrasse 8, Salzburg'],
    ['Brightside Dental', 'Dr. Lukas Bauer', '+43 650 4567890', 'Ringstrasse 21, Linz'],
    ['Green Leaf Florists', 'Anna Pichler', '+43 699 5678901', 'Gartenweg 3, Innsbruck'],
    ['Nova Print Studio', 'Felix Mayer', '+43 660 6789012', 'Mariahilfer Str. 90, Vienna'],
    ['Summit Fitness', 'Julia Steiner', '+43 664 7890123', 'Bergweg 14, Kitzbuhel'],
    ['Urban Tailors', 'David Leitner', '+43 676 8901234', 'Kirchenplatz 2, Klagenfurt'],
];
$stmt = $pdo->prepare('INSERT INTO clients (company_name, contact_person, phone, address, created_by) VALUES (?, ?, ?, ?, 1)');
foreach ($clients as $c) {
    $stmt->execute($c);
}
