$ErrorActionPreference = 'Stop'
$project = (Get-Location).Path
$routeFile = Join-Path $project 'routes\web.php'
$fragmentFile = Join-Path $project 'routes-tambahan.txt'
if (-not (Test-Path $routeFile) -or -not (Test-Path $fragmentFile)) { throw 'Jalankan skrip ini dari folder akar proyek setelah ZIP diekstrak.' }
$content = Get-Content $routeFile -Raw
if ($content -match "pemohon\.index") { Write-Host 'Rute pemohon sudah terpasang; tidak ditambahkan lagi.'; exit 0 }
Copy-Item $routeFile "$routeFile.bak-pemohon" -Force
$fragment = Get-Content $fragmentFile -Raw
Add-Content -Path $routeFile -Value "`r`n$fragment" -Encoding UTF8
Write-Host 'Rute pemohon terpasang. Cadangan: routes\web.php.bak-pemohon'
