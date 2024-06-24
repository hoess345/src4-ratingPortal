@echo off
setlocal enabledelayedexpansion

rem Set the output file
set output_file=php_and_inc_files_content.txt

rem Clear the output file if it exists
if exist %output_file% del %output_file%

rem Loop through all .php and .inc files in the current directory and subdirectories
for /r %%f in (*.php *.inc) do (
    echo %%f >> %output_file%
    type "%%f" >> %output_file%
    echo. >> %output_file%
    echo. >> %output_file%
)

echo All .php and .inc files content has been written to %output_file%
