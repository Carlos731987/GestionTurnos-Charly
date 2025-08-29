<?php

class ProtegerCred {
    private static array $env = [];
    private static bool $loaded = false;
    private static string $path = '';

    /**
     * Inicializa la carga del .env (solo la primera vez).
     * Puedes pasar una ruta distinta si movés el .env fuera del docroot.
     */
    public static function init(?string $rutaEnv = null): void {
        if (self::$loaded) return;

        $rutaEnv = $rutaEnv ?? __DIR__ . '/../.env'; // .env en la raíz del proyecto
        self::$path = $rutaEnv;

        if (!file_exists($rutaEnv)) {
            throw new RuntimeException("No se encontró el archivo .env en: {$rutaEnv}");
        }

        // 1) Intento con parse_ini_file (rápido)
        $parsed = @parse_ini_file($rutaEnv, false, INI_SCANNER_RAW);
        if ($parsed !== false) {
            self::$env = array_map([self::class, 'clean'], $parsed);
            self::$loaded = true;
            return;
        }

        // 2) Fallback: parse manual (más flexible)
        $lineas = @file($rutaEnv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lineas === false) {
            throw new RuntimeException("No se pudo leer el archivo .env en: {$rutaEnv}");
        }

        foreach ($lineas as $linea) {
            $linea = trim($linea);
            if ($linea === '' || $linea[0] === '#' || $linea[0] === ';') continue;

            $pair = explode('=', $linea, 2);
            if (count($pair) !== 2) continue;

            $clave = trim($pair[0]);
            $valor = self::clean($pair[1]);
            self::$env[$clave] = $valor;
        }

        self::$loaded = true;
    }

    /** Limpia comillas y espacios. */
    private static function clean(string $val): string {
        $val = trim($val);
        if ($val === '') return $val;
        $first = $val[0];
        $last  = substr($val, -1);
        if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
            $val = substr($val, 1, -1);
        }
        return trim($val);
    }

    /** Obtiene una variable del .env con default opcional. */
    public static function get(string $clave, $default = null) {
        if (!self::$loaded) self::init();
        return array_key_exists($clave, self::$env) ? self::$env[$clave] : $default;
    }

    /** Devuelve todo el .env como array asociativo. */
    public static function all(): array {
        if (!self::$loaded) self::init();
        return self::$env;
    }
}

/**
 * Compatibilidad hacia atrás:
 * Permite seguir usando cargarEnv('CLAVE') como en tu código anterior.
 */
if (!function_exists('cargarEnv')) {
    function cargarEnv(string $clave, $default = null) {
        return ProtegerCred::get($clave, $default);
    }
}

?>


