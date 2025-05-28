<?php
session_start();
require_once 'includes/db.php';

// Autologin dacă există cookie și nu e setată sesiunea
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    $stmt = $pdo->prepare("SELECT * FROM utilizatori WHERE username = ?");
    $stmt->execute([$_COOKIE['remember_me']]);
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['parola'] = $user['parola'];
        $_SESSION['is_admin'] = $user['is_admin'];

        if (basename($_SERVER['PHP_SELF']) === 'index.php') {
            header("Location: " . ($user['is_admin'] ? "admin.php" : "dashboard.php"));
            exit;
        }
    }
}

if (is_logged_in() && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    if (basename($_SERVER['PHP_SELF']) === 'dashboard.php') {
        header("Location: admin.php");
        exit;
    }
}

function login($username, $parola) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM utilizatori WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($parola, $user['parola'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['parola'] = $user['parola'];
        $_SESSION['is_admin'] = $user['is_admin'];
        return true;
    }

    return false;
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function get_logged_user() {
    global $pdo;
    if (!is_logged_in()) return null;

    $stmt = $pdo->prepare("SELECT * FROM utilizatori WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetch();
}

function logout() {
    session_unset();
    session_destroy();

    if (isset($_COOKIE['remember_me'])) {
        setcookie("remember_me", "", time() - 3600, "/");
    }
}

// Încarcă mesajele pentru admin
$mesaje = [];
try {
    $stmt = $pdo->query("SELECT * FROM mesaje_contact ORDER BY data_trimitere DESC");
    $mesaje = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $mesaje = [];
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Admin – Proiect Trufe</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        body {
            background: url('assets/images/home-bg-1.jpeg') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.95);
        }
        .admin-icon {
            font-size: 2rem;
        }
        .table-responsive {
            margin-top: 30px;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<div class="container my-5">
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <h1 class="text-center mb-4">👨‍💼 Panou Administrator – Proiect Trufe</h1>
            <p class="text-center lead mb-4">Bine ai venit în zona de administrare! Aici poți gestiona utilizatorii, încărcările de imagini, conținutul media și activitatea generală.</p>

            <div class="row text-center g-4 mb-4">
                <div class="col-md-3">
                    <a href="upload_admin.php" class="text-decoration-none">
                        <div class="p-3 border rounded shadow-sm">
                            <div class="admin-icon text-success"><i class="fas fa-upload"></i></div>
                            <strong>Upload imagini</strong>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="media_admin.php" class="text-decoration-none">
                        <div class="p-3 border rounded shadow-sm">
                            <div class="admin-icon text-danger"><i class="fas fa-photo-video"></i></div>
                            <strong>Galerie media</strong>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="users.php" class="text-decoration-none">
                        <div class="p-3 border rounded shadow-sm">
                            <div class="admin-icon text-primary"><i class="fas fa-users-cog"></i></div>
                            <strong>Gestionare utilizatori</strong>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="poze_incarcate.php" class="text-decoration-none">
                        <div class="p-3 border rounded shadow-sm">
                            <div class="admin-icon text-warning"><i class="fas fa-chart-line"></i></div>
                            <strong>Vezi imagini incarcate</strong>
                        </div>
                    </a>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">📬 Mesaje primite prin formularul de contact</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="table-success">
                            <th>Nume</th>
                            <th>Email</th>
                            <th>Mesaj</th>
                            <th>Data trimiterii</th>
                            <th>Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mesaje as $m): ?>
                            <tr>
                                <td><?= htmlspecialchars($m['nume']) ?></td>
                                <td><?= htmlspecialchars($m['email']) ?></td>
                                <td><?= nl2br(htmlspecialchars($m['mesaj'])) ?></td>
                                <td><?= $m['data_trimitere'] ?></td>
                                <td>
                                    <a href="?sterge=<?= $m['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Sigur vrei să ștergi acest mesaj?')">Șterge</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="text-end">
                <a href="dashboard.php" class="btn btn-outline-secondary">⬅️ Înapoi la dashboard</a>
            </div>
        </div>
    </div>
</div>

<footer class="text-center text-muted py-3 small mt-auto">
    &copy; <?= date("Y") ?> – Admin Panel | Proiect Trufe
</footer>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/ui-effects.js"></script>
</body>
</html>
