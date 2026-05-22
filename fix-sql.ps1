$sql = Get-Content 'D:\Backup\sekolah-pintar.sql' -Raw

# Fix 1: Remove USING HASH (not supported in MySQL 8 for non-MEMORY tables)
$sql = $sql -replace 'USING HASH', ''

# Fix 2: Change events.title from varchar(1000) to varchar(750) to fit MySQL 8 index limit
# utf8mb4 = 4 bytes/char, max index = 3072 bytes, so max varchar = 768
# Using 750 to be safe
$sql = $sql -replace '`title` varchar\(1000\)', '`title` varchar(750)'

# Fix 3: Add MySQL 8 compatibility settings at the top
$header = "SET FOREIGN_KEY_CHECKS=0;`nSET GLOBAL innodb_default_row_format='DYNAMIC';`n"
$footer = "`nSET FOREIGN_KEY_CHECKS=1;`n"
$sql = $header + $sql + $footer

[System.IO.File]::WriteAllText('D:\Backup\sekolah-pintar-fixed.sql', $sql, [System.Text.Encoding]::UTF8)
Write-Host "Fixed SQL saved!"
