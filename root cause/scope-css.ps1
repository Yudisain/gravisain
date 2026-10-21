# Scope the mockup CSS so it cannot leak into the Gravisain theme.
# Fixes the top gap (body padding + wrapper margin) and namespaces global selectors.
$ErrorActionPreference = 'Stop'
$src = 'D:\VS CODE GRAVISAIN\gravisain\root cause\css.txt'
$dst = 'D:\VS CODE GRAVISAIN\gravisain\root cause\css-scoped.txt'

$lines = Get-Content -LiteralPath $src
$out = New-Object System.Collections.Generic.List[string]

$skipBody = $false
$inWrapper = $false
$wrapperDone = $false

foreach ($line in $lines) {
    # --- 1. Drop the global `body { ... }` block entirely (moved into wrapper) ---
    if ($line -match '^\s*body\s*\{') { $skipBody = $true; continue }
    if ($skipBody) {
        if ($line -match '^\}') { $skipBody = $false }
        continue
    }

    # --- 2. Scope the global `* { box-sizing }` reset ---
    if ($line -match '^\s*\*\s*\{') {
        $out.Add('.grv-mockup-wrapper,')
        $out.Add('.grv-mockup-wrapper * {')
        continue
    }

    # --- 3. Namespace global color/dot selectors (single-line: keep body intact) ---
    if ($line -match '^(\s*)\.(dot-red|dot-yellow|dot-green|bg-white|bg-slate|bg-indigo|bg-dark)(\s*\{.*)$') {
        $out.Add($matches[1] + '.grv-mockup-wrapper .' + $matches[2] + $matches[3])
        continue
    }

    # --- 4. Fix the FIRST wrapper rule: remove top margin, inherit body look ---
    if (-not $wrapperDone -and $line -match '^\s*\.grv-mockup-wrapper\s*\{') {
        $inWrapper = $true
        $out.Add($line)
        continue
    }
    if ($inWrapper) {
        if ($line -match 'margin:\s*40px\s+auto\s+60px;') {
            $out.Add('    margin: 0 auto 60px;')
            continue
        }
        if ($line -match '^\}') {
            # inject the body look (bg/font/color) just before closing the wrapper rule
            $out.Add('    background: #f1f5f9;')
            $out.Add("    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;")
            $out.Add('    color: #1e293b;')
            $out.Add('}')
            $inWrapper = $false
            $wrapperDone = $true
            continue
        }
        $out.Add($line)
        continue
    }

    $out.Add($line)
}

Set-Content -LiteralPath $dst -Value $out -Encoding UTF8
Write-Host ("Wrote {0} lines to css-scoped.txt" -f $out.Count)
