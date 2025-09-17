@echo off
REM ===============================
REM Dockerized Laravel Dev Startup
REM ===============================

echo ===============================
echo Stopping old containers...
echo ===============================
docker-compose down

echo ===============================
echo Building & starting containers...
echo ===============================
docker-compose up --build -d

REM Wait for database & containers to initialize
echo Waiting for DB to be ready...
timeout /t 20

REM Run migrations & seeders
echo Running Laravel migrations & seeders...
docker exec laravel_dev php artisan migrate:fresh --seed

REM Open Laravel in browser
echo Opening Laravel in browser...
start http://localhost:8000

REM Optional: open PHPMyAdmin
echo Opening PHPMyAdmin in browser...
start http://localhost:8080

REM Attach to app container logs for live feedback
echo Attaching to container logs...
docker-compose logs -f app
