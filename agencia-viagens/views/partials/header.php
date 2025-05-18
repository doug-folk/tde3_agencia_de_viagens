<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Agência de Viagens' ?></title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            table th, table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            }

            table th {
            background-color: #3498db;
            color: white;
            }

            table tr:hover {
            background-color: #f1f1f1;
            }

        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
            margin: 0; 
            padding: 0;
            background-color: #f5f5f5;
        }
        .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 20px;
        }
        header {
            margin-top: 20px; 
            text-align: center;
            color: black;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn { 
            padding: 8px 16px; 
            text-decoration: none; 
            border-radius: 4px;
            display: inline-block;
        }
        .btn-primary { 
            background: #3498db; 
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 30px; 
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        .form-group label { 
            display: block; 
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input { 
            width: 100%; 
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .flash { 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 4px; 
        }
        .flash.error { 
            background: #ffdddd; 
            border-left: 4px solid #f44336; 
        }
        .flash.success { 
            background: #ddffdd; 
            border-left: 4px solid #4CAF50; 
        }
        .auth-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .auth-links {
            margin-top: 1rem;
            text-align: center;
        }

        ul {
        list-style: none;
        padding: 0;
        margin: 20px 0;
        display: flex;
        justify-content: center;
        gap: 20px; 
    }
    ul li {
       
    }
    ul li a {
        text-decoration: none;
        color: #3498db;
        font-weight: bold;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
    ul li a:hover {
        background-color: #3498db;
        color: white;
    }

    header {
        margin-top: 20px; 
        text-align: center;
        color: #222;
        padding: 20px;
        border-radius: 5px;
        background-color: transparent;
    }

    header h1 {
        margin-bottom: 10px;
        font-weight: 700;
        font-size: 2.5rem;
    }

    header p {
        font-size: 1.1rem;
        color: #555;
        margin: 0;
        font-style: italic;
    }

    header p strong {
        color: #3498db;
        font-weight: 700;
    }


    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Akatsuki Travel</h1>
            <?php if (isset($_SESSION['usuario'])): ?>
                <nav class="nav-user" aria-label="Menu do usuário">
        <span>Olá, <?= htmlspecialchars($_SESSION['usuario']->getNome()) ?></span>
        <?php if ($_SESSION['usuario']->getTipo() === 'cliente'): ?>
            <ul>
                <li><a href="/cliente/viagens">Ver Viagens Disponíveis</a></li>
                <li><a href="/cliente/minhas-reservas">Minhas Reservas</a></li>
                <li><a href="/auth/logout" class="logout">Sair</a></li>
            </ul>
        <?php elseif ($_SESSION['usuario']->getTipo() === 'admin'): ?>
            <ul>
                <li><a href="/admin/dashboard">Dashboard</a></li>
                <li><a href="/admin/viagens">Gerenciar Viagens</a></li>
                <li><a href="/auth/logout" class="logout">Sair</a></li>
            </ul>
        <?php else: ?>
            <ul>
                <li><a href="/auth/logout" class="logout">Sair</a></li>
            </ul>
        <?php endif; ?>
    </nav>
            <?php endif; ?>
        </header>
        <main>