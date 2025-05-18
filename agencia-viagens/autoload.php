<?php
spl_autoload_register(function ($className) {
    // Transforma o namespace em caminho de arquivo
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    // Diretórios raiz onde estão as classes (controllers, daos, models, config)
    $baseDirs = [__DIR__ . '/controllers/', __DIR__ . '/daos/', __DIR__ . '/models/', __DIR__ . '/config/'];

    foreach ($baseDirs as $baseDir) {
        $file = $baseDir . basename($path); // pega só o nome do arquivo, ignorando a parte do namespace
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
    