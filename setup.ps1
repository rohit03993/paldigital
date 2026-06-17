# Pal Digital - Laravel + Filament Setup Script
# Run from project root in PowerShell

$ErrorActionPreference = "Stop"
$projectRoot = $PSScriptRoot
$tempDir = Join-Path (Split-Path $projectRoot -Parent) "pal-digital-laravel-temp"

Write-Host "=== Pal Digital Setup ===" -ForegroundColor Yellow

Set-Location $projectRoot

# Step 1: Merge Laravel skeleton if artisan is missing
if (-not (Test-Path (Join-Path $projectRoot "artisan"))) {
    Write-Host "Laravel skeleton missing - downloading base project..." -ForegroundColor Cyan
    if (Test-Path $tempDir) { Remove-Item $tempDir -Recurse -Force }
    composer create-project laravel/laravel $tempDir --prefer-dist

    Write-Host "Merging skeleton with Pal Digital custom files..." -ForegroundColor Cyan
    $exclude = @('app', 'database', 'resources', 'routes', 'composer.json', 'package.json', 'vite.config.js', 'vendor', '.env', '.env.example', 'setup.ps1')
    Get-ChildItem $tempDir | ForEach-Object {
        if ($exclude -notcontains $_.Name) {
            Copy-Item $_.FullName (Join-Path $projectRoot $_.Name) -Recurse -Force
        }
    }
    Remove-Item $tempDir -Recurse -Force

    # Register Filament AdminPanelProvider
    $providersFile = Join-Path $projectRoot "bootstrap\providers.php"
    if ((Test-Path $providersFile) -and -not (Select-String -Path $providersFile -Pattern "AdminPanelProvider" -Quiet)) {
        (Get-Content $providersFile) -replace 'App\\Providers\\AppServiceProvider::class,', "App\Providers\AppServiceProvider::class,`n    App\Providers\Filament\AdminPanelProvider::class," | Set-Content $providersFile
    }

    Write-Host "Laravel skeleton merged." -ForegroundColor Green
}

# Step 2: Install PHP dependencies (if vendor incomplete)
if (-not (Test-Path (Join-Path $projectRoot "vendor\autoload.php"))) {
    Write-Host "Installing Composer dependencies..." -ForegroundColor Cyan
    composer install
} else {
    Write-Host "Refreshing Composer autoload..." -ForegroundColor Cyan
    composer dump-autoload
    php artisan package:discover --ansi
}

# Step 3: Environment
if (-not (Test-Path ".env")) {
    Copy-Item ".env.example" ".env"
}
if (-not (Select-String -Path ".env" -Pattern "APP_KEY=base64:" -Quiet)) {
    php artisan key:generate
}

# Step 4: MySQL - create database "pal_digital" in MySQL first, then set DB_* in .env

Write-Host ""
Write-Host "Before migrating, ensure MySQL database 'pal_digital' exists and .env DB_* values are correct." -ForegroundColor Yellow
$proceed = Read-Host "Run migrations now? (y/n)"
if ($proceed -eq 'y') {
    php artisan migrate --force
    php artisan db:seed --force
}

# Step 5: Storage link
php artisan storage:link 2>$null

# Step 6: Filament
php artisan filament:install --panels --no-interaction 2>$null

# Step 7: NPM
if (Test-Path "package.json") {
    Write-Host "Installing NPM dependencies..." -ForegroundColor Cyan
    npm install
    npm run build
}

Write-Host ""
Write-Host "=== Setup Complete ===" -ForegroundColor Green
Write-Host "1. Create admin user: php artisan make:filament-user"
Write-Host "2. Start server:    php artisan serve"
Write-Host "3. Public site:     http://localhost:8000"
Write-Host "4. Admin panel:     http://localhost:8000/admin"
