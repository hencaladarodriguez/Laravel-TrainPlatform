# TrainPlatform

Aplicación web para gestión de entrenamientos de ciclismo. Permite organizar planes de entrenamiento, sesiones, bloques de trabajo y registrar los resultados de cada salida.

## Tecnologías

- PHP 8.2 / Laravel 11
- MySQL 8.0
- Nginx
- Docker
- Laravel Sanctum (autenticación API)

## Requisitos previos

- Docker y Docker Compose instalados

## Instalación

Clonar el repositorio:

```bash
git clone https://github.com/hencaladarodriguez/Laravel-TrainPlatform
cd Laravel-TrainPlatform
```

Copiar el fichero de entorno:

```bash
cp .env.example .env
```

Levantar los contenedores:

```bash
docker compose up -d
```

Instalar dependencias PHP:

```bash
docker compose exec app composer install
```

Generar la clave de aplicación:

```bash
docker compose exec app php artisan key:generate
```

Ejecutar migraciones y datos de prueba:

```bash
docker compose exec app php artisan migrate:fresh --seed
```

## Acceso

| Servicio    | URL                      |
|-------------|--------------------------|
| Aplicación  | http://localhost:8000    |
| phpMyAdmin  | http://localhost:8080    |

## Cuentas de prueba

| Email              | Contraseña |
|--------------------|------------|
| test1@prueba.com   | prueba123  |
| test2@prueba.com   | prueba123  |

## Estructura principal

```
app/Http/Controllers/Api/   — controladores de la API REST
app/Models/                 — modelos Eloquent
database/migrations/        — migraciones de base de datos
database/seeders/           — datos de prueba
public/js/app.js            — lógica del frontend
resources/views/            — plantillas Blade
```

## Funcionalidades

- Registro e inicio de sesión de ciclistas
- Gestión de planes de entrenamiento con fechas y objetivos
- Creacion de sesiones dentro de cada plan
- Biblioteca de bloques de entrenamiento reutilizables (rodaje, intervalos, fuerza, recuperacion, test)
- Registro de entrenamientos realizados con métricas: potencia, pulso, velocidad, TSS, IF
- Seguimiento de bicicletas y desgaste de componentes
- Histórico de datos físicos del ciclista (peso, FTP, pulso máximo)
