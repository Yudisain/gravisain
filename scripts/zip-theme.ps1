param(
	[string]$ThemeName = "gravisain",
	[string]$OutputDir = "release"
)

$ErrorActionPreference = "Stop"

$root = Resolve-Path (Join-Path $PSScriptRoot "..")
$releaseDir = Join-Path $root $OutputDir
$stagingDir = Join-Path $releaseDir $ThemeName
$zipPath = Join-Path $releaseDir "$ThemeName.zip"

if (Test-Path $stagingDir) {
	Remove-Item -LiteralPath $stagingDir -Recurse -Force
}

if (Test-Path $zipPath) {
	Remove-Item -LiteralPath $zipPath -Force
}

New-Item -ItemType Directory -Path $stagingDir -Force | Out-Null

$includeFolders = @(
	"assets",
	"classes",
	"data",
	"template-parts",
	"patterns",
	"templates",
	"vendor",
	"languages"
)

$includeFiles = @(
	"functions.php",
	"index.php",
	"style.css",
	"theme.json",
	"screenshot.jpg",
	"readme.txt",
	"404.php",
	"archive.php",
	"comments.php",
	"footer.php",
	"header.php",
	"page.php",
	"search.php",
	"sidebar.php",
	"single.php",
	"archive-gravisain_template.php",
	"single-gravisain_template.php"
)

foreach ($folder in $includeFolders) {
	$source = Join-Path $root $folder
	if (Test-Path $source) {
		Copy-Item -LiteralPath $source -Destination (Join-Path $stagingDir $folder) -Recurse -Force
	}
}

foreach ($file in $includeFiles) {
	$source = Join-Path $root $file
	if (Test-Path $source) {
		Copy-Item -LiteralPath $source -Destination (Join-Path $stagingDir $file) -Force
	}
}

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$zipFile = [System.IO.Compression.ZipFile]::Open($zipPath, [System.IO.Compression.ZipArchiveMode]::Create)
try {
	$files = Get-ChildItem -LiteralPath $stagingDir -Recurse -File
	foreach ($file in $files) {
		$relativePath = "$ThemeName/" + $file.FullName.Substring($stagingDir.Length + 1).Replace('\', '/')
		[System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zipFile, $file.FullName, $relativePath) | Out-Null
	}
} finally {
	$zipFile.Dispose()
}

Write-Host "Theme zip created: $zipPath"
